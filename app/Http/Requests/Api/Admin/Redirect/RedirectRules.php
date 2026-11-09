<?php

namespace App\Http\Requests\Api\Admin\Redirect;

use Illuminate\Validation\Rule;

class RedirectRules
{
    public static function make(?int $ignoreId = null): array
    {
        $sourcePathUnique = Rule::unique('redirects', 'source_path');
        if ($ignoreId !== null) {
            $sourcePathUnique->ignore($ignoreId);
        }

        return [
            'source_path' => [
                'required',
                'string',
                'max:255',
                'regex:/^\/(?!\/)[^\s?#\\\\]*$/',
                $sourcePathUnique,
            ],
            'target_url' => [
                'required',
                'string',
                'max:2048',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (! is_string($value) || preg_match('/[\x00-\x20]/', $value) || str_contains($value, '\\')) {
                        $fail('The target URL must be a relative path or an HTTP(S) URL.');

                        return;
                    }

                    $parts = parse_url($value);
                    if ($parts === false) {
                        $fail('The target URL must be a relative path or an HTTP(S) URL.');

                        return;
                    }

                    if (isset($parts['scheme'])) {
                        if (
                            ! in_array(strtolower($parts['scheme']), ['http', 'https'], true)
                            || empty($parts['host'])
                            || isset($parts['user'])
                            || isset($parts['pass'])
                        ) {
                            $fail('The target URL must be a valid HTTP or HTTPS URL.');
                        }

                        return;
                    }

                    if (! str_starts_with($value, '/') || str_starts_with($value, '//')) {
                        $fail('The target URL must be a relative path beginning with one slash, or an HTTP(S) URL.');
                    }
                },
            ],
            'status_code' => ['sometimes', 'integer', Rule::in([301, 302, 303, 307, 308])],
            'is_active' => ['sometimes', 'boolean'],
            'preserve_query' => ['sometimes', 'boolean'],
        ];
    }
}
