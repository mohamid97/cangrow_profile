<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_faq', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained()->cascadeOnDelete();
            $table->foreignId('faq_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['blog_id', 'faq_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_faq');
    }
};
