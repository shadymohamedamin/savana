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
        $table->enum('tender_status', ['draft', 'submitted', 'approved'])
              ->default('draft')
              ->after('finalTotal');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('project_users', function (Blueprint $table) {
        $table->dropColumn('tender_status');
    });
}
};
