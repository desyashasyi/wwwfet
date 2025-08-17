<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsysInstitutionFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_faculty', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('code', 10)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('name_eng', 50)->nullable();
            $table->integer('university_id')->nullable();
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
        Schema::dropIfExists('institution_faculty');
    }
}
