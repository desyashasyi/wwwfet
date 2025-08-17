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
        Schema::create('fetnet_subject_type', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->char('code', 10)->nullable();
            $table->char('name', 50)->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('fetnet_subject_specialization');
    }
};
