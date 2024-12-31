<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_number')->nullable(); // Add mobile number column
            $table->string('emergency_number')->nullable(); // Add emergency number column
            $table->string('nationality')->nullable(); // Add nationality column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobile_number'); // Remove mobile number
            $table->dropColumn('emergency_number'); // Remove emergency number
            $table->dropColumn('nationality'); // Remove nationality
        });
    }
};
