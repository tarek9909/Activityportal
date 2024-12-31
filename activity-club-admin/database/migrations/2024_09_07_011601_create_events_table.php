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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->unsignedBigInteger('category_id'); // Lookup reference
        $table->string('destination');
        $table->date('date_from');
        $table->date('date_to');
        $table->decimal('cost', 8, 2);
        $table->enum('status', ['Planned', 'Ongoing', 'Completed', 'Cancelled']);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
