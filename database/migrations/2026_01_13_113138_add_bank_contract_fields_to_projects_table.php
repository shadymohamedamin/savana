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
            $table->decimal('bank_contract_value', 15, 2)
                  ->nullable()
                  ->after('budget');

            $table->integer('bank_contract_duration')
                  ->nullable()
                  ->comment('Duration in months')
                  ->after('bank_contract_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'bank_contract_value',
                'bank_contract_duration',
            ]);
        });
    }
};
