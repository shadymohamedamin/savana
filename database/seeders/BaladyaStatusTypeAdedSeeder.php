<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaladyaStatusTypeAdedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name_ar' => 'حفر',
                'name_en' => 'Excavation',
                'active'  => 1,
            ],
            [
                'name_ar' => 'تسليم قواعد',
                'name_en' => 'Foundation Handover',
                'active'  => 1,
            ],
            [
                'name_ar' => 'جسور ارضية',
                'name_en' => 'Foundation2 Casting',
                'active'  => 1,
            ],
            [
                'name_ar' => 'صب اعمدة الارضي',
                'name_en' => 'Excavat3333ion',
                'active'  => 1,
            ],
            [
                'name_ar' => 'صب سقف الارضي',
                'name_en' => 'Excava44t3333ion',
                'active'  => 1,
            ],
            [
                'name_ar' => 'صب اعمدة الاول',
                'name_en' => 'Excav34at3333ion',
                'active'  => 1,
            ],
            [
                'name_ar' => 'صب سقف الاول',
                'name_en' => 'Exca4345va44t3333ion',
                'active'  => 1,
            ],
            [
                'name_ar' => 'صب قواعد السور',
                'name_en' => 'Final Approval',
                'active'  => 1,
            ],
        ];

        foreach ($statuses as $status) {
            DB::table('baladya_status_types')->updateOrInsert(
                ['name_ar' => $status['name_ar']], // يمنع التكرار
                $status
            );
        }
    }
}
