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
        Schema::create('project_payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('payment_no'); // دفعة 1، 2، 3…

            $table->string('payer_type')->nullable(); // بنك / مالك

            $table->decimal('total_amount', 15, 2); // المدخل
            $table->decimal('vat_amount', 15, 2)->default(0); // الضريبة
            $table->decimal('net_amount', 15, 2)->default(0); // بدون ضريبة

            $table->date('payment_date')->nullable();

            $table->string('attachment')->nullable(); // ملف الدفعة

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_payments');
    }
};
