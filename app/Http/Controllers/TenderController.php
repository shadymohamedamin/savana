<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\OwnerRequirement;
use App\Models\ProjectOwnerRequirement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OwnerRequirmentTenderTotal;

use App\Models\ProjectUser;

class TenderController extends Controller
{
    /*$projectUser = DB::table('project_users')
        ->where('project_id',$project->id)
        ->where('user_id',$contractor->id)
        ->first();

    if(!$projectUser){
        $contractor->project_status = 'not_selected';
    }else{
        $contractor->project_status = $projectUser->status; 
    }

    $tender = DB::table('project_owner_requirements')
        ->where('project_id',$project->id)
        ->where('tender_user_id',$contractor->id)
        ->where('context','tender')
        ->first();

    if(!$tender){
        $contractor->tender_status = 'not_started';
    }else{
        $contractor->tender_status = $tender->tender_status;
    }*/
//     public function contractors(Project $project)
//     {
//         if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
//             return redirect()->back()->with('toast', [
//                 'type' => 'error',
//                 'message' => 'ليس لديك الصلاحيات الكافية'
//             ]);
//         }
//         // كل المقاولين
//         $contractors = User::where('role_id', 3)->get();

//         // المقاولين المرشحين في المشروع
//         $selected = $project->users()
//             ->wherePivot('role_id', 8)
//             ->pluck('users.id')
//             ->toArray();

//         // جروبات التندر
//         $groups = OwnerRequirement::where('floor', 'tender')
//             ->where('type', 'group')
//             ->orderBy('id')
//             ->get();

//         $lowestPrice = null;
//         $awardedContractorId = $project->contractor_id;


//         $groups = OwnerRequirement::where('floor', 'tender')
//             ->where('type', 'group')
//             ->orderBy('id')
//             ->get();


                   
// $structureIds = OwnerRequirement::where('name_ar','like','%الهيكل%')
//     ->orWhere('name_ar','like','%الكتروميكانيكال%')
//     ->pluck('id')
//     ->toArray();

// // التشطيبات
// $finishIds = OwnerRequirement::where('name_ar','like','%التشطيب%')
//     ->pluck('id')
//     ->toArray();

// // السور
// $boundaryIds = OwnerRequirement::where('name_ar','like','%السور%')
//     ->pluck('id')
//     ->toArray();


//         foreach ($contractors as $contractor) {

//             /*$rows = DB::table('project_owner_requirements')
//                 ->where('project_id', $project->id)
//                 ->where('context', 'tender')
//                 ->where('tender_user_id', $contractor->id)
//                 ->get();*/
//             $rows = OwnerRequirmentTenderTotal::where('project_id', $project->id)
//                 ->where('context', 'tender')
//                 ->where('tender_user_id', $contractor->id)
//                 ->get();



//             $projectUser = DB::table('project_users')
//                 ->where('project_id',$project->id)
//                 ->where('user_id',$contractor->id)
//                 ->first();

//             if(!$projectUser){
//                 $contractor->project_status = 'not_selected';
//             }else{
//                 $contractor->project_status = $projectUser->status; 
//             }

            

//             /*$tender = DB::table('project_owner_requirements')
//                 ->where('project_id',$project->id)
//                 ->where('tender_user_id',$contractor->id)
//                 ->where('context','tender')
//                 ->first();*/

//                 $tender = OwnerRequirmentTenderTotal::where('project_id',$project->id)
//                     ->where('tender_user_id',$contractor->id)
//                     ->where('context','tender')
//                     ->first();

//             if(!$tender){
//                 $contractor->tender_status = 'not_started';
//             }else{
//                 $contractor->tender_status = $tender->tender_status;
//             }

//             // نجيب الإجماليات حسب owner_requirement_id
//             /*$structureElectro = $rows
//                 ->whereIn('owner_requirement_id', [378,438]) // عدلهم حسب البنود عندك
//                 ->sum('total_price');

//             $finishes = $rows
//                 ->whereIn('owner_requirement_id', [452]) // مثال
//                 ->sum('total_price');

//             $boundaryWall = $rows
//                 ->whereIn('owner_requirement_id', [496]) // مثال
//                 ->sum('total_price');*/

//             $structureElectro = $rows
//     ->whereIn('owner_requirement_id', $structureIds)
//     ->sum('total_price');

// $finishes = $rows
//     ->whereIn('owner_requirement_id', $finishIds)
//     ->sum('total_price');

// $boundaryWall = $rows
//     ->whereIn('owner_requirement_id', $boundaryIds)
//     ->sum('total_price');

//             $structureWithFinishes = $structureElectro + $finishes;

//             $approvedArea = $project->approved_area ?? 0;

//             $footWithoutFinishes = $approvedArea > 0
//                 ? $structureElectro / $approvedArea
//                 : 0;

//             $footWithFinishes = $approvedArea > 0
//                 ? $structureWithFinishes / $approvedArea
//                 : 0;

//             $totalVillaWithWall = $structureWithFinishes + $boundaryWall;

//             $vat = $totalVillaWithWall /21;//* 0.05;

//             $finalTotal = $totalVillaWithWall + $vat;

//             // نخزنهم
//             /*$contractor->structureElectro = $structureElectro;
//             $contractor->structureWithFinishes = $structureWithFinishes;
//             $contractor->footWithoutFinishes = $footWithoutFinishes;
//             $contractor->footWithFinishes = $footWithFinishes;
//             $contractor->boundaryWall = $boundaryWall;
//             $contractor->totalVillaWithWall = $totalVillaWithWall;
//             $contractor->vat = $vat;
//             $contractor->finalTotal = $finalTotal;*/

//             $totals = OwnerRequirmentTenderTotal::totals($project);

//             $contractor->structureElectro = $totals['structureElectro'];
//             $contractor->structureWithFinishes = $totals['structureWithFinishes'];
//             $contractor->footWithoutFinishes = $totals['footWithoutFinishes'];
//             $contractor->footWithFinishes = $totals['footWithFinishes'];
//             $contractor->boundaryWall = $totals['boundaryWall'];
//             $contractor->totalVillaWithWall = $totals['totalVillaWithWall'];
//             $contractor->vat = $totals['vat'];
//             $contractor->finalTotal = $totals['finalTotal'];
//             //dd($contractor);
//         }

//         return view('projects.tender.contractors', compact(
//             'project',
//             'contractors',
//             'selected',
//             'lowestPrice',
//             'awardedContractorId'
//         ));
//     }

public function contractors(Project $project)
{
    if (!in_array(auth()->user()->role_id, [1, 4, 11, 12])) {
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'ليس لديك الصلاحيات الكافية'
        ]);
    }

    // كل المقاولين
    $contractors = User::where('role_id', 3)->get();

    // المقاولين المختارين للمشروع
    $selected = $project->users()
        ->wherePivot('role_id', 8)
        ->pluck('users.id')
        ->toArray();

    foreach ($contractors as $contractor) {

    $projectUser = $project->users()
        ->where('users.id', $contractor->id)
        ->first();
    //dd($projectUser->pivot);

    if ($projectUser) {

        $pivot = $projectUser->pivot;

        $contractor->project_status = $pivot->status ?? 'not_selected';

        $contractor->structureElectro       = $pivot->structureElectro ?? 0;
        $contractor->structureWithFinishes  = $pivot->structureWithFinishes ?? 0;
        $contractor->footWithout            = $pivot->footWithout ?? 0;
        $contractor->footWith               = $pivot->footWith ?? 0;
        $contractor->boundaryWall           = $pivot->boundaryWall ?? 0;
        $contractor->villaWithWall          = $pivot->villaWithWall ?? 0;
        $contractor->vat                    = $pivot->vat ?? 0;
        $contractor->finalTotal             = $pivot->finalTotal ?? 0;

        $contractor->tender_status = $pivot->tender_status;//$pivot->status ?? 'not_started';

    } else {

        $contractor->project_status = 'not_selected';
        $contractor->structureElectro = 0;
        $contractor->structureWithFinishes = 0;
        $contractor->footWithout = 0;
        $contractor->footWith = 0;
        $contractor->boundaryWall = 0;
        $contractor->villaWithWall = 0;
        $contractor->vat = 0;
        $contractor->finalTotal = 0;
        $contractor->tender_status = 'draft';
    }
}

 $awardedContractorId = $project->contractor_id;



