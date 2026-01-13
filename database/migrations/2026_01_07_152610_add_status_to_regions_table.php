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
        Schema::table('regions', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('region');
        });
    }

    public function down()
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

};
