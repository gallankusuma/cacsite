<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('certificates', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('issuer')->nullable();
            $t->date('issue_date')->nullable();
            $t->string('file_path')->nullable();
            $t->boolean('is_published')->default(true);
            $t->timestamps();
        });

        Schema::create('branches', function (Blueprint $t) {
            $t->id();
            $t->string('country');
            $t->string('city')->nullable();
            $t->string('address')->nullable();
            $t->string('phone')->nullable();
            $t->string('email')->nullable();
            $t->string('type')->default('branch'); // branch / factory / lab
            $t->boolean('is_published')->default(true);
            $t->timestamps();
        });

        Schema::create('site_stats', function (Blueprint $t) {
            $t->id();
            $t->string('key')->unique();
            $t->unsignedInteger('value_int')->default(0);
            $t->timestamps();
        });

        Schema::create('inquiries', function (Blueprint $t) {
            $t->id();
            $t->string('type')->default('contact'); // contact | career
            $t->string('name');
            $t->string('email');
            $t->string('phone')->nullable();
            $t->string('subject')->nullable();
            $t->text('message')->nullable();
            $t->json('meta')->nullable(); // ex: ['cv_url'=> 'https://...']
            $t->string('status')->default('new'); // new | read
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('site_stats');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('certificates');
    }
};
