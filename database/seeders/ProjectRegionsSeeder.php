<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ProjectRegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            [
                'name_ar' => 'الظيت',
                'name_en' => 'Al Dhait',
                'status'  => 1,
            ],
            [
                'name_ar' => 'عوافي',
                'name_en' => 'Awafi1',
                'status'  => 1,
            ],
            [
                'name_ar' => 'سيح الغب',
                'name_en' => 'Awafi2',
                'status'  => 1,
            ],
            [
                'name_ar' => 'سيح العريبي',
                'name_en' => 'Awafi3',
                'status'  => 1,
            ],
            [
                'name_ar' => 'الخران',
                'name_en' => 'Awafi4',
                'status'  => 1,
            ],
            [
                'name_ar' => 'سيح القصيدات',
                'name_en' => 'Awafi5',
                'status'  => 1,
            ],
            [
                'name_ar' => 'الشيخ زايد',
                'name_en' => 'Awafi6',
                'status'  => 1,
            ],
            [
                'name_ar' => 'الشيخ خليفة',
                'name_en' => 'Awafi7',
                'status'  => 1,
            ],
        ];

        foreach ($regions as $region) {
            DB::table('project_regions')->updateOrInsert(
                ['name_en' => $region['name_en']], // شرط عدم التكرار
                array_merge($region, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ])
            );
        }
    }
}
