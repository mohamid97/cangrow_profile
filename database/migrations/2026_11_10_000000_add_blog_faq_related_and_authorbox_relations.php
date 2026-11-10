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
            $table->unsignedBigInteger('authorbox_id');
            $table->string('locale')->index();
            $table->unique(['authorbox_id', 'locale']);
            $table->string('author_name');
            $table->string('specialty')->nullable();
            $table->text('bio')->nullable();
            $table->foreign('authorbox_id')->references('id')->on('authorboxes')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('author_box_id')->nullable()->after('category_id');
            $table->foreign('author_box_id')->references('id')->on('authorboxes')->nullOnDelete();
        });

        Schema::create('blog_faq', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('faq_id');
            $table->timestamps();
            $table->primary(['blog_id', 'faq_id']);
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
        });

        Schema::create('blog_related_blog', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('related_blog_id');
            $table->timestamps();
            $table->primary(['blog_id', 'related_blog_id']);
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('related_blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_related_blog');
        Schema::dropIfExists('blog_faq');

        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dropColumn('author_box_id');
            });
        } else {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dropForeign(['author_box_id']);
                $table->dropColumn('author_box_id');
            });
        }

        Schema::dropIfExists('authorbox_translations');
        Schema::dropIfExists('authorboxes');
    }
};
