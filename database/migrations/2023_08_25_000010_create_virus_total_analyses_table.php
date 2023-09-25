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
        Schema::create('virus_total_analyses', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('status');
            $table->json('results')->nullable();
            $table->json('stats')->nullable();
            $table->dateTime('vt_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('virus_total_analyses');
    }
};
