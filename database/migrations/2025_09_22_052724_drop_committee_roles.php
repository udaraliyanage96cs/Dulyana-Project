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
        // Schema::dropIfExists('committee_roles');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::create('committee_roles', function ($table) {
        //     $table->id();
        //     $table->string('name')->unique();
        //     $table->unsignedBigInteger('created_by')->nullable();
        //     $table->unsignedBigInteger('updated_by')->nullable();
        //     $table->timestamps();
        // });
    }
};
