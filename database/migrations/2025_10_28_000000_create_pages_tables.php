<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pages', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();
            $t->string('title');
            $t->string('subtitle')->nullable();
            $t->string('type')->default('standard');
            $t->text('body')->nullable();
            $t->string('hero_image')->nullable();
            $t->string('hero_video_url')->nullable();
            $t->string('hero_video_poster')->nullable();
            $t->boolean('is_published')->default(true);
            $t->timestamp('published_at')->nullable();
            $t->string('meta_title')->nullable();
            $t->text('meta_description')->nullable();
            $t->string('og_image')->nullable();
            $t->timestamps();
        });

        Schema::create('page_sections', function (Blueprint $t) {
            $t->id();
            $t->foreignId('page_id')->constrained()->cascadeOnDelete();
            $t->string('key')->nullable();
            $t->string('title')->nullable();
            $t->text('body')->nullable();
            $t->string('media_path')->nullable();
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_published')->default(true);
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('page_sections');
        Schema::dropIfExists('pages');
    }
};
