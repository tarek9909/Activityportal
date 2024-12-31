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
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedInteger('max_seats')->default(0); // Maximum number of seats for the event
            $table->unsignedInteger('enrolled_users')->default(0); // Number of users enrolled in the event
            $table->boolean('is_published')->default(false); // Published status of the event
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('max_seats');
            $table->dropColumn('enrolled_users');
            $table->dropColumn('is_published');
        });
    }
};
