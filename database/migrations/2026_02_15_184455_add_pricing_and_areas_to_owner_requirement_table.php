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
        Schema::table('owner_requirements', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            $table->string('type')->default('item'); //section
            // section | item

            $table->string('name_ar')->after('name');
            $table->string('name_en')->nullable()->after('name_ar');

            $table->decimal('total_price', 14, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owner_requirements', function (Blueprint $table) {
            //
        });
    }
};
