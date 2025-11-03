<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_categories', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();
            $t->string('name');
            $t->string('short_desc')->nullable();
            $t->string('icon_path')->nullable();
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_published')->default(true);
            $t->timestamps();
        });

        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->foreignId('category_id')->constrained('product_categories')->cascadeOnDelete();
            $t->string('name');
            $t->string('slug')->unique();
            $t->string('summary')->nullable();
            $t->longText('description')->nullable();
            $t->json('specs')->nullable();
            $t->string('datasheet_path')->nullable();
            $t->string('hero_image')->nullable();
            $t->boolean('is_published')->default(true);
            $t->string('meta_title')->nullable();
            $t->text('meta_description')->nullable();
            $t->string('og_image')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');
    }
};
