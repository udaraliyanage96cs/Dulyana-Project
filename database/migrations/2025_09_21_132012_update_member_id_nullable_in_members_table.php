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
        Schema::table('members', function (Blueprint $table) {
            $table->dropUnique(['member_id']);
            $table->dropColumn('member_id');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->string('member_id')->nullable()->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropUnique(['member_id']);
            $table->dropColumn('member_id');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->string('member_id')->unique()->after('id');
        });
    }
};