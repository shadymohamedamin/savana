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
        OwnerRequirement::where('floor', 'tender')->delete();

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
        $this->item($B,'غرفة  استرجاع مياه التكييف تحت الأرض','Under ground tank for AC water','L.S');
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
        $this->item($C,' خرسانة الأعتاب والأقواس ولنتل ','Lintels','L.M');
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

        $this->item($F,' عزل ممبرين4 مم أسفل الجدران الخارجية','Damp Proof Membrane','L.S');
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

        $this->item($G,'اكساءات ارضيات  للمدخل الرئيسي للفيلا ','Flooring Main Entrance','M2');
        $this->item($G,'أرضيات درج المدخل الرئيسي والرامب','Steps & Ramp','M2');
        $this->item($G,'أرضيات التيراس بالدور الاول ان وجد','Balcony','M2');
        $this->item($G,'اكساءات ارضيات الدور الاول و الارض','GF & 1st Floor Flooring','M2');
        $this->item($G,'اكساء الدرج الداخلي للفيلا.','Internal Steps','L.M');
        $this->item($G,'اكساءات الحوائط','Wall Tiles','M2');
        $this->item($G,' النعلات حسب المواصافات','Skirting','L.M');
        $this->item($G,' حماية من البلاستيك و الجبس للارضيات ','Floor Protection','L.S');

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

        // $this->item($H,'بايبات الصرف والتغذية','Drainage & Water Pipes','L.S');
        // $this->item($H,'بايبات الكهرباء والاتصالات','Electrical Pipes','L.S');
        // $this->item($H,'بايبات الشفط المركزي','Central Vacuum Pipes','L.S');
        // $this->item($H,'تنفيذ الكلين اوت','Clean Out','L.S');
        // $this->item($H,'انذار الحريق','Fire Alarm','L.S');
        // $this->item($H,'تركيب خزانات أعلى السطح','Roof Tanks','No');
        // $this->item($H,'خزان مياه تحت الأرض','Underground Tank','No');
        // $this->item($H,'خزان استرجاع مياه التكييف','AC Water Tank','No');
        // $this->item($H,'السخان المركزي','Central Heater','No');
        // $this->item($H,'تركيب الأطقم الصحية','Sanitary Installation','L.S');
        // $this->item($H,'نقاط كاميرات','Camera Points','L.S');
        // $this->item($H,'أعمال أخرى حتى التسليم','Other Works','L.S');
$this->item($H,'توريد وتركيب بايبات الصرف و التغذية','Supply and install drainage and water pipes','L.S');
$this->item($H,'توريد وتركيب يايبات الكهرباء و الاتصالات','Supply and install electrical and communication pipes','L.S');
$this->item($H,'توريد وتركيب بايبات الشفط المركزي','Supply and install central vacuum pipes','L.S');
$this->item($H,'تنفيذ الكلين اوت','Execute clean out','L.S');
$this->item($H,'انذار الحريق  و انارة الطوارئ','Fire alarm and emergency lighting','L.S');
$this->item($H,'تركيب خزانات المياه أعلى السطح','Install water tanks above roof','No');
$this->item($H,'تركيب خزان مياه تحت الأرض','Install underground water tank','No');
$this->item($H,'تركيب  خزان استرجاع مياه التكييف','Install AC water recovery tank','No');
$this->item($H,'تركيب السخان المركزي','Install central heater','No');
$this->item($H,'تركيب  الأطقم الصحية','Install sanitary wares','L.S');
$this->item($H,'تأسيس 9 نقاط كاميرا','Establish 9 camera points','L.S');
$this->item($H,'توريد وتركيب باقي أعمال حتي التسليم','Supply and install remaining works until handover','L.S');

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

        $this->item($I,'اكساءات ارضيات  للمدخل الرئيسي للفيلا','Floor finishes for main entrance of the villa','M2');
$this->item($I,'أرضيات درج المدخل الرئيسي والرامب','Main entrance stairs and ramp flooring','M2');
$this->item($I,'أرضيات التيراس بالدور الاول ان وجد','First floor terrace flooring if any','M2');
$this->item($I,'اكساءات ارضيات الدور الاول و الارض','Ground and first floor flooring finishes','M2');
$this->item($I,'اكساء الدرج الداخلي للفيلا.','Internal villa staircase cladding','L.M');
$this->item($I,'اكساءات حوائط','Wall finishes','M2');
$this->item($I,'النعلات حسب المواصافات','Skirting as per specifications','L.M');

        /*
        باقي الأقسام J → Q
        */

        










/*
=====================================================
J : توريد الألمنيوم والزجاج والهاندريل
=====================================================
*/

$J = OwnerRequirement::create([
    'name_ar' => 'توريد الألمنيوم والزجاج والهاندريل',
    'name_en' => 'Supply and install aluminum and handrail',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
]);

$this->item($J,'توريد و تركيب الالمنيوم و الزجاج','Supply and install aluminum and glass','M2');
$this->item($J,'الهاندريل للدرج والدابل هايت','Handrail for Stairs and Double height','L.M');


/*
=====================================================
K : توريد الأبواب الخشبية
=====================================================
*/

$K = OwnerRequirement::create([
    'name_ar' => 'توريد الأبواب الخشبية توريد و تركيب',
    'name_en' => 'Supply and install wooden doors',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
]);

$this->item($K,'الباب الخارجي للفيلا الارتفاع','Main entrance Door','No');
$this->item($K,'الباب الخارجي للمجلس الارتفاع','Majlis Door','No');
$this->item($K,'أبواب الغرف والحمامات','Rooms and toilet doors','No');
$this->item($K,'أبواب الغرف الخدمية الارتفاع','Services room doors','No');


