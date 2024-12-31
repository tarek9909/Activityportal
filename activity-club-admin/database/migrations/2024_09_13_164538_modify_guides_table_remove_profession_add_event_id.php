<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('guides', function (Blueprint $table) {
            // Remove the 'profession' column
            $table->dropColumn('profession');
            
            // Adding a foreign key reference to the 'events' table
            $table->unsignedBigInteger('event_id')->nullable(); // Nullable in case the guide hasn't been assigned to an event yet
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('guides', function (Blueprint $table) {
            // Add the 'profession' column back
            $table->string('profession')->nullable();
            
            // Dropping the 'event_id' column and its foreign key
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
        });
    }
};
