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
        Schema::table('guides', function (Blueprint $table) {
            $table->string('profession')->nullable(); // Adding the profession column
        });
    }
    
    public function down()
    {
        Schema::table('guides', function (Blueprint $table) {
            $table->dropColumn('profession'); // Rolling back the profession column
        });
    }
    
};
