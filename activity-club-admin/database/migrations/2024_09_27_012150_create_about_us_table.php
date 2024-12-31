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
    Schema::create('about_us', function (Blueprint $table) {
        $table->id();
        $table->text('brief');     // For the brief description
        $table->text('vision');    // For the vision
        $table->text('mission');   // For the mission
        $table->timestamps();      // Adds created_at and updated_at timestamps
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
