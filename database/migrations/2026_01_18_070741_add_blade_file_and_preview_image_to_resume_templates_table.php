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
        Schema::table('resume_templates', function (Blueprint $table) {
            $table->string('blade_file')->nullable()->after('slug');
            $table->string('preview_image')->nullable()->after('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resume_templates', function (Blueprint $table) {
            $table->dropColumn(['blade_file', 'preview_image']);
        });
    }
};
