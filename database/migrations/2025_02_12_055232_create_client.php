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
        Schema::create('fetnet_client', function (Blueprint $table) {

            $table->integer('id')->primary()->autoIncrement();
            $table->integer('user_id')->nullable();
            $table->integer('university_id')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('client_level_id')->nullable();
            $table->string('description', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fetnet_client');
    }
};
