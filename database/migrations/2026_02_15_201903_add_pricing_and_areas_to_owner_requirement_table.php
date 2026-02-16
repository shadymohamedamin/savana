<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_owner_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();

            $table->string('water_heater')->nullable();                  // السخان
            $table->string('bathroom_chairs')->nullable();               // كراسي الحمامات
            $table->string('exhaust_fan')->nullable();                   // الشفط
            $table->string('insulation')->nullable();                    // النعلة
            $table->string('aluminum')->nullable();                      // الألمنيوم
            $table->string('water_tank')->nullable();                    // خزان المياه
            $table->string('main_door')->nullable();                     // الباب الرئيسي كاست المنيوم
            $table->string('paint_type')->nullable();                    // نوع الصبغ
            $table->string('hot_cold_water_for_bidet')->nullable();      // الماء الحار والبارد للشطاف
            $table->string('car_electric_point')->nullable();            // نقطة كهرباء سيارة
            $table->string('facade_lighting_points')->nullable();        // نقاط اضاءة بالواجهة
            $table->string('pantry_plumbing_first_floor')->nullable();   // صرف وتغذية للبانتري الدور الأول
            $table->string('roof_water_point')->nullable();              // نقطة مياه في السطح
            $table->string('roof_electric_point')->nullable();           // نقطة كهرباء في السطح
            $table->string('roof_plumbing_install')->nullable();         // تركيب تمديدات التغذية فوق السطح
            $table->string('ac_civil_works')->nullable();                // اعمال مدنية للتكييف
            $table->string('front_stairs')->nullable();                  // الدرج الامامي لمدخل الفيلا
            $table->string('floor_protection')->nullable();              // حماية الارضيات بعد تركيب البورسلان
            $table->string('ac_water_recovery_tank')->nullable();        // خزان استرجاع مياه التكييف
            $table->string('washroom_faucets')->nullable();              // مكسرات المغاسل والحمامات
            $table->string('sanitary_drainage')->nullable();             // نظام الصرف الصحي
            $table->string('ceramic_tiles')->nullable();                 // حبات السيراميك
            $table->string('water_tank_capacity')->nullable();           // سعة خزان المياه
            $table->string('door_heights')->nullable();                  // ارتفاعات الأبواب
            $table->string('fence_water_points')->nullable();            // نقاط مياه في السور
            $table->string('fence_electric_points')->nullable();         // نقاط كهرباء في السور
            $table->string('exterior_stone_tiles')->nullable();          // الحجر والبورسلان الخارجي
            $table->string('camera_points')->nullable();                 // نقاط الكاميرا
            $table->string('annex_ceramic_price')->nullable();           // سعر سيراميك الملاحق
            $table->string('planting_basins')->nullable();               // أحواض الزراعة
            $table->string('hidden_plaster_beam')->nullable();           // نعلة مخفية للجبس بلاستر
            $table->string('first_floor_bath_drainage')->nullable();     // صرف الحمامات الدور الاول
            $table->string('central_exhaust_fans')->nullable();          // مراوح الشفاط المركزي
            $table->string('bath_wall_niches')->nullable();              // تجويفات جدران الحمامات
            $table->string('garage_door_electric_point')->nullable();    // نقطة كهرباء ماكينة باب الكراج
            $table->string('curb_grooves')->nullable();                  // تركيب قروفات بالسور
            $table->string('window_electric_points')->nullable();        // نقاط كهرباء لشبابيك الصالة
            $table->string('sound_system_pipes')->nullable();            // تركيب بايبات ساوند سيستم
            $table->string('cleanout_rebates')->nullable();              // توريد و تركيب رداد للكلين اوت

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owner_requirement', function (Blueprint $table) {
            //
        });
    }
};
