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
        Schema::table('baladya_approvals', function (Blueprint $table) {
            $table->string('building_license_number')->nullable();
            $table->string('building_license_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baladya_approvals', function (Blueprint $table) {
            $table->dropColumn(['building_license_number', 'building_license_file']);
        });
    }
};
