<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsysInstitutionProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_program', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->integer('client_id')->nullable();
            $table->integer('level_id')->nullable();
            $table->string('code', 10)->nullable();
            $table->string('abbrev', 10)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('letter_code')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('institution_program');
    }
}