/*$contractors = $contractors->sortBy(function ($contractor) use ($awardedContractorId, $selected) {

    // 1. المتعيّن أولاً
    if ($contractor->id == $awardedContractorId) {
        return 0;
    }

    // 2. المرشحين ثانياً
    if (in_array($contractor->id, $selected)) {
        return 1;
    }

    // 3. الباقي
    return 2;
})->values();*/

$contractors = $contractors->sortBy(function ($contractor) use ($awardedContractorId, $selected) {

    // 1️⃣ تحديد المجموعة
    if ($contractor->id == $awardedContractorId) {
        $group = 0;
    } elseif (in_array($contractor->id, $selected)) {
        $group = 1;
    } else {
        $group = 2;
    }

    // 2️⃣ المبلغ الصحيح
    $amount = $contractor->finalTotal ?? 0;

    // 3️⃣ الصفر في الآخر
    $amount = ($amount == 0) ? PHP_INT_MAX : $amount;

    return [$group, $amount];
})->values();




//dd($contractors);

    // أقل سعر
    $lowestPrice = $contractors->min('finalTotal');

   

    return view('projects.tender.contractors', compact(
        'project',
        'contractors',
        'selected',
        'lowestPrice',
        'awardedContractorId'
    ));
}









    /*public function award(Project $project, $contractorId)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        DB::transaction(function () use ($project, $contractorId) {

          
            //dd($finalTotal);
            // 2️⃣ تحديث جدول المشاريع
            $project->update([
                'contractor_id' => $contractorId,
                'bank_contract_value' => $finalTotal,
                'project_owner_support'=>($finalTotal-($project->project_bank_support))
            ]);


            ProjectUser::where('project_id',$project->id)
                ->where('user_id',$contractorId)
                ->update(['status'=>'awarded','role_id'=>8]);//3

            // 3️⃣ حذف كل المرشحين
            /*$project->users()
                ->wherePivot('role_id', 8)
                ->detach();*/

            // 4️⃣ إضافة المقاول كرول رسمي
            /*$project->users()->syncWithoutDetaching([
                $contractorId => ['role_id' => 3]
            ]);*/

        //});

        /*return redirect()
        ->back()
        ->with('toast', [
            'type' => 'success',
            'message' => 'تم التعيين بنجاح'
        ]);
    }
*/
public function award(Project $project, $contractorId)
{
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'ليس لديك الصلاحيات الكافية'
        ]);
    }

    DB::transaction(function () use ($project, $contractorId) {

        // 1️⃣ جلب القيم المحسوبة من project_users
        $pivot = ProjectUser::where('project_id', $project->id)
            ->where('user_id', $contractorId)
            ->first();

        if (!$pivot) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'لا يوجد بيانات مقاول'
            ]);
        }

        $finalTotal = $pivot->finalTotal;

        // 2️⃣ تحديث المشروع بالقيم المخزنة
        $project->update([
            'contractor_id' => $contractorId,
            'bank_contract_value' => $finalTotal,
            'project_owner_support' => ($finalTotal - ($project->project_bank_support))
        ]);

        // 3️⃣ تحديث حالة المقاول
        $pivot->update([
            'status' => 'awarded',
            'role_id' => 8
        ]);

    });

    return redirect()
        ->back()
        ->with('toast', [
            'type' => 'success',
            'message' => 'تم التعيين بنجاح'
        ]);
}




    public function unaward(Project $project)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        if (!$project->contractor_id) {
            return back()->with('error','لا يوجد مقاول متعين');
        }

        DB::transaction(function () use ($project) {

            ProjectUser::where('project_id',$project->id)
                ->where('user_id',$project->contractor_id)
                ->update(['status'=>'candidate','role_id'=>8]);

            $project->update([
                'contractor_id' => null,
                'bank_contract_value' => null
            ]);
        });

        return redirect()
        ->back()
        ->with('toast', [
            'type' => 'success',
            'message' => 'تم إلغاء التعيين بنجاح'
        ]);
    }


