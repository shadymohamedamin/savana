<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOwnerRequirementRequest;
use App\Http\Requests\UpdateOwnerRequirementRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OwnerRequirementRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\Project;
use App\Models\OwnerRequirement;
use App\Models\ProjectOwnerRequirement;

class OwnerRequirementController extends AppBaseController
{
    /** @var OwnerRequirementRepository $ownerRequirementRepository*/
    private $ownerRequirementRepository;

    public function __construct(OwnerRequirementRepository $ownerRequirementRepo)
    {
        $this->ownerRequirementRepository = $ownerRequirementRepo;
    }

    /**
     * Display a listing of the OwnerRequirement.
     */
    /*public function index(Project $project)
    {
        $requirements = OwnerRequirement::all()->groupBy('floor');

        $selected = $project->ownerRequirements
            ->keyBy('id');

        $design = $project->designPreferences; // العلاقة
        //dd($requirements);
        $context='owner';
        return view('projects.owner-requirements.index', compact(
            'project',
            'requirements',
            'selected',
            'design',
            'context'
        ));

    }*/



    /*public function index(Project $project, Request $request)
{
    $context = $request->get('context', 'owner'); // owner | pricing | tender

    $requirements = OwnerRequirement::query()
        ->when($context === 'owner', function ($q) {
            $q->whereIn('floor', ['ground', 'first']);
        })
        ->when($context === 'pricing', function ($q) {
            $q->where('floor', 'pricing');
        })
        ->when($context === 'tender', function ($q) {
            $q->where('floor', 'tender');
        })
        ->orderByDesc('is_general')
        ->get()
        ->groupBy('floor');

    $selected = $project->ownerRequirements
        ->keyBy('id');

    $design = $project->designPreferences;
    
    return view('projects.owner-requirements.index', compact(
        'project',
        'requirements',
        'selected',
        'design',
        'context'
    ));
}*/


/*public function index(Project $project, Request $request)
{
    $context = $request->get('context', 'owner');

    $requirements = collect();
    $items = collect();

    if ($context === 'owner') {
        $requirements = OwnerRequirement::whereIn('floor', ['ground','first'])
            ->orderByDesc('is_general')
            ->get()
            ->groupBy('floor');
            
    }



if ($context === 'pricing') {
    $items = OwnerRequirement::where('floor', 'pricing')
        ->with(['projectOwnerRequirements' => function ($q) use ($project) {
            $q->where('project_id', $project->id)
              ->where('context', 'pricing');
        }])
        ->get()
        ->map(function ($requirement) use ($project) {
            // إذا لم يكن هناك بيانات محفوظة، أضف صف افتراضي
            if ($requirement->projectOwnerRequirements->isEmpty()) {
                $requirement->projectOwnerRequirements->push(new ProjectOwnerRequirement([
                    'quantity'   => 1,
                    'unit_price' => 0,
                    'notes'      => '',
                    'project_id' => $project->id,
                    'owner_requirement_id' => $requirement->id,
                    'context' => 'pricing',
                ]));
            }
            return $requirement;
        })
        ->groupBy('main_category');
}




    if($context === 'pricing') {
        $selected = $project->ownerRequirements
            ->where('pivot.context', $context)
            ->keyBy('id');
    } else {
        $selected = $project->ownerRequirements->keyBy('id');
    }//$selected = $project->ownerRequirements->keyBy('id');

    $design = $project->designPreferences;

    return view('projects.owner-requirements.index', compact(
        'project',
        'requirements',
        'items',
        'context',
        'design',
        'selected'
    ));
}*/


