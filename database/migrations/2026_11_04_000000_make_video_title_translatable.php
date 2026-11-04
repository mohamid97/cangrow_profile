<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_id');
            $table->string('locale')->index();
            $table->unique(['video_id', 'locale']);
            $table->string('title');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->timestamps();
        });

        if (Schema::hasColumn('videos', 'title')) {
            $now = now();
            $videos = DB::table('videos')->whereNotNull('title')->get(['id', 'title']);
            foreach ($videos as $video) {
                DB::table('video_translations')->insert([
                    'video_id' => $video->id,
                    'locale' => config('app.locale'),
                    'title' => $video->title,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            Schema::table('videos', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
    }

    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('title')->nullable();
        });

        $locale = config('app.locale');
        foreach (DB::table('video_translations')->where('locale', $locale)->get(['video_id', 'title']) as $translation) {
            DB::table('videos')->where('id', $translation->video_id)->update(['title' => $translation->title]);
        }

        Schema::dropIfExists('video_translations');
    }
};
