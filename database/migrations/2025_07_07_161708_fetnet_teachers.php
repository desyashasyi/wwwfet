<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fetnet_teacher', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable();
            $table->char('code', 3)->nullable();
            $table->char('univ_code', 4)->nullable();
            $table->char('employee_id', 20)->nullable();
            $table->string('front_title', 15)->nullable();
            $table->string('rear_title', 20)->nullable();
            $table->string('name', 200)->nullable();
            $table->integer('specialization_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('email', 30)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fetne_teacher');
    }
};
