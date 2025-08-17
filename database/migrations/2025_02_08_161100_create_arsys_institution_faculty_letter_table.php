<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsysInstitutionFacultyLetterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_faculty_letter', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->integer('faculty_id')->nullable();
            $table->integer('faculty_letter_base_id')->nullable();
            $table->string('number', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institution_faculty_letter');
    }
}
