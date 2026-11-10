<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authorboxes', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('profile_link')->nullable();
            $table->timestamps();
        });

        Schema::create('authorbox_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('authorbox_id')->constrained('authorboxes')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('author_name');
            $table->string('specialty')->nullable();
            $table->text('bio')->nullable();
            $table->unique(['authorbox_id', 'locale']);
            $table->timestamps();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('author_box_id')
                ->nullable()
                ->constrained('authorboxes')
                ->nullOnDelete();
        });

        Schema::create('blog_faq', function (Blueprint $table) {
            $table->foreignId('blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->foreignId('faq_id')->constrained('faqs')->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['blog_id', 'faq_id']);
        });

        Schema::create('blog_related_blog', function (Blueprint $table) {
            $table->foreignId('blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->foreignId('related_blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['blog_id', 'related_blog_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_related_blog');
        Schema::dropIfExists('blog_faq');

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['author_box_id']);
            $table->dropColumn('author_box_id');
        });

        Schema::dropIfExists('authorbox_translations');
        Schema::dropIfExists('authorboxes');
    }
};
