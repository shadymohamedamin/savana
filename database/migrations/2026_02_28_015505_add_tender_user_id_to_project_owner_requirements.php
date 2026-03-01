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
        Schema::table('project_owner_requirements', function (Blueprint $table) {
            $table->unsignedBigInteger('tender_user_id')->nullable()->after('context');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_owner_requirements', function (Blueprint $table) {
            //
        });
    }
};
