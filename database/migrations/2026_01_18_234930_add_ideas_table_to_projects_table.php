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
        Schema::create('project_design_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();

            $table->string('villa_style')->nullable();        // مودرن / كلاسيك / نيو
            $table->integer('floors_count')->nullable();      // عدد الأدوار
            $table->string('villa_door')->nullable();         // مرتفع / عادي
            $table->string('villa_location')->nullable();     // قدام / نص / ورا
            $table->boolean('double_height')->default(false);
            $table->boolean('open_living')->default(false);
            $table->string('villa_connection')->nullable();   // متصل / غير متصل
            $table->decimal('ceiling_height', 3, 1)->nullable();
            $table->boolean('internal_garden_view')->default(false);
            $table->string('stairs_location')->nullable();
            $table->string('pantry_location')->nullable();
            $table->string('service_doors')->nullable();
            $table->boolean('future_elevator')->default(false);
            $table->boolean('internal_courtyard')->default(false);
            $table->string('villa_shape')->nullable();        // U / L
            $table->string('dining_serves')->nullable();
            $table->string('stairs_type')->nullable();
            $table->string('ac_type')->nullable();
            $table->string('doors_height')->nullable();
            $table->string('furniture_level')->nullable();
            $table->string('bathroom_chairs')->nullable();
            $table->boolean('underground_tank')->default(false);
            $table->string('skirting_type')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_design_preferences');
    }
};