    /**
     * Store a newly created OwnerRequirement in storage.
     */
    /*public function store(Request $request, Project $project)
{

    $syncData = [];

    foreach ($request->requirements ?? [] as $reqId => $data) {

        $qty = $data['quantity'] ?? null;
        $notes = $data['notes'] ?? null;

        if (!empty($qty) && $qty > 0) {
            $syncData[$reqId] = [
                'quantity' => $qty,
                'notes' => $notes,
            ];
        }
    }


    $project->ownerRequirements()->sync($syncData);

    if ($request->filled('design')) {
        $project->designPreferences()->updateOrCreate(
            ['project_id' => $project->id],
            $request->design
        );
    }

    return redirect()->back()->with('toast', [
        'type' => 'success',
        'message' => 'تم حفظ متطلبات المالك وأفكار التصميم بنجاح'
    ]);
}*/






/*public function store(Request $request, Project $project)
{
    $syncData = [];

    foreach ($request->requirements ?? [] as $reqId => $data) {

        $qty = $data['quantity'] ?? null;
        $notes = $data['notes'] ?? null;

        if ($qty !== null && $qty > 0) {
            $syncData[$reqId] = [
                'quantity' => (int)$qty,
                'notes' => $notes,
            ];
        }
    }

    try {
        $project->ownerRequirements()->sync($syncData);
    } catch (\Throwable $e) {
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => $e->getMessage()
        ]);
    }


    if ($request->filled('design')) {
        $project->designPreferences()->updateOrCreate(
            ['project_id' => $project->id],
            $request->design
        );
    }

    return redirect()->back()->with('toast', [
        'type' => 'success',
        'message' => 'تم حفظ متطلبات المالك وأفكار التصميم بنجاح'
    ]);
}*/


public function index(Project $project, Request $request)
{
    
    $context = $request->get('context', 'owner');
    $contractor = $request->get('contractor');
    $contractorId = $request->contractor;
    $requirements = collect();
    $items = collect();

    if ($context === 'owner') {
        $requirements = OwnerRequirement::whereIn('floor', ['ground','first'])
            ->orderByDesc('is_general')
            ->get()
            ->groupBy('floor');
    }

    /*if ($context === 'pricing') {
        $items = OwnerRequirement::where('floor', 'pricing')
            ->with(['projectOwnerRequirements' => function ($q) use ($project) {
                $q->where('project_id', $project->id)
                  ->where('context', 'pricing');
            }])
            ->get()
            ->map(function ($requirement) use ($project) {
                if ($requirement->projectOwnerRequirements->isEmpty()) {
                    $requirement->projectOwnerRequirements->push(new ProjectOwnerRequirement([
                        'quantity'   => 1,
                        'unit_price' => 0,
                        'notes'      => '',
                        'project_id' => $project->id,
                        'owner_requirement_id' => $requirement->id,
                        'context' => 'pricing',
                    ]));
                }
                return $requirement;
            })
            ->groupBy('main_category');
    }*/


    // $groups = OwnerRequirement::with([
    //         'children.children', // section + items
    //         'children.children.projectOwnerRequirements' // pivot
    //     ])
    //     ->where('floor', $context)
    //     ->where('type', 'group')
    //     ->whereNull('parent_id')
    //     ->get();

    /*$groups = OwnerRequirement::with([
            'children.children',
            'children.children.projectOwnerRequirements' => function ($q) use ($project, $context) {
                $q->where('project_id', $project->id)
                ->where('context', $context);
            }
        ])
        ->where('floor', $context)
        ->where('type', 'group')
        ->whereNull('parent_id')
        ->get();*/










$groupsQuery = OwnerRequirement::with([
        'children.children',
        'children.children.projectOwnerRequirements' => function ($q) use ($project, $context,$contractorId) {
            $q->where('project_id', $project->id)
              ->where('context', 'tender');
              
              if ($contractorId) {
                $q->where('tender_user_id', $contractorId);
            }
              //->where('tender_user_id', $contractorId);//$context);
        }
    ])
    ->where('type', 'group')
    ->whereNull('parent_id');

if ($context === 'pricing') {
    // 👇 هنا بنجيب جروب توريد التشطيبات فقط
    $groupsQuery->where('name_en', 'Supply Finishings');
} else {
    $groupsQuery->where('floor', $context);
}



$groups = $groupsQuery->get();



//dd($groups);

//dd($groups);


    /*$selected = $context === 'pricing'
        ? $project->ownerRequirements->where('pivot.context', $context)->keyBy('id')
        : $project->ownerRequirements->keyBy('id');*/
    $selected = $context === 'pricing'
        ? $project->ownerRequirementsPricing->keyBy('id')
        : $project->ownerRequirementsOwner->keyBy('id');
    $design = $project->designPreferences;
    $designs = $project->ownerSpecification;






    $designOptions = [
    'water_heater' => [
        'مركزي مع سخان واحد  200L MILANO',
        'مركزي مع 2 سخان 200L  كل واحد MILANO',
        'عادي فوق كل حمام ArIston',
        'مركزي مع 2 سخان 200L  كل واحد ARISTON'
    ],
    'bathroom_chairs' => [
        'معلق مع سماكة جدار  25 سنتم',
        'عادي',
        'معلق بدون خزان  سماكة جدار  25 سنتم'
    ],
    'exhaust_fan' => [
        'عادي',
        'مركزي مخفي للسطح او للجدران الخارجية'
    ],
    'insulation' => [
        'شامل النعلات - مخفية',
        'شامل النعلات - مخفية مع ستيل',
        'شامل النعلات - عادية',
        'بدون نعلة ( ستيل فقط)'
    ],
    'aluminum' => [
        'بروفايل فول امبريلا عادي',
        'بروفايل كيرتين وول'
    ],
    'water_tank' => [
        'تحت الأرض مع غرفة',
        'فوق الأرض'
    ],
    'ac_water_recovery_tank' => [
        'غرفة تحت الأرض فقط',
        'غرفة تحت الارض مع خزان',
        'لا يوجد'
    ],
    'washroom_faucets' => [
        'مخفية داخل الجدران',
        'عادية'
    ],
    'sanitary_drainage' => [
        'كلين اوت',
        'عادي'
    ],
    'ceramic_tiles' => [
        'كبيرة',
        'متوسطة',
        'صغيرة'
    ],
    'water_tank_capacity' => [
        '1000 جالون',
        '2000 جالون',
        '1500 جالون'
    ],
    'door_heights' => [
        '220 Cm',
        '240 Cm',
        '250 Cm',
        'حتى الجبس'
    ],
    'main_door' => [
        'عادي',
        'فيكس + عادي',
        'دبل هايت'
    ],
    'paint_type' => [
        'قرافيو ناسونال',
        'سانديكس جوتن',
        'جوتاشيلد جوتن'
    ],
    'hot_cold_water_for_bidet' => [
        'كامل حمامات البيت',
        'حمام واحد',
        '3 حمامات',
        '4 حمامات',
        'لا'
    ],
    'facade_lighting_points' => [
        'نعم',
        'لا'
    ],
    'fence_water_points' => [
        'عدد 1',
        'عدد 2',
        'عدد 3',
        'عدد 4'
    ],
    'fence_electric_points' => [
        '1',
        '2',
        '3',
        '4',
        '5'
    ],
    'car_electric_point' => [
        'نعم',
        'لا'
    ],
    'exterior_stone_tiles' => [
        '0',
        '50',
        '70',
        '90'
    ],
    'camera_points' => [
        'لا يوجد',
        '4',
        '6',
        '8',
        '9'
    ],
    'annex_ceramic_price' => [
        '30',
        '40',
        '50'
    ],
    'pantry_plumbing_first_floor' => [
        'نعم',
        'لا'
    ],
    'hidden_plaster_beam' => [
        'يوجد',
        'لا يوجد'
    ],
    'roof_water_point' => [
        'لا',
        '1',
        '2'
    ],
    'roof_electric_point' => [
        'لا',
        '1',
        '2'
    ],
    'feeding_pipe_install' => [
        '31- تركيب تمديدات التغذية  فوق السطح',
        'علي جدران البارابت'
    ],
    'ac_civil_works' => [
        'مركزي او سبليت علي المقاول'
    ],
    'front_stairs' => [
        'طاير مع اضاءة من تحت',
        'عادي'
    ],
    'floor_protection' => [
        'طبقة جبس مع بلاستيك'
    ],
    'first_floor_bath_drainage' => [
        'داكت من تحت لفوق السطح',
        'تحت الاسقف الي داكت الارضي'
    ],
    'central_exhaust_fans' => [
        'اعمال مدنية  بايبات على المقاول'
    ],
    'bath_wall_niches' => [
        'جدار واحد حسب الديكور عمق  13 سنت'
    ],
    'garage_door_electric_point' => [
        'نقطة كهرباء ماكينة باب الكراج'
    ],
    'curb_grooves' => [
        'توريد و تركيب رداد للكلين اوت'
    ],
    'window_electric_points' => [
        'نقاط كهرباء لشبابيك الصالة'
    ],
    'sound_system_pipes' => [
        'تركيب بايبات ساوند سيستم'
    ],
    'cleanout_rebates' => [
        'من ضمن السعر'
    ],
    'planting_basins' => [
        'يوجد',
        'لايوجد'
    ],
    'feeding_pipe_routing' => [
        'داخلي',
        'خارجي'
    ],

    'fence_grooves' => [
        'يوجد',
        'لا يوجد'
    ],

];









    return view('projects.owner-requirements.index', compact(
        'contractor','groups','project', 'requirements', 'items', 'context', 'design', 'selected','designOptions','designs'
    ));
}










