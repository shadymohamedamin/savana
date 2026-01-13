<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_ar' => 'فيلا',
                'name_en' => 'Villa',
                'status'  => 1,
            ],
            [
                'name_ar' => 'فيلا مع ملحق',
                'name_en' => 'Villa with Annex',
                'status'  => 1,
            ],
            [
                'name_ar' => 'فيلا مع سور',
                'name_en' => 'Villa with Fence',
                'status'  => 1,
            ],
            [
                'name_ar' => 'فيلا مع مجلس',
                'name_en' => 'Villa with Majlis',
                'status'  => 1,
            ],
            [
                'name_ar' => 'فيلا مع ملحق مع سور',
                'name_en' => 'Villa with Annex & Fence',
                'status'  => 1,
            ],
        ];

        foreach ($data as $item) {
            \App\Models\ProjectName::updateOrCreate(
                [
                    'name_ar' => $item['name_ar'],
                ],
                $item
            );
        }
    }
}