/*
=====================================================
L : توريد سويتشات و سوكت
=====================================================
*/

$L = OwnerRequirement::create([
    'name_ar' => 'توريد سويتشات و سوكت',
    'name_en' => 'Supply switches and sockets',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
]);

$this->item($L,'سعر توريد السوكتات','Supply sockets','PICE');
$this->item($L,'سعر توريد السويتشات','Supply switches','PICE');


/*
=====================================================
M : توريد الأطقم الصحية
=====================================================
*/

$M = OwnerRequirement::create([
    'name_ar' => 'توريد الأطقم الصحية',
    'name_en' => 'Supply Sanitary wares',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
]);

$this->item($M,'الاطقم الصحية لحمام مغاسل الصالة و المجلس','Sanitary ware and counter for Salaa and Majlis toilets','No');
$this->item($M,'الاطقم الصحية لحمام ومغاسل غرف النوم','Sanitary ware and counter for bed rooms toilets','No');
$this->item($M,'الاطقم الصحية لحمام ومغاسل غرفة الشغالة','Sanitary ware and counter for maid room toilet','No');
$this->item($M,'توريد خلاط المطبخ','Kitchen mixer','No');


/*
=====================================================
N : اعمال توريد الالكتروميكانيكال
=====================================================
*/

$N = OwnerRequirement::create([
    'name_ar' => 'اعمال توريد الالكتروميكانيكال',
    'name_en' => 'Supply of electromechanical',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
]);

$this->item($N,'مضخات نوعية ممتازة','Pumps - best quality','PICE');
$this->item($N,'خزانات المياه أعلى السطح','Water tanks above roof','No');
$this->item($N,'خزان مياه تحت الأرض','Under ground water tank','No');
$this->item($N,'خزان استرجاع مياه التكييف','Water tanks for AC water','No');
$this->item($N,'السخان المركزي','Central Heater','No');


/*
=====================================================
O : توريد و تركيب أبواب السور و سلم الخدمات
=====================================================
*/

$O = OwnerRequirement::create([
    'name_ar' => 'توريد و تركيب أبواب السور و سلم الخدمات',
    'name_en' => 'Supply and install wall gates and services stair',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
]);

$this->item($O,'بابي السور باب كبير و باب صغير','Boundary wall gates Big and small','L.S');
$this->item($O,'سلم خارجي معدني','External Steel stair','L.S');


/*
=====================================================
P : أعمال الواجهات
=====================================================
*/

/*$P = OwnerRequirement::create([
    'name_ar' => 'أعمال الواجهات توريد و تركيب',
    'name_en' => 'Elevation Works supply and install',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
]);*/




/*
=====================================================
4️⃣ رابعاً : أعمال الواجهات
=====================================================
*/

$ElevationGroup = OwnerRequirement::create([
    'name_ar' => 'رابعا : أعمال الواجهات',
    'name_en' => 'Elevation Works',
    'floor' => 'tender',
    'type' => 'group', // 👈 جروب
    'is_general' => 0,
]);

$P = OwnerRequirement::create([
    'name_ar' => 'أعمال الواجهات توريد و تركيب',
    'name_en' => 'Elevation Works supply and install',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $ElevationGroup->id, // 👈 تابع للجروب الجديد
    'is_general' => 0,
]);


$this->item($P,'تيوبات كاست المنيوم خامة حسب 3د','Cast Aluminum Tubes Same 3d','L.S');
$this->item($P,'تنفيذ طبقين معجون خارجي للكورنيش مع صبغ باللون الاسود حسب 3د ان وجد','2 layers stucco','L.S');
$this->item($P,'أصباغ خارجية لحوائط الفيلا','External Painting for villa','M2');
$this->item($P,'الومنيوم شيت خامة حسب مناظير 3د ان وجد','Aluminum sheet same 3d','M2');
$this->item($P,'توريد و تركيب بورسلان بلاصق ممتاز','Porcelain glue best','M2');
$this->item($P,'توريد وتركيب قرميد ان وجد','Supply and install clay tiles','M2');
$this->item($P,'توريد و تركيب جي ار سي ان وجد','Supply and install GRC','M2');
$this->item($P,'توريد و تركيب الكورنيش','Supply and install decoration','L.M');


/*
=====================================================
Q : أعمال السور
=====================================================
*/

/*$Q = OwnerRequirement::create([
    'name_ar' => 'أعمال السور الخارجي للفيلا',
    'name_en' => 'Boundary Wall Works',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
]);*/



/*
=====================================================
5️⃣ خامساً : أعمال السور
=====================================================
*/

$BoundaryGroup = OwnerRequirement::create([
    'name_ar' => 'خامساً : أعمال السور',
    'name_en' => 'Boundary Wall Works',
    'floor' => 'tender',
    'type' => 'group',
    'is_general' => 0,
]);

$Q = OwnerRequirement::create([
    'name_ar' => 'أعمال السور الخارجي للفيلا',
    'name_en' => 'Boundary Wall Works Details',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $BoundaryGroup->id,
    'is_general' => 0,
]);


$this->item($Q,'أعمال تحت منسوب الارض','Substructure works','L.M');
$this->item($Q,'اعمال فوق منسوب السور بما يشمل (الخرسانة-اعمال الطابوق -اعمال بلاستر)','Super structure works (concrete - block - plaster)','M3');
$this->item($Q,'اعمال صبغ خارجي','Painting Works','M2');

















        /*$sections = [
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
        }*/
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
