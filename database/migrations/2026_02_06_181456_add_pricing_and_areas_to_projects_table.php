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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('foot_price')
                  ->nullable()
                  ->after('bank_contract_value');

            // المساحة المعتمدة من البلدية
            $table->string('approved_area')
                  ->nullable()
                  ->after('foot_price');

            // مساحة المتر الطولي
            $table->string('linear_meter_area')
                  ->nullable()
                  ->after('approved_area');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'foot_price',
                'approved_area',
                'linear_meter_area'
            ]);
        });
    }
};
