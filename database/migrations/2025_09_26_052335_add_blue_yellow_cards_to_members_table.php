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
            $table->enum('blue_card_available', ['yes', 'no'])->nullable()->after('postal_code');
            $table->string('blue_card_number')->nullable()->after('blue_card_available');
            $table->date('blue_card_issue')->nullable()->after('blue_card_number');
            $table->date('blue_card_expire')->nullable()->after('blue_card_issue');

            $table->enum('yellow_card_available', ['yes', 'no'])->nullable()->after('blue_card_expire');
            $table->string('yellow_card_number')->nullable()->after('yellow_card_available');
            $table->date('yellow_card_issue')->nullable()->after('yellow_card_number');
            $table->date('yellow_card_expire')->nullable()->after('yellow_card_issue');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn([
                'blue_card_available',
                'blue_card_number',
                'blue_card_issue',
                'blue_card_expire',
                'yellow_card_available',
                'yellow_card_number',
                'yellow_card_issue',
                'yellow_card_expire',
            ]);
        });
    }
};
