<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoCatalogSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $categories = [
                [
                    'type' => 'products',
                    'order' => 1,
                    'translations' => [
                        'en' => [
                            'title' => 'Coffee Products',
                            'slug' => 'coffee-products',
                            'small_des' => 'Products for preparing coffee at home.',
                            'des' => 'Browse coffee machines and grinders for home use.',
                            'meta_title' => 'Coffee Products',
                            'meta_des' => 'Explore our coffee product collection.',
                        ],
                        'ar' => [
                            'title' => 'منتجات القهوة',
                            'slug' => 'coffee-products-ar',
                            'small_des' => 'منتجات لتحضير القهوة في المنزل.',
                            'des' => 'تصفح ماكينات القهوة والمطاحن للاستخدام المنزلي.',
                            'meta_title' => 'منتجات القهوة',
                            'meta_des' => 'اكتشف مجموعة منتجات القهوة.',
                        ],
                    ],
                ],
                [
                    'type' => 'products',
                    'order' => 1,
                    'parent' => 'coffee-products',
                    'translations' => [
                        'en' => [
                            'title' => 'Coffee Machines',
                            'slug' => 'coffee-machines',
                            'small_des' => 'Coffee machines for home and office.',
                            'des' => 'Explore reliable machines for preparing coffee at home or at work.',
                            'meta_title' => 'Coffee Machines',
                            'meta_des' => 'Browse our coffee machine collection.',
                        ],
                        'ar' => [
                            'title' => 'ماكينات القهوة',
                            'slug' => 'coffee-machines-ar',
                            'small_des' => 'ماكينات قهوة للمنزل والمكتب.',
                            'des' => 'اكتشف ماكينات موثوقة لتحضير القهوة في المنزل أو العمل.',
                            'meta_title' => 'ماكينات القهوة',
                            'meta_des' => 'تصفح مجموعة ماكينات القهوة.',
                        ],
                    ],
                ],
                [
                    'type' => 'products',
                    'order' => 2,
                    'parent' => 'coffee-products',
                    'translations' => [
                        'en' => [
                            'title' => 'Coffee Grinders',
                            'slug' => 'coffee-grinders',
                            'small_des' => 'Grinders for freshly ground coffee.',
                            'des' => 'Find grinders for consistent coffee at home.',
                            'meta_title' => 'Coffee Grinders',
                            'meta_des' => 'Browse our coffee grinder collection.',
                        ],
                        'ar' => [
                            'title' => 'مطاحن القهوة',
                            'slug' => 'coffee-grinders-ar',
                            'small_des' => 'مطاحن لتحضير قهوة طازجة.',
                            'des' => 'اختر مطحنة تساعدك على تحضير قهوة متجانسة في المنزل.',
                            'meta_title' => 'مطاحن القهوة',
                            'meta_des' => 'تصفح مجموعة مطاحن القهوة.',
                        ],
                    ],
                ],
                [
                    'type' => 'services',
                    'order' => 1,
                    'parent' => 'coffee-services',
                    'translations' => [
                        'en' => [
                            'title' => 'Coffee Machine Services',
                            'slug' => 'coffee-machine-services',
                            'small_des' => 'Care and maintenance for coffee machines.',
                            'des' => 'Keep your coffee machine working well with regular care and maintenance.',
                            'meta_title' => 'Coffee Machine Services',
                            'meta_des' => 'Explore coffee machine maintenance services.',
                        ],
                        'ar' => [
                            'title' => 'خدمات ماكينات القهوة',
                            'slug' => 'coffee-machine-services-ar',
                            'small_des' => 'العناية بماكينات القهوة وصيانتها.',
                            'des' => 'حافظ على أداء ماكينة القهوة من خلال العناية والصيانة الدورية.',
                            'meta_title' => 'خدمات ماكينات القهوة',
                            'meta_des' => 'تعرف على خدمات صيانة ماكينات القهوة.',
                        ],
                    ],
                ],
                [
                    'type' => 'services',
                    'order' => 1,
                    'translations' => [
                        'en' => [
                            'title' => 'Coffee Services',
                            'slug' => 'coffee-services',
                            'small_des' => 'Professional coffee machine care and setup.',
                            'des' => 'Browse cleaning, maintenance, and setup services for coffee machines.',
                            'meta_title' => 'Coffee Services',
                            'meta_des' => 'Explore our coffee machine service collection.',
                        ],
                        'ar' => [
                            'title' => 'خدمات القهوة',
                            'slug' => 'coffee-services-ar',
                            'small_des' => 'خدمات احترافية للعناية بماكينات القهوة وإعدادها.',
                            'des' => 'تصفح خدمات تنظيف وصيانة وإعداد ماكينات القهوة.',
                            'meta_title' => 'خدمات القهوة',
                            'meta_des' => 'اكتشف مجموعة خدمات ماكينات القهوة.',
                        ],
                    ],
                ],
                [
                    'type' => 'services',
                    'order' => 2,
                    'parent' => 'coffee-services',
                    'translations' => [
                        'en' => [
                            'title' => 'Coffee Machine Setup',
                            'slug' => 'coffee-machine-setup',
                            'small_des' => 'Setup and installation for new coffee machines.',
                            'des' => 'Get help setting up a new coffee machine.',
                            'meta_title' => 'Coffee Machine Setup',
                            'meta_des' => 'Prepare your new coffee machine for use.',
                        ],
                        'ar' => [
                            'title' => 'إعداد ماكينة القهوة',
                            'slug' => 'coffee-machine-setup-ar',
                            'small_des' => 'إعداد وتركيب ماكينات القهوة الجديدة.',
                            'des' => 'احصل على المساعدة في إعداد ماكينة القهوة الجديدة.',
                            'meta_title' => 'إعداد ماكينة القهوة',
                            'meta_des' => 'جهّز ماكينة القهوة الجديدة للاستخدام.',
                        ],
                    ],
                ],
            ];

            $categoryIds = [];

            foreach ($categories as $categoryData) {
                $englishSlug = $categoryData['translations']['en']['slug'];
                $existingTranslation = DB::table('category_translations')
                    ->where('locale', 'en')
                    ->where('slug', $englishSlug)
                    ->first();

                $categoryValues = [
                    'type' => $categoryData['type'],
                    'order' => $categoryData['order'],
                    'parent_id' => null,
                    'updated_at' => now(),
                ];

                if ($existingTranslation) {
                    $categoryId = $existingTranslation->category_id;
                    DB::table('categories')->where('id', $categoryId)->update($categoryValues);
                } else {
                    $categoryId = DB::table('categories')->insertGetId($categoryValues + [
                        'created_at' => now(),
                    ]);
                }

                $categoryIds[$englishSlug] = $categoryId;
                $translationRows = [];

                foreach ($categoryData['translations'] as $locale => $translation) {
                    $translationRows[] = $translation + [
                        'category_id' => $categoryId,
                        'locale' => $locale,
                        'alt_image' => null,
                        'title_image' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                DB::table('category_translations')->upsert(
                    $translationRows,
                    ['category_id', 'locale'],
                    ['title', 'slug', 'alt_image', 'title_image', 'small_des', 'des', 'meta_title', 'meta_des', 'updated_at']
                );
            }

            foreach ($categories as $categoryData) {
                if (isset($categoryData['parent'])) {
                    DB::table('categories')
                        ->where('id', $categoryIds[$categoryData['translations']['en']['slug']])
                        ->update([
                            'parent_id' => $categoryIds[$categoryData['parent']],
                            'updated_at' => now(),
                        ]);
                }
            }

            $products = [
                [
                    'barcode' => 'DEMO-ESPRESSO-001',
                    'category' => 'coffee-machines',
                    'price' => 249.99,
                    'translations' => [
                        'en' => ['title' => 'Home Espresso Machine', 'slug' => 'home-espresso-machine', 'small_des' => 'A compact espresso machine for everyday use.', 'des' => 'Prepare espresso and milk-based coffee drinks at home.', 'meta_title' => 'Home Espresso Machine', 'meta_des' => 'A compact espresso machine for your home.'],
                        'ar' => ['title' => 'ماكينة إسبريسو منزلية', 'slug' => 'home-espresso-machine-ar', 'small_des' => 'ماكينة إسبريسو صغيرة للاستخدام اليومي.', 'des' => 'حضّر قهوة الإسبريسو ومشروبات القهوة بالحليب في المنزل.', 'meta_title' => 'ماكينة إسبريسو منزلية', 'meta_des' => 'ماكينة إسبريسو صغيرة لمنزلك.'],
                    ],
                ],
                [
                    'barcode' => 'DEMO-COFFEE-002',
                    'category' => 'coffee-machines',
                    'price' => 399.00,
                    'translations' => [
                        'en' => ['title' => 'Automatic Coffee Maker', 'slug' => 'automatic-coffee-maker', 'small_des' => 'Fresh coffee with a simple one-touch start.', 'des' => 'An automatic coffee maker designed for easy daily brewing.', 'meta_title' => 'Automatic Coffee Maker', 'meta_des' => 'Make fresh coffee easily every day.'],
                        'ar' => ['title' => 'آلة قهوة أوتوماتيكية', 'slug' => 'automatic-coffee-maker-ar', 'small_des' => 'قهوة طازجة بلمسة زر واحدة.', 'des' => 'آلة قهوة أوتوماتيكية مصممة لتحضير القهوة بسهولة يوميًا.', 'meta_title' => 'آلة قهوة أوتوماتيكية', 'meta_des' => 'حضّر قهوة طازجة بسهولة كل يوم.'],
                    ],
                ],
                [
                    'barcode' => 'DEMO-GRINDER-003',
                    'category' => 'coffee-grinders',
                    'price' => 89.50,
                    'translations' => [
                        'en' => ['title' => 'Burr Coffee Grinder', 'slug' => 'burr-coffee-grinder', 'small_des' => 'A reliable grinder for fresh coffee.', 'des' => 'Grind coffee beans consistently before brewing.', 'meta_title' => 'Burr Coffee Grinder', 'meta_des' => 'Grind fresh coffee beans at home.'],
                        'ar' => ['title' => 'مطحنة قهوة بشفرات مخروطية', 'slug' => 'burr-coffee-grinder-ar', 'small_des' => 'مطحنة موثوقة لتحضير قهوة طازجة.', 'des' => 'اطحن حبوب القهوة بشكل متجانس قبل التحضير.', 'meta_title' => 'مطحنة قهوة', 'meta_des' => 'اطحن حبوب القهوة الطازجة في المنزل.'],
                    ],
                ],
                [
                    'barcode' => 'DEMO-GRINDER-004',
                    'category' => 'coffee-grinders',
                    'price' => 129.00,
                    'translations' => [
                        'en' => ['title' => 'Electric Coffee Grinder', 'slug' => 'electric-coffee-grinder', 'small_des' => 'An easy-to-use grinder for fresh coffee.', 'des' => 'Grind coffee beans quickly for your preferred brewing method.', 'meta_title' => 'Electric Coffee Grinder', 'meta_des' => 'Prepare freshly ground coffee with an electric grinder.'],
                        'ar' => ['title' => 'مطحنة قهوة كهربائية', 'slug' => 'electric-coffee-grinder-ar', 'small_des' => 'مطحنة سهلة الاستخدام لتحضير قهوة طازجة.', 'des' => 'اطحن حبوب القهوة بسرعة لتناسب طريقة التحضير المفضلة لديك.', 'meta_title' => 'مطحنة قهوة كهربائية', 'meta_des' => 'حضّر قهوة مطحونة طازجة باستخدام مطحنة كهربائية.'],
                    ],
                ],
            ];

            foreach ($products as $productData) {
                $productId = $this->upsertTranslatedRecord(
                    'products',
                    'product_translations',
                    'product_id',
                    $productData['translations'],
                    [
                        'product_image' => null,
                        'breadcrumb' => null,
                        'price' => $productData['price'],
                        'category_id' => $categoryIds[$productData['category']],
                        'brand_id' => null,
                        'order' => 1,
                        'barcode' => $productData['barcode'],
                        'status' => 'published',
                    ]
                );

                $this->upsertTranslations('product_translations', 'product_id', $productId, $productData['translations']);
            }

            $services = [
                [
                    'price' => 35.00,
                    'order' => 1,
                    'translations' => [
                        'en' => ['title' => 'Coffee Machine Cleaning', 'slug' => 'coffee-machine-cleaning', 'small_des' => 'A professional cleaning service for your machine.', 'des' => 'Remove residue and refresh your coffee machine with a thorough cleaning.', 'meta_title' => 'Coffee Machine Cleaning', 'meta_des' => 'Book a thorough coffee machine cleaning.'],
                        'ar' => ['title' => 'تنظيف ماكينة القهوة', 'slug' => 'coffee-machine-cleaning-ar', 'small_des' => 'خدمة تنظيف احترافية لماكينتك.', 'des' => 'تخلص من بقايا القهوة وجدّد أداء الماكينة من خلال تنظيف شامل.', 'meta_title' => 'تنظيف ماكينة القهوة', 'meta_des' => 'احجز خدمة تنظيف شاملة لماكينة القهوة.'],
                    ],
                ],
                [
                    'price' => 59.00,
                    'order' => 2,
                    'translations' => [
                        'en' => ['title' => 'Coffee Machine Maintenance', 'slug' => 'coffee-machine-maintenance', 'small_des' => 'Routine maintenance for dependable brewing.', 'des' => 'A routine inspection and maintenance service for coffee machines.', 'meta_title' => 'Coffee Machine Maintenance', 'meta_des' => 'Keep your coffee machine in good condition.'],
                        'ar' => ['title' => 'صيانة ماكينة القهوة', 'slug' => 'coffee-machine-maintenance-ar', 'small_des' => 'صيانة دورية لتحضير قهوة موثوق.', 'des' => 'خدمة فحص وصيانة دورية لماكينات القهوة.', 'meta_title' => 'صيانة ماكينة القهوة', 'meta_des' => 'حافظ على ماكينة القهوة في حالة جيدة.'],
                    ],
                ],
                [
                    'price' => 25.00,
                    'order' => 3,
                    'category' => 'coffee-machine-setup',
                    'translations' => [
                        'en' => ['title' => 'Coffee Machine Setup', 'slug' => 'coffee-machine-setup', 'small_des' => 'Get help setting up a new coffee machine.', 'des' => 'We help you set up your machine and prepare it for its first brew.', 'meta_title' => 'Coffee Machine Setup', 'meta_des' => 'Get your new coffee machine ready to use.'],
                        'ar' => ['title' => 'إعداد ماكينة القهوة', 'slug' => 'coffee-machine-setup-ar', 'small_des' => 'مساعدة في إعداد ماكينة القهوة الجديدة.', 'des' => 'نساعدك على إعداد الماكينة وتجهيزها لتحضير أول فنجان.', 'meta_title' => 'إعداد ماكينة القهوة', 'meta_des' => 'جهّز ماكينة القهوة الجديدة للاستخدام.'],
                    ],
                ],
            ];

            foreach ($services as $serviceData) {
                $serviceId = $this->upsertTranslatedRecord(
                    'services',
                    'service_translations',
                    'service_id',
                    $serviceData['translations'],
                    [
                        'service_image' => null,
                        'breadcrumb' => null,
                        'price' => $serviceData['price'],
                        'category_id' => $categoryIds[$serviceData['category'] ?? 'coffee-machine-services'],
                        'order' => $serviceData['order'],
                    ]
                );

                $this->upsertTranslations('service_translations', 'service_id', $serviceId, $serviceData['translations']);
            }
        });
    }

    private function upsertTranslatedRecord(
        string $table,
        string $translationTable,
        string $foreignKey,
        array $translations,
        array $attributes
    ): int {
        $existingTranslation = DB::table($translationTable)
            ->where('locale', 'en')
            ->where('slug', $translations['en']['slug'])
            ->first();

        $attributes['updated_at'] = now();

        if ($existingTranslation) {
            $id = $existingTranslation->$foreignKey;
            DB::table($table)->where('id', $id)->update($attributes);
        } else {
            $id = DB::table($table)->insertGetId($attributes + [
                'created_at' => now(),
            ]);
        }

        return $id;
    }

    private function upsertTranslations(string $table, string $foreignKey, int $id, array $translations): void
    {
        $rows = [];

        foreach ($translations as $locale => $translation) {
            $rows[] = $translation + [
                $foreignKey => $id,
                'locale' => $locale,
                'small_des' => null,
                'des' => null,
                'alt_image' => null,
                'title_image' => null,
                'meta_des' => null,
                'meta_title' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table($table)->upsert(
            $rows,
            [$foreignKey, 'locale'],
            ['title', 'slug', 'small_des', 'des', 'alt_image', 'title_image', 'meta_des', 'meta_title', 'updated_at']
        );
    }
}
