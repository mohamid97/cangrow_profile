<?php

namespace App\Services\Front\Profile;

use App\Http\Resources\Api\Front\Gallery\GalleryResource;

class FrontendService
{
    private $reponseData = [];

    public function getModel($studlyName)
    {
        $modelClass = "App\\Models\\Api\\Admin\\{$studlyName}";

        if (! class_exists($modelClass)) {
            throw new \Exception("Model {$studlyName} does not exist.");
        }

        return $modelClass;
    }

    public function getQuery($modelClass, $resourceClass, $request)
    {
        $relations = $this->requestedRelations($request);

        if ($relations !== []) {
            foreach ($relations as $relation) {
                $rootRelation = explode('.', $relation)[0];

                if (! method_exists($modelClass, $rootRelation)) {
                    throw new \Exception("Relation {$relation} does not exist in model.");
                }
            }

            $query = $modelClass::with($relations);
        } else {
            $query = $modelClass::query();
        }

        // `filter` uses the same payload shape as /data/dynamic/filter:
        // [{ "column": "status", "value": "active" }].
        if ($request->has('filter') && is_array($request->filter) && ! empty($request->filter)) {
            $this->applyFilters($query, $modelClass, $request->filter);
        }

        // Keep the original, more explicit filtering payload working.
        if ($request->has('where') && is_array($request->where) && ! empty($request->where)) {
            $this->applyFilters($query, $modelClass, $request->where, true);
        }

        if ($request->has('order') && in_array($request->order, ['asc', 'desc', 'ASC', 'DESC'])) {
            $orderBy = $request->order_by ?? 'id';
            $query->orderBy($orderBy, $request->order);
        }

        $isPaginated = $request->has('pagination') && $request->pagination > 0;
        if ($isPaginated) {
            $query = $query->paginate($request->pagination);
            $this->createResponsePaginate($query);

        } else {

            // need to check of sent if or slug
            if ($request->has('id')) {
                $query = $query->where('id', $request->id)->get();
            } elseif ($request->has('slug')) {
                $query = $query->whereHas('translations', function ($q) use ($request) {
                    $q->where('slug', $request->slug);
                })->get();
            } else {
                $query = $query->get();
            }

        }

        $this->createResponseItem($query, $resourceClass, $request);

        if ($isPaginated) {
            return [
                'paginator' => $query,
                'items' => $this->reponseData['items'],
            ];
        }

        return $this->reponseData;
    }

    private function createResponsePaginate($query)
    {
        $this->reponseData['pagination'] =
         [
             'current_page' => $query->currentPage(),
             'last_page' => $query->lastPage(),
             'per_page' => $query->perPage(),
             'total' => $query->total(),
         ];
    }

    private function createResponseItem($query, $resourceClass, $request)
    {
        $items = $resourceClass::collection($query);
        $requestedColumns = $this->requestedNames($request->input('column', $request->input('columns', [])));

        if ($requestedColumns === []) {
            $this->reponseData['items'] = $items;

            return;
        }

        $responseKeys = array_unique(array_merge(
            $requestedColumns,
            array_map(
                fn ($relation) => match (explode('.', $relation)[0]) {
                    'nestedCategories' => 'children',
                    default => explode('.', $relation)[0],
                },
                $this->requestedRelations($request)
            )
        ));

        $this->reponseData['items'] = collect($items->resolve($request))
            ->map(fn ($item) => collect($item)->only($responseKeys)->all())
            ->values()
            ->all();
    }

    private function requestedRelations($request): array
    {
        return $this->requestedNames($request->input('relations', $request->input('relation', [])));
    }

    private function requestedNames($value): array
    {
        if (is_string($value)) {
            $value = [$value];
        }

        if (! is_array($value)) {
            return [];
        }

        return array_values(array_unique(array_filter(
            $value,
            fn ($name) => is_string($name) && trim($name) !== ''
        )));
    }

    // start dynamic  filter

    public function dynamicFilter($modelClass, $resourceClass, $request)
    {
        $query = $modelClass::query();
        $this->applyFilters($query, $modelClass, $request->filter);

        if ($request->has('order') && in_array($request->order, ['asc', 'desc', 'ASC', 'DESC'])) {
            $orderBy = $request->order_by ?? 'id';
            $query->orderBy($orderBy, $request->order);
        }
        $isPaginated = $request->has('pagination') && $request->pagination > 0;
        if ($isPaginated) {
            $query = $query->paginate($request->pagination);
            $this->createResponsePaginate($query);

        } else {
            $query = $query->get();
        }

        $this->createResponseItem($query, $resourceClass, $request);

        if ($isPaginated) {
            return [
                'paginator' => $query,
                'items' => $this->reponseData['items'],
            ];
        }

        return $this->reponseData;

    } // end dynamic filter

    /**
     * Apply direct model-column filters after confirming each requested column
     * belongs to the selected model's table.
     */
    private function applyFilters($query, $modelClass, array $filters, bool $allowOperator = false): void
    {
        $table = (new $modelClass)->getTable();
        $allowedOperators = ['=', '!=', '<>', '>', '>=', '<', '<=', 'like', 'not like'];

        foreach ($filters as $filter) {
            if (! isset($filter['column']) || ! array_key_exists('value', $filter)) {
                throw new \Exception('Filter must have column and value.');
            }

            $column = $filter['column'];
            if (! \Schema::hasColumn($table, $column)) {
                throw new \Exception("Column {$column} does not exist in model.");
            }

            $operator = $allowOperator ? strtolower($filter['operator'] ?? '=') : '=';
            if (! in_array($operator, $allowedOperators, true)) {
                throw new \Exception("Operator {$operator} is not supported.");
            }

            $value = $filter['value'] === 'null' ? null : $filter['value'];
            if ($value === null) {
                $operator === '!=' || $operator === '<>'
                    ? $query->whereNotNull($column)
                    : $query->whereNull($column);

                continue;
            }

            $columnType = \DB::getSchemaBuilder()->getColumnType($table, $column);
            if ($columnType === 'json' || $column === 'position') {
                $query->whereJsonContains($column, $value);

                continue;
            }

            $query->where($column, $operator, $value);
        }
    }

    // get galleries
    public function getgalleries($modelClass, $id, $forignKey)
    {
        $query = $modelClass::where($forignKey, $id)->get();

        return GalleryResource::collection($query);

    }
}
