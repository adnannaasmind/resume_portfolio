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
        Schema::create('resume_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('preview_url')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_premium')->default(false)->index();
            $table->json('metadata')->nullable();
            $table->string('demo_pdf_path')->nullable();
            $table->string('category')->nullable();
            $table->string('locale', 5)->default('en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_templates');
    }
};
