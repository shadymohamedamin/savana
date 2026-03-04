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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_system_account')->default(0);
            //$table->bigInteger('project_owner_support')->default(0);
            /*$table->string('civil_file')->nullable();
            $table->string('electrical_file')->nullable();
            $table->string('water_file')->nullable();
            $table->string('etisalat_file')->nullable();*/
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
