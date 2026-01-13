<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BaladyaStatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('baladya_status_types')->insert([
            ['name_ar' => 'رخصة جديدة',     'name_en' => 'New License'],
            ['name_ar' => 'تعديل وإضافة',   'name_en' => 'Modification'],
            ['name_ar' => 'اعتماد مخطط',    'name_en' => 'Plan Approval'],
        ]);


    }
}
