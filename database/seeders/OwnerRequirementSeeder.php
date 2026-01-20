<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OwnerRequirement;

class OwnerRequirementSeeder extends Seeder
{
    public function run(): void
    {
        $items = [

            // ======================
            // الدور الأرضي
            // ======================
            ['جلسة يومية', 'ground', false],
            ['صالة ضيوف', 'ground', true],
            ['غرفة ضيوف', 'ground', true],
            ['مجلس نساء', 'ground', true],
            ['مجلس رجال', 'ground', false],
            ['مطبخ نظيف', 'ground', true],
            ['مخزن', 'ground', false],
            ['صالة مفتوحة', 'ground', true],
            ['مطبخ تحضيري', 'ground', true],
            ['غرفة شغالة', 'ground', true],
            ['غسيل وكي', 'ground', true],
            ['مطبخ قلي', 'ground', true],
            ['مسبح', 'ground', true],
            ['مصعد', 'ground', true],

            // ======================
            // الدور الأول
            // ======================
            ['غرفة ماستر', 'first', false],
            ['غرفة أطفال', 'first', true],
            ['غرفة غسل وكوي', 'first', false],
            ['مخزن', 'first', true],
            ['غرفة الشغالة + حمام', 'first', true],
            ['مطبخ', 'first', false],
        ];

        foreach ($items as $item) {
            OwnerRequirement::firstOrCreate(
                [
                    'name'  => $item[0],
                    'floor' => $item[1],
                ],
                [
                    'is_general' => $item[2],
                ]
            );
        }
    }
}