    /**
     * Show the form for creating a new OwnerRequirement.
     */
    public function create()
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        return view('owner_requirements.create');
    }











































// حفظ متطلبات المالك
public function store(Request $request, Project $project)
{
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
    $syncData = [];
    foreach ($request->requirements ?? [] as $reqId => $data) {
        $qty = $data['quantity'] ?? null;
        $notes = $data['notes'] ?? null;

        if ($qty !== null && $qty > 0) {
            $syncData[$reqId] = [
                'quantity' => (int)$qty,
                'notes' => $notes,
                'context' => 'owner'
            ];
        }
    }

    $project->ownerRequirementsOwner()->sync($syncData); // استخدم العلاقة الخاصة بالـ owner

    if ($request->filled('design')) {
        $project->designPreferences()->updateOrCreate(
            ['project_id' => $project->id],
            $request->design
        );
    }

    return redirect()->back()->with('toast', [
        'type' => 'success',
        'message' => 'تم حفظ متطلبات المالك وأفكار التصميم بنجاح'
    ]);
}





// حفظ أسعار التشطيبات
public function savePricing(Request $request, Project $project)
{
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
    /*$syncData = [];

    foreach ($request->requirements ?? [] as $ownerRequirementId => $data) {

        $qty   = isset($data['quantity']) ? (int)$data['quantity'] : 0;
        $price = isset($data['unit_price']) ? (float)$data['unit_price'] : 0;
        $notes = $data['notes'] ?? '';

        // ✅ الشرط المهم
        if ($qty > 0 && $price > 0) {
            $syncData[$ownerRequirementId] = [
                'quantity'    => $qty,
                'unit_price'  => $price,
                'total_price' => $qty * $price,
                'notes'       => $notes,
                'context'     => 'pricing'
            ];
        }
    }*/


    $syncData = [];
    //dd($request->all());

    foreach ($request->requirements ?? [] as $ownerRequirementId => $data) {

        $qty   = isset($data['quantity']) ? (int)$data['quantity'] : 0;
        $price = isset($data['unit_price']) ? (float)$data['unit_price'] : 0;
        $notes = $data['notes'] ?? '';

        // ✅ الشرط المهم: احفظ العناصر اللي الكمية والسعر أكبر من 0
        if ($qty > 0 || $price > 0) {
            $syncData[$ownerRequirementId] = [
                'quantity'    => $qty,
                'unit_price'  => $price,
                'total_price' => $qty * $price,
                'notes'       => $notes,
                'context'     => 'tender' // 👈 الفرق: هنا السياق tender
            ];
        }
    }


    // حفظ البيانات في الـ pivot table لو في عناصر صالحة
    //if (!empty($syncData)) {
    $project->ownerRequirementsTender()->sync($syncData);
    //dd($request);
    if ($request->filled('designs')) {

        $project->ownerSpecification()->updateOrCreate(
            ['project_id' => $project->id],
            $request->designs   // 👈 مباشر
        );
    }





    // لو مفيش ولا عنصر صالح
    //if (!empty($syncData)) {
        //dd($syncData);
    //    $project->ownerRequirementsPricing()->syncWithoutDetaching($syncData);
    //}

    return redirect()->back()->with('toast', [
        'type'    => 'success',
        'message' => 'تم حفظ أسعار التشطيبات بنجاح'
    ]);
}


