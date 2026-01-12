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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('resume_template_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->json('data')->nullable();
            $table->unsignedTinyInteger('completeness_score')->default(0);
            $table->boolean('is_public')->default(false)->index();
            $table->string('share_token')->unique();
            $table->timestamp('share_expires_at')->nullable();
            $table->timestamp('last_exported_at')->nullable();
            $table->string('pdf_path')->nullable();
            $table->boolean('watermark_enabled')->default(true);
            $table->string('status')->default('draft');
            $table->string('language', 5)->default('en');
            $table->foreignId('duplicated_from_id')->nullable()->constrained('resumes')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
