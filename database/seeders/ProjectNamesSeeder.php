<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['ar' => 'فيلا ارضي', 'en' => 'Ground Floor Villa'],
            ['ar' => 'فيلا ارضي مع ملحق', 'en' => 'Ground Floor Villa with Annex'],
            ['ar' => 'فيلا ارضي ملحق سور', 'en' => 'Ground Floor Villa with Annex & Fence'],
            ['ar' => 'فيلا ارضي مع سور', 'en' => 'Ground Floor Villa with Fence'],
            ['ar' => 'فيلا ارضي + ملحق + مجلس + سور', 'en' => 'Ground Floor Villa + Annex + Majlis + Fence'],
            ['ar' => 'فيلا ارضي + اول مع سور', 'en' => 'Ground + First Floor Villa with Fence'],
            ['ar' => 'فيلا ارضي + اول', 'en' => 'Ground + First Floor Villa'],
            ['ar' => 'فيلا + ارضي + اول + ملحق مع سور', 'en' => 'Villa Ground + First + Annex with Fence'],
            ['ar' => 'فيلا ارضي + اول + ملحق + مجلس + سور', 'en' => 'Ground + First + Annex + Majlis + Fence'],
            ['ar' => 'فيلا مع ارضي + اول + سطح', 'en' => 'Villa Ground + First + Roof'],
            ['ar' => 'فيلا مع ارضي + اول + سطح مع سور', 'en' => 'Villa Ground + First + Roof with Fence'],
            ['ar' => 'فيلا مع ارضي + اول + سطح مع سور مع مجلس', 'en' => 'Villa Ground + First + Roof + Fence + Majlis'],
        ];

        foreach ($items as $item) {
            \App\Models\ProjectName::firstOrCreate(
                ['name_ar' => $item['ar']],
                [
                    'name_en' => $item['en'],
                    'status'  => 1
                ]
            );
        }
    }
}
