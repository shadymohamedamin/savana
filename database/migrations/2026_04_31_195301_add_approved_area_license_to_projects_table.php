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
        Schema::create('project_messages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->constrained()->cascadeOnDelete();

            $table->foreignId('sender_id')->constrained('users');
            $table->foreignId('receiver_id')->constrained('users');

            $table->foreignId('cc_user_id')->nullable()->constrained('users');

            $table->foreignId('message_type_id')->constrained('message_types');

            $table->text('message');

            $table->string('attachment')->nullable(); // 👈 ملف واحد فقط

            $table->timestamps();
        });

        /*Schema::create('message_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });*/
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
