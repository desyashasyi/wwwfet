<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsysInstitutionProgramLetterBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_program_letter_base', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->char('code', 10)->nullable();
            $table->string('description', 100)->nullable();
            $table->string('ina_description', 100)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institution_program_letter_base');
    }
}
