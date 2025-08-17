<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsysInstitutionClusterBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fetnet_cluster_base', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->integer('client_id')->nullable();
            $table->string('code', 5)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('name_eng', 50)->nullable();
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
        Schema::dropIfExists('institution_cluster_base');
    }
}
