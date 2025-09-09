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
        Schema::create('fetnet_activities', function (Blueprint $table) {

            $table->integer('id')->primary()->autoIncrement();
            $table->integer('semester_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('duration')->nullable();
            $table->boolean('active')->nullable();
            $table->integer('type_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('fetnet_activities');
    }
};