public function saveTender(Request $request, Project $project)
{
    $syncData = [];
    //dd($request);
     $contractorId = $request->contractor;
//dd($contractorId);
    foreach ($request->requirements ?? [] as $ownerRequirementId => $data) {

        $qty   = isset($data['quantity']) ? (int)$data['quantity'] : 0;
        $price = isset($data['unit_price']) ? (float)$data['unit_price'] : 0;
        $notes = $data['notes'] ?? '';

        // ✅ الشرط المهم: احفظ العناصر اللي الكمية والسعر أكبر من 0
        if ($qty > 0 || $price > 0) {
            $syncData[$ownerRequirementId] = [
                'quantity'    => $qty,
                'unit_price'  => $price,
                'total_price' => $qty * $price,
                'notes'       => $notes,
                'context'     => 'tender',
                'tender_user_id' => $contractorId // 👈 الفرق: هنا السياق tender
            ];
        }
    }


    // حفظ البيانات في الـ pivot table لو في عناصر صالحة
    //if (!empty($syncData)) {
        //$project->ownerRequirementsTender()->sync($syncData);//syncWithoutDetaching($syncData);
    //}

    $project->ownerRequirementsTender()
            ->wherePivot('tender_user_id', $contractorId)
            ->sync($syncData);
    return redirect()->back()->with('toast', [
        'type'    => 'success',
        'message' => 'تم حفظ بيانات  بنجاح'
    ]);
}


