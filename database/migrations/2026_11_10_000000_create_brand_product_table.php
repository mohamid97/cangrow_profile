<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brand_product', function (Blueprint $table) {
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->primary(['brand_id', 'product_id']);
        });

        DB::table('brand_product')->insertUsing(
            ['brand_id', 'product_id'],
            DB::table('products')
                ->whereNotNull('brand_id')
                ->select('brand_id', 'id')
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('brand_product');
    }
};
