<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_related_blog', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->foreignId('related_blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['blog_id', 'related_blog_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_related_blog');
    }
};
