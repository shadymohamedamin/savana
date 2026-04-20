<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OwnerRequirement;

class TenderRequirementsSeeder extends Seeder
{
    public function run()
    {
        /*

        $B = OwnerRequirement::updateOrCreate(
[
    'slug' => 'substructure-works'
],
[
    'name_ar' => 'أعمال تحت منسوب الأرض',
    'name_en' => 'Substructure Works',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $mainStructure->id,
    'is_general' => 0,
]);
        =====================================================
        1️⃣ أولا : أعمال الهيكل
        =====================================================
        */
        OwnerRequirement::where('floor', 'tender')->delete();

        $mainStructure = OwnerRequirement::updateOrCreate([
            'name_ar' => 'أولا : أعمال الهيكل',
            'name_en' => 'Main Structure',
            'floor' => 'tender',
            'type' => 'group',
            'is_general' => 0,
            'slug' => 'main_structure',
        ]);

        /*
        ================= A =================
        */
        $A = OwnerRequirement::updateOrCreate([
            'name_ar' => 'أعمال المياه الجوفية و إحلال التربة و تجهيز الموقع',
            'name_en' => 'Dewatering , Soil Replacement and Mobilization',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
            'slug' => 'dewatering-soil-replacement', // ✅ تعديل slug ليكون فريد
        ]);

        $this->item($A,'تجفيف المياه الجوفية','Dewatering','L.S','dewatering'); // ✅ تعديل slug
        $this->item($A,'إحلال التربة','Soil Replacement','L.S','soil-replacement'); // ✅ تعديل slug
        $this->item($A,'تجهيز الموقع','Mobilization','L.S','mobilization'); // ✅ تعديل slug

        /*
        ================= B =================
        */
        $B = OwnerRequirement::updateOrCreate([
            'name_ar' => 'أعمال تحت منسوب الأرض',
            'name_en' => 'Substructure Works',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
            'slug' => 'substructure-works', // ✅ تعديل slug ليكون فريد
        ]);//'Underground Water Tank Room'

        $this->item($B,'الحفر','Excavation','M3','excavation'); // ✅ تعديل slug
        $this->item($B,'الرودبيس','Road Base','M3','road-base'); // ✅ تعديل slug
        $this->item($B,'خرسانة أسفل القواعد','PCC under foundation','M3','pcc-foundation'); // ✅ تعديل slug
        $this->item($B,'خرسانة للقواعد','RCC Foundation','M3','rcc-foundation'); // ✅ تعديل slug
        $this->item($B,'خرسانة مسلحة رقاب أعمدة','Neck Columns','M3','neck-columns'); // ✅ تعديل slug
        $this->item($B,'طابوق مصمت أسفل الجسور الأرضية','Solid block under tie beams','M2','solid-block-tie-beams'); // ✅ تعديل slug
        $this->item($B,'الجسور الأرضية','Tie Beams','M3','tie-beams'); // ✅ تعديل slug
        $this->item($B,'عزل تحت منسوب الأرض','Water proof for substructure','L.S','substructure-waterproof'); // ✅ تعديل slug
        $this->item($B,'لوحات البولي ايثيلين','Polythene sheet','L.S','polythene-sheet'); // ✅ تعديل slug
        $this->item($B,'الدفان والدمك','Back filling and compaction','M3','backfilling-compaction'); // ✅ تعديل slug
        $this->item($B,'الخرسانة الأرضية','Flooring','M3','flooring'); // ✅ تعديل slug
        $this->item($B,'معالجة النمل الأبيض (3 مرات)','Anti termite','L.S','anti-termite'); // ✅ تعديل slug
        $this->item($B,'غرفة المياه تحت الأرض','Under ground water tank','L.S','underground-water-tank'); // ✅ تعديل slug
        $this->item($B,'غرفة  استرجاع مياه التكييف تحت الأرض','Under ground tank for AC water','L.S','underground-ac-tank'); // ✅ تعديل slug
        $this->item($B,'بالوعة الصرف الصحي','Septic tank','L.S','septic-tank'); // ✅ تعديل slug
        $this->item($B,'توريد وتركيب أعمال المناهيل','Manhole works','No','manhole-works'); // ✅ تعديل slug

        /*
        ================= C =================
        */
        $C = OwnerRequirement::updateOrCreate([
            'name_ar' => 'أعمال فوق منسوب الأرض',
            'name_en' => 'Super Structure',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
            'slug' => 'super-structure', // ✅ تعديل slug ليكون فريد
        ]);

        $this->item($C,'خرسانة مسلحة للأعمدة الأرضي','GF Columns','M3','gf-columns'); // ✅ تعديل slug
        $this->item($C,'خرسانة مسلحة للسقف الأرضي','GF Slab','M3','gf-slab'); // ✅ تعديل slug
        $this->item($C,'خرسانة مسلحة أعمدة الدور الأول','1st floor Columns','M3','first-floor-columns'); // ✅ تعديل slug
        $this->item($C,'خرسانة مسلحة للسقف الأول','1st floor Slab','M3','first-floor-slab'); // ✅ تعديل slug
        $this->item($C,'خرسانة الروف','Roof slab','M3','roof-slab'); // ✅ تعديل slug
        $this->item($C,'خرسانة مسلحة السلالم الداخلية','RCC for internal stairs','M3','rcc-internal-stairs'); // ✅ تعديل slug
        $this->item($C,'خرسانة مسلحة السلالم الخارجية','RCC for external stairs','M3','rcc-external-stairs'); // ✅ تعديل slug
        $this->item($C,' خرسانة الأعتاب والأقواس ولنتل ','Lintels','L.M','lintels'); // ✅ تعديل slug
        $this->item($C,'خرسانة مسلحة للباربيت','RCC Parapet','M3','rcc-parapet'); // ✅ تعديل slug
        $this->item($C,'خرسانة مسلحة للكورنيش','Concrete for decoration','M3','concrete-decoration'); // ✅ تعديل slug

        /*
        ================= D =================
        */
        $D = OwnerRequirement::updateOrCreate([
            'name_ar' => 'أعمال الطابوق',
            'name_en' => 'Block Works',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
            'slug' => 'block-works', // ✅ تعديل slug ليكون فريد
        ]);

        $this->item($D,'طابوق خالي 25 سم','Hollow Block 25cm','M2','hollow-25'); // ✅ تعديل slug
        $this->item($D,'طابوق معزول 25 سم','Insulated Block 25cm','M2','insulated-25'); // ✅ تعديل slug
        $this->item($D,'طابوق 20 سم معزول','Insulated Block 20cm','M2','insulated-20'); // ✅ تعديل slug
        $this->item($D,'طابوق خالي 20 سم','Hollow Block 20cm','M2','hollow-20'); // ✅ تعديل slug
        $this->item($D,'طابوق خالي 15 سم','Hollow Block 15cm','M2','hollow-15'); // ✅ تعديل slug
        $this->item($D,'طابوق خالي 10 سم','Hollow Block 10cm','M2','hollow-10'); // ✅ تعديل slug

        /*
        ================= E =================
        */
        $E = OwnerRequirement::updateOrCreate([
            'name_ar' => 'أعمال البلاستر',
            'name_en' => 'Plaster Works',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
            'slug' => 'plaster-works', // ✅ تعديل slug ليكون فريد
        ]);

        $this->item($E,'بلاستر داخلي عازل','Internal Gypsum Plaster','M2','internal-gypsum-plaster'); // ✅ تعديل slug
        $this->item($E,'اسمنت بلاستر داخلي','Internal Cement Plaster','M2','internal-cement-plaster'); // ✅ تعديل slug
        $this->item($E,'بلاستر خارجي','External Plaster','M2','external-plaster'); // ✅ تعديل slug
        $this->item($E,'النعلة المخفية','Hidden Skirting','L.M','hidden-skirting'); // ✅ تعديل slug

        /*
        ================= F =================
        */
        $F = OwnerRequirement::updateOrCreate([
            'name_ar' => 'أعمال الطبقات العازلة',
            'name_en' => 'Waterproofing Works',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
            'slug' => 'waterproofing-works', // ✅ تعديل slug ليكون فريد
        ]);

        $this->item($F,' عزل ممبرين4 مم أسفل الجدران الخارجية','Damp Proof Membrane','L.S','damp-proof-membrane'); // ✅ تعديل slug
        $this->item($F,'عزل السطح كومبو 40 مم','Combo Roof Insulation','M2','combo-roof-insulation'); // ✅ تعديل slug
        $this->item($F,'عزل الأسقف antifungs','Ceiling Insulation','M2','ceiling-insulation'); // ✅ تعديل slug
        $this->item($F,'عزل أرضية الحمامات','Wet Area Waterproof','M2','wet-area-waterproof'); // ✅ تعديل slug
        $this->item($F,'عزل أرضية البلكونات','Balcony Waterproof','M2','balcony-waterproof'); // ✅ تعديل slug

        /*
        ================= G =================
        */
        $G = OwnerRequirement::updateOrCreate([
            'name_ar' => 'تركيب اكساءات الارضيات و الجدران',
            'name_en' => 'Floors and Walls Finishing',
            'floor' => 'tender',
            'type' => 'section',
            'parent_id' => $mainStructure->id,
            'is_general' => 0,
            'slug' => 'floors-walls-finishing', // ✅ تعديل slug ليكون فريد
        ]);

        $this->item($G,'اكساءات ارضيات  للمدخل الرئيسي للفيلا ','Flooring Main Entrance','M2','flooring-main-entrance'); // ✅ تعديل slug
        $this->item($G,'أرضيات درج المدخل الرئيسي والرامب','Steps & Ramp','M2','steps-ramp'); // ✅ تعديل slug
        $this->item($G,'أرضيات التيراس بالدور الاول ان وجد','Balcony','M2','balcony-first-floor'); // ✅ تعديل slug
        $this->item($G,'اكساءات ارضيات الدور الاول و الارض','GF & 1st Floor Flooring','M2','gf-1st-floor-flooring'); // ✅ تعديل slug
        $this->item($G,'اكساء الدرج الداخلي للفيلا.','Internal Steps','L.M','internal-steps'); // ✅ تعديل slug
        $this->item($G,'اكساءات الحوائط','Wall Tiles','M2','wall-tiles'); // ✅ تعديل slug
        $this->item($G,' النعلات حسب المواصافات','Skirting','L.M','skirting'); // ✅ تعديل slug
        $this->item($G,' حماية من البلاستيك و الجبس للارضيات ','Floor Protection','L.S','floor-protection'); // ✅ تعديل slug
        /*
        /*
=====================================================
2️⃣ ثانيا : اعمال الالكتروميكانيكال
=====================================================
*/

$MEPGroup = OwnerRequirement::updateOrCreate([
    'name_ar' => 'ثانيا : أعمال الالكتروميكانيكال',
    'name_en' => 'Electromechanical Works',
    'floor' => 'tender',
    'type' => 'group',
    'is_general' => 0,
    'slug' => 'electromechanical-works', // ✅ slug فريد للمجموعة
]);

$H = OwnerRequirement::updateOrCreate([
    'name_ar' => 'اعمال MEP حتى التسليم',
    'name_en' => 'MEP Works till Handing Over',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $MEPGroup->id,
    'is_general' => 0,
    'slug' => 'mep-works-handover', // ✅ slug فريد للقسم
]);

$this->item($H,'توريد وتركيب بايبات الصرف و التغذية','Supply and install drainage and water pipes','L.S','drainage-water-pipes'); // ✅ تعديل slug
$this->item($H,'توريد وتركيب يايبات الكهرباء و الاتصالات','Supply and install electrical and communication pipes','L.S','electrical-comm-pipes'); // ✅ تعديل slug
$this->item($H,'توريد وتركيب بايبات الشفط المركزي','Supply and install central vacuum pipes','L.S','central-vacuum-pipes'); // ✅ تعديل slug
$this->item($H,'تنفيذ الكلين اوت','Execute clean out','L.S','execute-clean-out'); // ✅ تعديل slug
$this->item($H,'انذار الحريق  و انارة الطوارئ','Fire alarm and emergency lighting','L.S','fire-alarm-emergency'); // ✅ تعديل slug
$this->item($H,'تركيب خزانات المياه أعلى السطح','Install water tanks above roof','No','roof-water-tanks'); // ✅ تعديل slug
$this->item($H,'تركيب خزان مياه تحت الأرض','Install underground water tank','No','underground-water-tank'); // ✅ تعديل slug
$this->item($H,'تركيب  خزان استرجاع مياه التكييف','Install AC water recovery tank','No','ac-water-recovery-tank'); // ✅ تعديل slug
$this->item($H,'تركيب السخان المركزي','Install central heater','No','central-heater'); // ✅ تعديل slug
$this->item($H,'تركيب  الأطقم الصحية','Install sanitary wares','L.S','sanitary-wares'); // ✅ تعديل slug
$this->item($H,'تأسيس 9 نقاط كاميرا','Establish 9 camera points','L.S','camera-points'); // ✅ تعديل slug
$this->item($H,'توريد وتركيب باقي أعمال حتي التسليم','Supply and install remaining works until handover','L.S','remaining-handover-works'); // ✅ تعديل slug
        /*
=====================================================
3️⃣ ثالثا : توريد التشطيبات
=====================================================
*/

$SupplyGroup = OwnerRequirement::updateOrCreate([
    'name_ar' => 'ثالثا : توريد التشطيبات',
    'name_en' => 'Supply Finishings',
    'floor' => 'tender',
    'type' => 'group',
    'is_general' => 0,
    'slug' => 'supply-finishings', // ✅ slug فريد للمجموعة
]);

$I = OwnerRequirement::updateOrCreate([
    'name_ar' => 'توريد اكساءات الأرضيات والجدران',
    'name_en' => 'Supply Porcelain',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
    'slug' => 'supply-porcelain', // ✅ slug فريد للقسم
]);

$this->item($I,'اكساءات ارضيات  للمدخل الرئيسي للفيلا','Floor finishes for main entrance of the villa','M2','main-entrance-flooring'); // ✅ slug
$this->item($I,'أرضيات درج المدخل الرئيسي والرامب','Main entrance stairs and ramp flooring','M2','stairs-ramp-flooring'); // ✅ slug
$this->item($I,'أرضيات التيراس بالدور الاول ان وجد','First floor terrace flooring if any','M2','first-floor-terrace'); // ✅ slug
$this->item($I,'اكساءات ارضيات الدور الاول و الارض','Ground and first floor flooring finishes','M2','gf-1st-floor-flooring'); // ✅ slug
$this->item($I,'اكساء الدرج الداخلي للفيلا.','Internal villa staircase cladding','L.M','internal-stairs-cladding'); // ✅ slug
$this->item($I,'اكساءات حوائط','Wall finishes','M2','wall-finishes'); // ✅ slug
$this->item($I,'النعلات حسب المواصافات','Skirting as per specifications','L.M','skirting-specs'); // ✅ slug

/*
=====================================================
J : توريد الألمنيوم والزجاج والهاندريل
=====================================================
*/

$J = OwnerRequirement::updateOrCreate([
    'name_ar' => 'توريد الألمنيوم والزجاج والهاندريل',
    'name_en' => 'Supply and install aluminum and handrail',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
    'slug' => 'supply-aluminum-handrail', // ✅ slug
]);

$this->item($J,'توريد و تركيب الالمنيوم و الزجاج','Supply and install aluminum and glass','M2','aluminum-glass'); // ✅ slug
$this->item($J,'الهاندريل للدرج والدابل هايت','Handrail for Stairs and Double height','L.M','handrail-stairs'); // ✅ slug

/*
=====================================================
K : توريد الأبواب الخشبية
=====================================================
*/

$K = OwnerRequirement::updateOrCreate([
    'name_ar' => 'توريد الأبواب الخشبية توريد و تركيب',
    'name_en' => 'Supply and install wooden doors',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
    'slug' => 'supply-wooden-doors', // ✅ slug
]);

$this->item($K,'الباب الخارجي للفيلا الارتفاع','Main entrance Door','No','main-entrance-door'); // ✅ slug
$this->item($K,'الباب الخارجي للمجلس الارتفاع','Majlis Door','No','majlis-door'); // ✅ slug
$this->item($K,'أبواب الغرف والحمامات','Rooms and toilet doors','No','rooms-doors'); // ✅ slug
$this->item($K,'أبواب الغرف الخدمية الارتفاع','Services room doors','No','services-doors'); // ✅ slug

/*
=====================================================
L : توريد سويتشات و سوكت
=====================================================
*/

$L = OwnerRequirement::updateOrCreate([
    'name_ar' => 'توريد سويتشات و سوكت',
    'name_en' => 'Supply switches and sockets',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
    'slug' => 'supply-switches-sockets', // ✅ slug
]);

$this->item($L,'سعر توريد السوكتات','Supply sockets','PICE','supply-sockets'); // ✅ slug
$this->item($L,'سعر توريد السويتشات','Supply switches','PICE','supply-switches'); // ✅ slug

/*
=====================================================
M : توريد الأطقم الصحية
=====================================================
*/

$M = OwnerRequirement::updateOrCreate([
    'name_ar' => 'توريد الأطقم الصحية',
    'name_en' => 'Supply Sanitary wares',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
    'slug' => 'supply-sanitary-wares', // ✅ slug
]);

$this->item($M,'الاطقم الصحية لحمام مغاسل الصالة و المجلس','Sanitary ware and counter for Salaa and Majlis toilets','No','salaa-majlis-toilets'); // ✅ slug
$this->item($M,'الاطقم الصحية لحمام ومغاسل غرف النوم','Sanitary ware and counter for bed rooms toilets','No','bedroom-toilets'); // ✅ slug
$this->item($M,'الاطقم الصحية لحمام ومغاسل غرفة الشغالة','Sanitary ware and counter for maid room toilet','No','maid-room-toilet'); // ✅ slug
$this->item($M,'توريد خلاط المطبخ','Kitchen mixer','No','kitchen-mixer'); // ✅ slug

/*
=====================================================
N : اعمال توريد الالكتروميكانيكال
=====================================================
*/

$N = OwnerRequirement::updateOrCreate([
    'name_ar' => 'اعمال توريد الالكتروميكانيكال',
    'name_en' => 'Supply of electromechanical',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
    'slug' => 'supply-electromechanical', // ✅ slug
]);

$this->item($N,'مضخات نوعية ممتازة','Pumps - best quality','PICE','pumps-best-quality'); // ✅ slug
$this->item($N,'خزانات المياه أعلى السطح','Water tanks above roof','No','water-tanks-roof'); // ✅ slug
$this->item($N,'خزان مياه تحت الأرض','Under ground water tank','No','underground-water-tank'); // ✅ slug
$this->item($N,'خزان استرجاع مياه التكييف','Water tanks for AC water','No','ac-water-tanks'); // ✅ slug
$this->item($N,'السخان المركزي','Central Heater','No','central-heater'); // ✅ slug

/*
=====================================================
O : توريد و تركيب أبواب السور و سلم الخدمات
=====================================================
*/

$O = OwnerRequirement::updateOrCreate([
    'name_ar' => 'توريد و تركيب أبواب السور و سلم الخدمات',
    'name_en' => 'Supply and install wall gates and services stair',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $SupplyGroup->id,
    'is_general' => 0,
    'slug' => 'supply-wall-gates', // ✅ slug
]);

$this->item($O,'بابي السور باب كبير و باب صغير','Boundary wall gates Big and small','L.S','boundary-wall-gates'); // ✅ slug
$this->item($O,'سلم خارجي معدني','External Steel stair','L.S','external-steel-stair'); // ✅ slug

/*
=====================================================
4️⃣ رابعاً : أعمال الواجهات
=====================================================
*/

$ElevationGroup = OwnerRequirement::updateOrCreate([
    'name_ar' => 'رابعا : أعمال الواجهات',
    'name_en' => 'Elevation Works',
    'floor' => 'tender',
    'type' => 'group', // 👈 جروب
    'is_general' => 0,
    'slug' => 'elevation-works', // ✅ slug
]);

$P = OwnerRequirement::updateOrCreate([
    'name_ar' => 'أعمال الواجهات توريد و تركيب',
    'name_en' => 'Elevation Works supply and install',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $ElevationGroup->id, // 👈 تابع للجروب الجديد
    'is_general' => 0,
    'slug' => 'elevation-works-section', // ✅ slug
]);

$this->item($P,'تيوبات كاست المنيوم خامة حسب 3د','Cast Aluminum Tubes Same 3d','L.S','cast-aluminum-tubes'); // ✅ slug
$this->item($P,'تنفيذ طبقين معجون خارجي للكورنيش مع صبغ باللون الاسود حسب 3د ان وجد','2 layers stucco','L.S','2-layers-stucco'); // ✅ slug
$this->item($P,'أصباغ خارجية لحوائط الفيلا','External Painting for villa','M2','external-painting-villa'); // ✅ slug
$this->item($P,'الومنيوم شيت خامة حسب مناظير 3د ان وجد','Aluminum sheet same 3d','M2','aluminum-sheet'); // ✅ slug
$this->item($P,'توريد و تركيب اكساء واجهات بلاصق ممتاز','Porcelain glue best','M2','porcelain-glue'); // ✅ slug
$this->item($P,'توريد وتركيب قرميد ان وجد','Supply and install clay tiles','M2','clay-tiles'); // ✅ slug
$this->item($P,'توريد و تركيب جي ار سي ان وجد','Supply and install GRC','M2','grc-installation'); // ✅ slug
$this->item($P,'توريد و تركيب الكورنيش','Supply and install decoration','L.M','corniche-installation'); // ✅ slug
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

$BoundaryGroup = OwnerRequirement::updateOrCreate([
    'name_ar' => 'خامساً : أعمال السور',
    'name_en' => 'Boundary Wall Works',
    'floor' => 'tender',
    'type' => 'group',
    'is_general' => 0,
    'slug' => 'boundary-wall-works', // ✅ slug فريد للمجموعة
]);

$Q = OwnerRequirement::updateOrCreate([
    'name_ar' => 'أعمال السور الخارجي للفيلا',
    'name_en' => 'Boundary Wall Works Details',
    'floor' => 'tender',
    'type' => 'section',
    'parent_id' => $BoundaryGroup->id,
    'is_general' => 0,
    'slug' => 'boundary-wall-details', // ✅ slug فريد للقسم
]);
//'Substructure workss'
$this->item($Q,'أعمال تحت منسوب الارض','Substructure works','L.M','substructure-works'); // ✅ slug
$this->item($Q,'اعمال فوق منسوب السور بما يشمل (الخرسانة-اعمال الطابوق -اعمال بلاستر)','Super structure works (concrete - block - plaster)','M3','superstructure-works'); // ✅ slug
$this->item($Q,'اعمال صبغ خارجي','Painting Works','M2','painting-works'); // ✅ slug

/*
=====================================================
Private function item
=====================================================
*/
















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

    private function item($parent,$ar,$en,$unit,$slug)
    {
        OwnerRequirement::updateOrCreate(
        [
    'slug' => $slug,
            'parent_id' => $parent->id,   // ✅ مهم جداً
            'type' => 'item'
        ], // ✅ المفتاح الفريد
        [
            'name_ar' => $ar,
            'name_en' => $en,
            'unit' => $unit,
            'floor' => 'tender',
            'type' => 'item',
            'parent_id' => $parent->id,
            'is_general' => 0,
        ]
        );
    }
}
