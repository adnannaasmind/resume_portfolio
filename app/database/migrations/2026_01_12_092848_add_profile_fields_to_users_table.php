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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->index()->after('password');
            $table->string('preferred_locale', 5)->default('en')->after('role');
            $table->string('timezone')->nullable()->after('preferred_locale');
            $table->string('avatar_url')->nullable()->after('timezone');
            $table->boolean('profile_completed')->default(false)->after('avatar_url');
            $table->timestamp('last_login_at')->nullable()->after('profile_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'preferred_locale',
                'timezone',
                'avatar_url',
                'profile_completed',
                'last_login_at',
            ]);
        });
    }
};
