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
        Schema::table('member_courses', function (Blueprint $table) {
            $table->string('card_number')->nullable()->after('status');
            $table->date('issue_date')->nullable()->after('card_number');
            $table->date('expiry_date')->nullable()->after('issue_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_courses', function (Blueprint $table) {
            $table->dropColumn(['card_number', 'issue_date', 'expiry_date']);
        });
    }
};
