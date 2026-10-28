<?php

namespace App\Traits;

use App\Models\Api\Admin\Lang;

trait HandlesResourceTranslations
{
    protected function getColumnLang(string $field, $relation = null)
    {
        $columnLangs = config('app.column_langs');

        if (!empty($columnLangs)) {
            if (!empty($relation)) {
                return $this->$relation?->translate($columnLangs)?->$field ?? null;
            }

            if ($field === 'slug') {
                $translations = [];

                foreach (Lang::all() as $locale) {
                    $translations[$locale->code] = $this->translate($locale->code)?->$field ?? null;
                }

                return $translations;
            }

            return $this->translate($columnLangs)?->$field ?? null;
        }

        $translations = [];

        foreach (Lang::all() as $locale) {
            if (!empty($relation)) {
                $translations[$locale->code] = $this->$relation?->translate($locale->code)?->$field ?? null;
                continue;
            }

            $translations[$locale->code] = $this->translate($locale->code)?->$field ?? null;
        }

        return $translations;
    }

    protected function getColumnsLangWithArrayRelation(array $fields, $relation, $notTranslatedFields = [])
    {
        $translations = [];

        foreach ($this->$relation ?? [] as $index => $item) {
            $translations[$index]['id'] = $item->id ?? null;

            foreach ($fields as $field) {
                if ($field === 'slug') {
                    $translations[$index][$field] = [];

                    foreach (Lang::all() as $locale) {
                        $translations[$index][$field][$locale->code] = $item->translate($locale->code)?->$field ?? null;
                    }

                    continue;
                }

                if (!empty(config('app.column_langs'))) {
                    $translations[$index][$field] = $item->translate(config('app.column_langs'))?->$field ?? null;
                    continue;
                }

                $translations[$index][$field] = [];

                foreach (Lang::all() as $locale) {
                    $translations[$index][$field][$locale->code] = $item->translate($locale->code)?->$field ?? null;
                }
            }

            foreach ($notTranslatedFields as $notTranslatedField) {
                if (in_array($notTranslatedField, ['image', 'logo', 'photo', 'icon', 'category_image', 'product_image', 'breadcrumb', 'thumbnail'], true)) {
                    $translations[$index][$notTranslatedField] = $this->getImageUrl($item->$notTranslatedField);
                    continue;
                }

                $translations[$index][$notTranslatedField] = $item->$notTranslatedField ?? null;
            }
        }

        return $translations;
    }
}
