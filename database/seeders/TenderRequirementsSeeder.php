<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OwnerRequirement;

class TenderRequirementsSeeder extends Seeder
{
    public function run()
    {
        /*
        =====================================================
        1️⃣ أولا : أعمال الهيكل
        =====================================================
        */

        $mainStructure = OwnerRequirement::create([
            'name_ar' => 'أولا : أعمال الهيكل',
            'name_en' => 'Main Structure',
            'floor' => 'tender',
            'type' => 'group',
            'is_general' => 0,
        ]);

        /*
        ================= A =================
        */
        $A = OwnerRequirement::create([
            'name_ar' => 'أعمال المياه الجوفية و إحلال التربة و تجهيز الموقع',
            'name_en' => 'Dewatering , Soil Replacement and Mobilization',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
        ]);

        $this->item($A,'تجفيف المياه الجوفية','Dewatering','L.S');
        $this->item($A,'إحلال التربة','Soil Replacement','L.S');
        $this->item($A,'تجهيز الموقع','Mobilization','L.S');

        /*
        ================= B =================
        */
        $B = OwnerRequirement::create([
            'name_ar' => 'أعمال تحت منسوب الأرض',
            'name_en' => 'Substructure Works',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
        ]);

        $this->item($B,'الحفر','Excavation','M3');
        $this->item($B,'الرودبيس','Road Base','M3');
        $this->item($B,'خرسانة أسفل القواعد','PCC under foundation','M3');
        $this->item($B,'خرسانة للقواعد','RCC Foundation','M3');
        $this->item($B,'خرسانة مسلحة رقاب أعمدة','Neck Columns','M3');
        $this->item($B,'طابوق مصمت أسفل الجسور الأرضية','Solid block under tie beams','M2');
        $this->item($B,'الجسور الأرضية','Tie Beams','M3');
        $this->item($B,'عزل تحت منسوب الأرض','Water proof for substructure','L.S');
        $this->item($B,'لوحات البولي ايثيلين','Polythene sheet','L.S');
        $this->item($B,'الدفان والدمك','Back filling and compaction','M3');
        $this->item($B,'الخرسانة الأرضية','Flooring','M3');
        $this->item($B,'معالجة النمل الأبيض (3 مرات)','Anti termite','L.S');
        $this->item($B,'غرفة المياه تحت الأرض','Under ground water tank','L.S');
        $this->item($B,'غرفة استرجاع مياه التكييف','Under ground tank for AC water','L.S');
        $this->item($B,'بالوعة الصرف الصحي','Septic tank','L.S');
        $this->item($B,'توريد وتركيب أعمال المناهيل','Manhole works','No');

        /*
        ================= C =================
        */
        $C = OwnerRequirement::create([
            'name_ar' => 'أعمال فوق منسوب الأرض',
            'name_en' => 'Super Structure',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
        ]);

        $this->item($C,'خرسانة مسلحة للأعمدة الأرضي','GF Columns','M3');
        $this->item($C,'خرسانة مسلحة للسقف الأرضي','GF Slab','M3');
        $this->item($C,'خرسانة مسلحة أعمدة الدور الأول','1st floor Columns','M3');
        $this->item($C,'خرسانة مسلحة للسقف الأول','1st floor Slab','M3');
        $this->item($C,'خرسانة الروف','Roof slab','M3');
        $this->item($C,'خرسانة مسلحة السلالم الداخلية','RCC for internal stairs','M3');
        $this->item($C,'خرسانة مسلحة السلالم الخارجية','RCC for external stairs','M3');
        $this->item($C,'خرسانة الأعتاب والأقواس','Lintels','L.M');
        $this->item($C,'خرسانة مسلحة للباربيت','RCC Parapet','M3');
        $this->item($C,'خرسانة مسلحة للكورنيش','Concrete for decoration','M3');

        /*
        ================= D =================
        */
        $D = OwnerRequirement::create([
            'name_ar' => 'أعمال الطابوق',
            'name_en' => 'Block Works',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
        ]);

        $this->item($D,'طابوق خالي 25 سم','Hollow Block 25cm','M2');
        $this->item($D,'طابوق معزول 25 سم','Insulated Block 25cm','M2');
        $this->item($D,'طابوق 20 سم معزول','Insulated Block 20cm','M2');
        $this->item($D,'طابوق خالي 20 سم','Hollow Block 20cm','M2');
        $this->item($D,'طابوق خالي 15 سم','Hollow Block 15cm','M2');
        $this->item($D,'طابوق خالي 10 سم','Hollow Block 10cm','M2');

        /*
        ================= E =================
        */
        $E = OwnerRequirement::create([
            'name_ar' => 'أعمال البلاستر',
            'name_en' => 'Plaster Works',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
        ]);

        $this->item($E,'بلاستر داخلي عازل','Internal Gypsum Plaster','M2');
        $this->item($E,'اسمنت بلاستر داخلي','Internal Cement Plaster','M2');
        $this->item($E,'بلاستر خارجي','External Plaster','M2');
        $this->item($E,'النعلة المخفية','Hidden Skirting','L.M');

        /*
        ================= F =================
        */
        $F = OwnerRequirement::create([
            'name_ar' => 'أعمال الطبقات العازلة',
            'name_en' => 'Waterproofing Works',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
        ]);

        $this->item($F,'عزل ممبرين 4 مم','Damp Proof Membrane','L.S');
        $this->item($F,'عزل السطح كومبو 40 مم','Combo Roof Insulation','M2');
        $this->item($F,'عزل الأسقف antifungs','Ceiling Insulation','M2');
        $this->item($F,'عزل أرضية الحمامات','Wet Area Waterproof','M2');
        $this->item($F,'عزل أرضية البلكونات','Balcony Waterproof','M2');

        /*
        ================= G =================
        */
        $G = OwnerRequirement::create([
            'name_ar' => 'تركيب اكساءات الارضيات و الجدران',
            'name_en' => 'Floors and Walls Finishing',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
        ]);

        $this->item($G,'اكساءات أرضيات المدخل الرئيسي','Flooring Main Entrance','M2');
        $this->item($G,'أرضيات درج المدخل والرامب','Steps & Ramp','M2');
        $this->item($G,'أرضيات التيراس','Balcony','M2');
        $this->item($G,'أرضيات الدور الأرضي والأول','GF & 1st Floor Flooring','M2');
        $this->item($G,'اكساء الدرج الداخلي','Internal Steps','L.M');
        $this->item($G,'اكساءات الحوائط','Wall Tiles','M2');
        $this->item($G,'النعلات','Skirting','L.M');
        $this->item($G,'حماية الأرضيات','Floor Protection','L.S');

        /*
        =====================================================
        2️⃣ ثانيا : اعمال الالكتروميكانيكال
        =====================================================
        */

        $MEPGroup = OwnerRequirement::create([
            'name_ar' => 'ثانيا : أعمال الالكتروميكانيكال',
            'name_en' => 'Electromechanical Works',
            'floor' => 'tender',
            'type' => 'group',
            'is_general' => 0,
        ]);

        $H = OwnerRequirement::create([
            'name_ar' => 'اعمال MEP حتى التسليم',
            'name_en' => 'MEP Works till Handing Over',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $MEPGroup->id,
            'is_general' => 0,
        ]);

        $this->item($H,'بايبات الصرف والتغذية','Drainage & Water Pipes','L.S');
        $this->item($H,'بايبات الكهرباء والاتصالات','Electrical Pipes','L.S');
        $this->item($H,'بايبات الشفط المركزي','Central Vacuum Pipes','L.S');
        $this->item($H,'تنفيذ الكلين اوت','Clean Out','L.S');
        $this->item($H,'انذار الحريق','Fire Alarm','L.S');
        $this->item($H,'تركيب خزانات أعلى السطح','Roof Tanks','No');
        $this->item($H,'خزان مياه تحت الأرض','Underground Tank','No');
        $this->item($H,'خزان استرجاع مياه التكييف','AC Water Tank','No');
        $this->item($H,'السخان المركزي','Central Heater','No');
        $this->item($H,'تركيب الأطقم الصحية','Sanitary Installation','L.S');
        $this->item($H,'نقاط كاميرات','Camera Points','L.S');
        $this->item($H,'أعمال أخرى حتى التسليم','Other Works','L.S');

        /*
        =====================================================
        3️⃣ ثالثا : توريد التشطيبات
        =====================================================
        */

        $SupplyGroup = OwnerRequirement::create([
            'name_ar' => 'ثالثا : توريد التشطيبات',
            'name_en' => 'Supply Finishings',
            'floor' => 'tender',
            'type' => 'group',
            'is_general' => 0,
        ]);

        $I = OwnerRequirement::create([
            'name_ar' => 'توريد اكساءات الأرضيات والجدران',
            'name_en' => 'Supply Porcelain',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $SupplyGroup->id,
            'is_general' => 0,
        ]);

        $this->item($I,'توريد أرضيات المدخل','Supply Main Entrance','M2');
        $this->item($I,'توريد درج المدخل','Supply Steps','M2');
        $this->item($I,'توريد أرضيات التيراس','Supply Balcony','M2');
        $this->item($I,'توريد أرضيات عامة','Supply GF & 1st','M2');
        $this->item($I,'توريد درج داخلي','Supply Internal Steps','L.M');
        $this->item($I,'توريد حوائط','Supply Wall Tiles','M2');
        $this->item($I,'توريد نعلات','Supply Skirting','L.M');

        /*
        باقي الأقسام J → Q
        */

        $sections = [
            'J' => ['توريد الألمنيوم والزجاج والهاندريل','Aluminum & Handrail'],
            'K' => ['توريد الأبواب الخشبية','Wooden Doors'],
            'L' => ['توريد سويتشات و سوكت','Switches & Sockets'],
            'M' => ['توريد الأطقم الصحية','Sanitary Supply'],
            'N' => ['توريد اعمال الكتروميكانيكال','MEP Supply'],
            'O' => ['توريد أبواب السور و سلم الخدمات','Wall Gates'],
            'P' => ['أعمال الواجهات','Elevation Works'],
            'Q' => ['أعمال السور','Boundary Wall'],
        ];

        foreach ($sections as $sec){
            OwnerRequirement::create([
                'name_ar' => $sec[0],
                'name_en' => $sec[1],
                'floor' => 'tender',
                'type' => 'section',
                'parent_id' => $SupplyGroup->id,
                'is_general' => 0,
            ]);
        }
    }

    private function item($parent,$ar,$en,$unit)
    {
        OwnerRequirement::create([
            'name_ar' => $ar,
            'name_en' => $en,
            'unit' => $unit,
            'floor' => 'tender',
            'type' => 'item',
            'parent_id' => $parent->id,
            'is_general' => 0,
        ]);
    }
}
