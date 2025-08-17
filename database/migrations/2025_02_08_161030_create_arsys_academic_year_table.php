<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsysAcademicYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_year', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->integer('university_id')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('cluster_id')->nullable();
            $table->char('academic_year', 11)->nullable();
            $table->dateTime('letter_date')->nullable();
            $table->string('semester')->nullable();
            $table->integer('numbering')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_a')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_year');
    }
}
