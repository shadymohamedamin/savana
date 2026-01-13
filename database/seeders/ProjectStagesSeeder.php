<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use OwenIt\Auditing\Drivers\Database;
use App\Models\ProjectStage;

class ProjectStagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stages = [
            ['name_ar' => 'التصميم',     'name_en' => 'Design',      'order' => 1],
            ['name_ar' => 'المناقصة',    'name_en' => 'Tender',      'order' => 2],
            ['name_ar' => 'الإشراف',     'name_en' => 'Supervision', 'order' => 3],
            ['name_ar' => 'الدفعات',     'name_en' => 'Payments',    'order' => 4],
            ['name_ar' => 'مكتمل',       'name_en' => 'Completed',   'order' => 5],
        ];

        foreach ($stages as $stage) {
            ProjectStage::updateOrCreate(
                ['order' => $stage['order']],
                $stage
            );
        }
    }
}
