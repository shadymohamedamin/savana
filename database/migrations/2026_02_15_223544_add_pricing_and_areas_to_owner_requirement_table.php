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
        Schema::table('project_owner_specifications', function (Blueprint $table) {
            $table->string('feeding_pipe_install')->nullable();
            $table->string('feeding_pipe_routing')->nullable();
            $table->string('fence_grooves')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owner_requirement', function (Blueprint $table) {
            //
        });
    }
};
