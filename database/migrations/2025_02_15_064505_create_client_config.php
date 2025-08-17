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
        //
        Schema::create('fetnet_client_config', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->integer('client_id')->nullable();
            $table->integer('number_of_days')->nullable();
            $table->integer('number_of_hours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('fetnet_client_config');
    }
};
