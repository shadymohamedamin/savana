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
        Schema::table('project_users', function (Blueprint $table) {
            $table->string('context')->default('tender');
            $table->decimal('structureElectro', 15, 2)->default(0);
            $table->decimal('structureWithFinishes', 15, 2)->default(0);
            $table->decimal('footWithout', 15, 2)->default(0);
            $table->decimal('footWith', 15, 2)->default(0);
            $table->decimal('boundaryWall', 15, 2)->default(0);
            $table->decimal('villaWithWall', 15, 2)->default(0);
            $table->decimal('vat', 15, 2)->default(0);
            $table->decimal('finalTotal', 15, 2)->default(0);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_users', function (Blueprint $table) {
            //
        });
    }
};
