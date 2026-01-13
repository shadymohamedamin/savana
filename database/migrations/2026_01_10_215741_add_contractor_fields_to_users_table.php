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
        Schema::table('users', function (Blueprint $table) {
            $table->string('responsible_name')->nullable()->after('role_id');
            $table->string('manager_name')->nullable()->after('responsible_name');
            $table->string('license_number')->nullable()->after('manager_name');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'responsible_name',
                'manager_name',
                'license_number'
            ]);
        });
    }

};