/*foreach ($contractors as $contractor) {

    $rows = DB::table('project_owner_requirements as por')
        ->join('owner_requirements as or', 'por.owner_requirement_id', '=', 'or.id')
        ->leftJoin('owner_requirements as parent', 'or.parent_id', '=', 'parent.id')
        ->where('por.project_id', $project->id)
        ->where('por.context', 'tender')
        ->where('por.tender_user_id', $contractor->id)
        ->select(
            'por.total_price',
            DB::raw('COALESCE(parent.name_en, or.name_en) as parent_group')
        )
        ->get();   
         $contractor->tender_total = ProjectOwnerRequirement::where('project_id', $project->id)
        ->where('context', 'tender')
        ->where('tender_user_id', $contractor->id)
        ->sum('total_price');
    dd($contractor);
    $structure = $rows->where('parent_group', 'Main Structure')->sum('total_price');
    $mep = $rows->where('parent_group', 'Electromechanical Works')->sum('total_price');
    $finishes = $rows->where('parent_group', 'Supply Finishings')->sum('total_price');
    $elevation = $rows->where('parent_group', 'Elevation Works')->sum('total_price');
    $boundary = $rows->where('parent_group', 'Boundary Wall Works')->sum('total_price');

    $structureElectro = $structure + $mep;
    $structureWithFinishes = $structureElectro + $finishes + $elevation;

    $approvedArea = $project->approved_area ?? 0;

    $footWithoutFinishes = $approvedArea > 0 ? $structureElectro / $approvedArea : 0;
    $footWithFinishes    = $approvedArea > 0 ? $structureWithFinishes / $approvedArea : 0;

    $totalVillaWithWall = $structureWithFinishes + $boundary;
    $vat = $totalVillaWithWall * 0.05;
    $finalTotal = $totalVillaWithWall + $vat;

    $contractor->structureElectro = $structureElectro;
    $contractor->structureWithFinishes = $structureWithFinishes;
    $contractor->footWithoutFinishes = $footWithoutFinishes;
    $contractor->footWithFinishes = $footWithFinishes;
    $contractor->boundaryWall = $boundary;
    $contractor->totalVillaWithWall = $totalVillaWithWall;
    $contractor->vat = $vat;
    $contractor->finalTotal = $finalTotal;
    //dd($contractor);
}*/

        

    
    /*public function store(Request $request, Project $project)
    {
        // حذف القديم
        $project->users()
            ->wherePivot('role_id', 8)
            ->detach();

        // إضافة الجديد
        if ($request->contractors) {
            foreach ($request->contractors as $contractorId) {
                $project->users()->attach($contractorId, [
                    'role_id' => 8
                ]);
            }
        }

        return back()->with('success','تم حفظ المقاولين المرشحين');
    }*/


        public function store(Request $request, Project $project)
        {
            if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
            $contractorIds = $request->contractors ?? [];

            // حضر البيانات بالـ role
            $syncData = [];

            foreach ($contractorIds as $id) {
                $syncData[$id] = ['role_id' => 8];
            }

            // يمسح القديم ويضيف الجديد بأمان
            $project->users()->sync($syncData);
            return redirect()
                    ->back()
                    ->with('toast', [
                        'type' => 'success',
                        'message' => 'تم حفظ المقاولين المرشحين'
                    ]);
            //return back()->with('success','تم حفظ المقاولين المرشحين');
        }
}