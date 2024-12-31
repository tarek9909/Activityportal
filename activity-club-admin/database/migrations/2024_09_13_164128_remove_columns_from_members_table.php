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
            // Dropping the unnecessary columns from the 'members' table
            $table->dropColumn(['mobile_number', 'emergency_number', 'photo', 'profession', 'nationality']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('members', function (Blueprint $table) {
            // Adding the dropped columns back in case of rollback
            $table->string('mobile_number')->nullable();
            $table->string('emergency_number')->nullable();
            $table->string('photo')->nullable();
            $table->string('profession')->nullable();
            $table->string('nationality')->nullable();
        });
    }
};
