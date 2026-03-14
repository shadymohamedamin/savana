<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // احذف الجدول القديم لو موجود
        Schema::dropIfExists('owner_requirements_tenders_totals');

        // أنشئ الجدول الجديد
        Schema::create('owner_requirements_tenders_totals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                  ->constrained()
                  ->cascadeOnDelete()
                  ->comment('FK to projects')
                  ->index('idx_project');

            $table->foreignId('tender_user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->comment('FK to users')
                  ->index('idx_tender_user');

            // الأعمدة المالية
            $table->decimal('structureElectro', 15, 2)->default(0);
            $table->decimal('structureWithFinishes', 15, 2)->default(0);
            $table->decimal('footWithout', 15, 2)->default(0);
            $table->decimal('footWith', 15, 2)->default(0);
            $table->decimal('boundaryWall', 15, 2)->default(0);
            $table->decimal('villaWithWall', 15, 2)->default(0);
            $table->decimal('vat', 15, 2)->default(0);
            $table->decimal('finalTotal', 15, 2)->default(0);

            $table->timestamps();

            // unique index لتجنب تكرار المشروع + المستخدم
            $table->unique(['project_id', 'tender_user_id'], 'unique_project_tender');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('owner_requirements_tenders_totals');
    }
};