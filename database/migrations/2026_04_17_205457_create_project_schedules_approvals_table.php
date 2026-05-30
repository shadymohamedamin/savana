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
        Schema::create('project_schedules_approvals', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('project_id');
    $table->unsignedBigInteger('batch_id');

    $table->boolean('contractor_approved')->default(0);
    $table->boolean('owner_approved')->default(0);
    $table->boolean('consultant_approved')->default(0);

    $table->timestamps();

    $table->unique(['project_id', 'batch_id']); // مهم جدًا
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_schedules_approvals');
    }
};
