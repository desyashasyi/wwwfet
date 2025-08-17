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
        Schema::create('fetnet_students', function (Blueprint $table) {
        $table->integer('id')->primary()->autoIncrement();
        $table->string('name', 50)->nullable();
        $table->string('batch', 50)->nullable();
        $table->integer('number_of_student')->nullable();
        $table->integer('program_id')->nullable();
        $table->integer('parent_id')->nullable();
        $table->timestamps();
    });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('fetnet_students');
        //
    }
};
