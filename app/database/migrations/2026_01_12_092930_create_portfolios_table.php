<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('headline')->nullable();
            $table->string('hero_image')->nullable();
            $table->text('summary')->nullable();
            $table->json('content')->nullable();
            $table->json('projects')->nullable();
            $table->json('testimonials')->nullable();
            $table->json('cta')->nullable();
            $table->json('social_links')->nullable();
            $table->string('template')->default('minimal');
            $table->string('language', 5)->default('en');
            $table->json('theme')->nullable();
            $table->boolean('is_public')->default(false)->index();
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('downloads_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
