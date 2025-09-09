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
        Schema::create('fetnet_activity_types', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('name', 50)->nullable();
            $table->timestamps();
        });

        \App\Models\FetNet\ActivityType::create([
            'name' => 'Theory',
        ]);
        \App\Models\FetNet\ActivityType::create([
            'name' => 'Laboratory',
        ]);
        \App\Models\FetNet\ActivityType::create([
            'name' => 'Studio',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('fetnet_activity_types');

    }
};