/*private function mapDesignToSpecification(array $design): array
{
    $map = [
        // اختلاف أسماء
        'skirting_type'        => 'insulation',
        'sink_bath_fittings'   => 'washroom_faucets',
        'sewage_system'        => 'sanitary_drainage',
        'hot_cold_water'       => 'hot_cold_water_for_bidet',
        'facade_lights'        => 'facade_lighting_points',
        'wall_water_points'    => 'fence_water_points',
        'wall_electric_points' => 'fence_electric_points',

        // نفس الاسم (نثبتهم)
        'water_heater'                 => 'water_heater',
        'bathroom_chairs'              => 'bathroom_chairs',
        'exhaust_fan'                  => 'exhaust_fan',
        'aluminum'                     => 'aluminum',
        'water_tank'                   => 'water_tank',
        'ac_water_recovery_tank'       => 'ac_water_recovery_tank',
        'ceramic_tiles'                => 'ceramic_tiles',
        'water_tank_capacity'          => 'water_tank_capacity',
        'door_heights'                 => 'door_heights',
        'main_door'                    => 'main_door',
        'paint_type'                   => 'paint_type',
        'car_electric_point'           => 'car_electric_point',
        'exterior_stone_tiles'         => 'exterior_stone_tiles',
        'camera_points'                => 'camera_points',
        'annex_ceramic_price'          => 'annex_ceramic_price',
        'pantry_plumbing_first_floor'  => 'pantry_plumbing_first_floor',
        'sound_system_pipes'           => 'sound_system_pipes',
        'cleanout_rebates'             => 'cleanout_rebates',
        'floor_protection'             => 'floor_protection',
        'front_stairs'                 => 'front_stairs',
        'bath_wall_niches'             => 'bath_wall_niches',
        'ac_civil_works'               => 'ac_civil_works',
        'central_exhaust_fans'         => 'central_exhaust_fans',
        'first_floor_bath_drainage'    => 'first_floor_bath_drainage',
        'hidden_plaster_beam'          => 'hidden_plaster_beam',
        'planting_basins'              => 'planting_basins',
        'roof_water_point'             => 'roof_water_point',
        'roof_electric_point'          => 'roof_electric_point',
    ];

    $result = [];

    foreach ($map as $formKey => $dbKey) {
        if (array_key_exists($formKey, $design)) {
            $result[$dbKey] = $design[$formKey];
        }
    }

    return $result;
}*/

