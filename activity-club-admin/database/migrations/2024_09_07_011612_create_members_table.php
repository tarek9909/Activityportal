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
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Reference to users table
        $table->date('joining_date');
        $table->string('mobile_number');
        $table->string('emergency_number');
        $table->string('photo')->nullable();
        $table->string('profession');
        $table->string('nationality');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
