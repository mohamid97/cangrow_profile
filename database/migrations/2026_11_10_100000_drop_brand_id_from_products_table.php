<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn('brand_id');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->nullOnDelete();
        });

        DB::table('products')
            ->joinSub(
                DB::table('brand_product')
                    ->select('product_id', DB::raw('MIN(brand_id) as brand_id'))
                    ->groupBy('product_id'),
                'product_brands',
                'products.id',
                '=',
                'product_brands.product_id'
            )
            ->update(['products.brand_id' => DB::raw('product_brands.brand_id')]);
    }
};
