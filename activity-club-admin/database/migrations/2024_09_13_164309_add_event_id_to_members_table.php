<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('members', function (Blueprint $table) {
            // Adding a foreign key reference to the 'events' table
            $table->unsignedBigInteger('event_id')->nullable(); // Nullable if a member can join without an event initially
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('members', function (Blueprint $table) {
            // Dropping the 'event_id' column and its foreign key
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
        });
    }
};
