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
      Schema::create('project_schedules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('project_id')->constrained()->cascadeOnDelete();

        $table->integer('item_no')->nullable(); // رقم البند
        $table->string('title')->nullable(); // بيان الأعمال

        $table->integer('payment_percentage')->nullable(); // نسبة الدفعة
        $table->integer('completion_percentage')->nullable(); // نسبة الإنجاز
        $table->integer('duration_days')->nullable(); // المدة

        $table->integer('amount')->nullable(); // قيمة الدفعة

        $table->text('notes')->nullable(); // ملاحظات (زي: دفعة بنك)

        $table->date('due_date')->nullable(); // تاريخ متوقع (اختياري)

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
};
