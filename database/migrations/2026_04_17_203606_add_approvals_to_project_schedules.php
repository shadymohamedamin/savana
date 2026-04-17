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
        Schema::table('project_schedules', function (Blueprint $table) {
            $table->boolean('contractor_approved')->default(0);
            $table->boolean('owner_approved')->default(0);
            $table->boolean('consultant_approved')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_schedules', function (Blueprint $table) {
            //
        });
    }
};