////////////////////
/*










public function savePricing(Request $request, Project $project)
{
    foreach ($request->requirements ?? [] as $ownerRequirementId => $data) {
        $qty   = $data['quantity'] ?? 1;
        $price = $data['unit_price'] ?? 0;
        $notes = $data['notes'] ?? '';

        $project->ownerRequirements()->syncWithoutDetaching([
            $ownerRequirementId => [
                'quantity'    => (int)$qty,
                'unit_price'  => (float)$price,
                'total_price' => (float)$qty * $price,
                'notes'       => $notes,
                'context'     => 'pricing'
            ]
        ]);
    }

    return redirect()->back()->with('toast', [
        'type'    => 'success',
        'message' => 'تم حفظ الأسعار والكميات بنجاح'
    ]);
}









public function store(Request $request, Project $project)
{
    $syncData = [];

    foreach ($request->requirements ?? [] as $reqId => $data) {
        $qty = $data['quantity'] ?? null;
        $notes = $data['notes'] ?? null;

        if ($qty !== null && $qty > 0) {
            $syncData[$reqId] = [
                'quantity' => (int)$qty,
                'notes' => $notes,
            ];
        }
    }

    try {
        $project->ownerRequirements()->sync($syncData);
    } catch (\Throwable $e) {
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => $e->getMessage()
        ]);
    }

    if ($request->filled('design')) {
        $project->designPreferences()->updateOrCreate(
            ['project_id' => $project->id],
            $request->design
        );
    }

    return redirect()->back()->with('toast', [
        'type' => 'success',
        'message' => 'تم حفظ متطلبات المالك وأفكار التصميم بنجاح'
    ]);
}*/





    public function print(Project $project)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $requirements = $project->ownerRequirements
            ->groupBy('floor');

        return view('projects.owner-requirements.print', compact(
            'project',
            'requirements'
        ));
    }

    /**
     * Display the specified OwnerRequirement.
     */
    public function show($id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $ownerRequirement = $this->ownerRequirementRepository->find($id);

        if (empty($ownerRequirement)) {
            Flash::error('Owner Requirement not found');

            return redirect(route('ownerRequirements.index'));
        }

        return view('owner_requirements.show')->with('ownerRequirement', $ownerRequirement);
    }

    /**
     * Show the form for editing the specified OwnerRequirement.
     */
    public function edit($id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $ownerRequirement = $this->ownerRequirementRepository->find($id);

        if (empty($ownerRequirement)) {
            Flash::error('Owner Requirement not found');

            return redirect(route('ownerRequirements.index'));
        }

        return view('owner_requirements.edit')->with('ownerRequirement', $ownerRequirement);
    }

    /**
     * Update the specified OwnerRequirement in storage.
     */
    public function update($id, UpdateOwnerRequirementRequest $request)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $ownerRequirement = $this->ownerRequirementRepository->find($id);

        if (empty($ownerRequirement)) {
            Flash::error('Owner Requirement not found');

            return redirect(route('ownerRequirements.index'));
        }

        $ownerRequirement = $this->ownerRequirementRepository->update($request->all(), $id);

        Flash::success('Owner Requirement updated successfully.');

        return redirect(route('ownerRequirements.index'));
    }

    /**
     * Remove the specified OwnerRequirement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $ownerRequirement = $this->ownerRequirementRepository->find($id);

        if (empty($ownerRequirement)) {
            Flash::error('Owner Requirement not found');

            return redirect(route('ownerRequirements.index'));
        }

        $this->ownerRequirementRepository->delete($id);

        Flash::success('Owner Requirement deleted successfully.');

        return redirect(route('ownerRequirements.index'));
    }
}
