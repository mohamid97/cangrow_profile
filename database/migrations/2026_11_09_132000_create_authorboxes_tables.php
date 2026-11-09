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
            $table->string('specialty')->nullable();
            $table->string('profile_link')->nullable();
            $table->timestamps();
        });

        Schema::create('authorbox_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('authorbox_id')->constrained('authorboxes')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('author_name');
            $table->timestamps();
            $table->unique(['authorbox_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authorbox_translations');
        Schema::dropIfExists('authorboxes');
    }
};
