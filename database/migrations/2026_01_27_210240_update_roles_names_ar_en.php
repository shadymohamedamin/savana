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
        /**
         * 1️⃣ set name_en = Role for all roles
         */
        DB::table('roles')->update([
            'name_en' => DB::raw('Role')
        ]);

        /**
         * 2️⃣ update Arabic names
         */
        DB::table('roles')->where('Role', 'admin')->update([
            'name_ar' => 'أدمن'
        ]);

        DB::table('roles')->where('Role', 'owner')->update([
            'name_ar' => 'مالك'
        ]);

        DB::table('roles')->where('Role', 'contractor')->update([
            'name_ar' => 'مقاول'
        ]);

        DB::table('roles')->where('Role', 'secretary')->update([
            'name_ar' => 'سكرتير'
        ]);

        DB::table('roles')->where('Role', 'user')->update([
            'name_ar' => 'مستخدم'
        ]);

        DB::table('roles')->where('Role', 'public_user')->update([
            'name_ar' => 'مستخدم عام'
        ]);

        DB::table('roles')->where('Role', 'consultant')->update([
            'name_ar' => 'مهندس'
        ]);

        DB::table('roles')->where('Role', 'contractor_applicant')->update([
            'name_ar' => 'مقاول مرشح'
        ]);

        /**
         * 3️⃣ Insert extra roles (if not exists)
         */
        $extraRoles = [
            ['Role' => 'architect_engineer', 'name_ar' => 'مهندس معماري'],
            ['Role' => 'civil_engineer',     'name_ar' => 'مهندس إنشائي'],
            ['Role' => 'manager',             'name_ar' => 'مدير'],
            ['Role' => 'executive_manager',   'name_ar' => 'مدير تنفيذي'],
        ];

        foreach ($extraRoles as $role) {
            DB::table('roles')->updateOrInsert(
                ['Role' => $role['Role']],
                [
                    'name_en' => $role['Role'],
                    'name_ar' => $role['name_ar'],
                    'status'  => 1,
                ]
            );
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // optional rollback
        DB::table('roles')
            ->whereIn('Role', [
                'architect_engineer',
                'civil_engineer',
                'manager',
                'executive_manager'
            ])
            ->delete();
    }
};
