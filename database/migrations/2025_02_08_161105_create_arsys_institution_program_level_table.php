<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsysInstitutionProgramLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_program_level', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->char('code', 10)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('name_eng', 50)->nullable();
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
        Schema::dropIfExists('institution_program_level');
    }
}
