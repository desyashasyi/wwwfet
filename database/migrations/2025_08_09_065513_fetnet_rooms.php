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
        Schema::create('fetnet_rooms', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('name', 50)->nullable();
            $table->string('code', 50)->nullable();
            $table->integer('activities_type_id')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('client_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fetnet_rooms');
        //
    }
};
