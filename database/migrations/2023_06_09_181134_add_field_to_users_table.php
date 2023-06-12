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
        Schema::table('Users', function (Blueprint $table) {
            $table->string('profession')->nullable()->after('email_verified_at');
            $table->string('avatar')->nullable()->after('profession');
            $table->enum('role', ['admin', 'student'])->default('student')->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Users', function (Blueprint $table) {
            $table->dropColumn('profession');
            $table->dropColumn('avatar');
            $table->dropColumn('role');
        });
    }
};
