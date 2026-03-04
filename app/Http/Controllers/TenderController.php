<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\OwnerRequirement;
use App\Models\ProjectOwnerRequirement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
    public function contractors(Project $project)
    {
        // كل المقاولين
        $contractors = User::where('role_id', 3)->get();

        // المقاولين المرشحين في المشروع
        $selected = $project->users()
            ->wherePivot('role_id', 8)
            ->pluck('users.id')
            ->toArray();

        // جروبات التندر
        $groups = OwnerRequirement::where('floor', 'tender')
            ->where('type', 'group')
            ->orderBy('id')
            ->get();

        $lowestPrice = null;
        $awardedContractorId = $project->contractor_id;

        foreach ($contractors as $contractor) {

            $rows = DB::table('project_owner_requirements')
                ->where('project_id', $project->id)
                ->where('context', 'tender')
                ->where('tender_user_id', $contractor->id)
                ->get();



            $projectUser = DB::table('project_users')
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
            }

            // نجيب الإجماليات حسب owner_requirement_id
            $structureElectro = $rows
                ->whereIn('owner_requirement_id', [378,438]) // عدلهم حسب البنود عندك
                ->sum('total_price');

            $finishes = $rows
                ->whereIn('owner_requirement_id', [452]) // مثال
                ->sum('total_price');

            $boundaryWall = $rows
                ->whereIn('owner_requirement_id', [496]) // مثال
                ->sum('total_price');

            $structureWithFinishes = $structureElectro + $finishes;

            $approvedArea = $project->approved_area ?? 0;

            $footWithoutFinishes = $approvedArea > 0
                ? $structureElectro / $approvedArea
                : 0;

            $footWithFinishes = $approvedArea > 0
                ? $structureWithFinishes / $approvedArea
                : 0;

            $totalVillaWithWall = $structureWithFinishes + $boundaryWall;

            $vat = $totalVillaWithWall /21;//* 0.05;

            $finalTotal = $totalVillaWithWall + $vat;

            // نخزنهم
            $contractor->structureElectro = $structureElectro;
            $contractor->structureWithFinishes = $structureWithFinishes;
            $contractor->footWithoutFinishes = $footWithoutFinishes;
            $contractor->footWithFinishes = $footWithFinishes;
            $contractor->boundaryWall = $boundaryWall;
            $contractor->totalVillaWithWall = $totalVillaWithWall;
            $contractor->vat = $vat;
            $contractor->finalTotal = $finalTotal;
        }

        return view('projects.tender.contractors', compact(
            'project',
            'contractors',
            'selected',
            'lowestPrice',
            'awardedContractorId'
        ));
    }






    public function award(Project $project, $contractorId)
    {
        DB::transaction(function () use ($project, $contractorId) {

            // 1️⃣ حساب الإجمالي النهائي
            /*$total = ProjectOwnerRequirement::where('project_id', $project->id)
                ->where('context', 'tender')
                ->where('tender_user_id', $contractorId)
                ->sum('total_price');

            $vat = $total /21;
            $finalTotal = $total + $vat;*/
            //$contractor = User::where('id', $contractorId);
            $rows = DB::table('project_owner_requirements')
                ->where('project_id', $project->id)
                ->where('context', 'tender')
                ->where('tender_user_id', $contractorId)
                ->get();

            // ProjectUser::where('project_id',$project->id)
            //     ->where('user_id',$contractorId)
            //     ->update(['status'=>'awarded']);

            // نجيب الإجماليات حسب owner_requirement_id
            $structureElectro = $rows
                ->whereIn('owner_requirement_id', [378,438]) // عدلهم حسب البنود عندك
                ->sum('total_price');

            $finishes = $rows
                ->whereIn('owner_requirement_id', [452]) // مثال
                ->sum('total_price');

            $boundaryWall = $rows
                ->whereIn('owner_requirement_id', [496]) // مثال
                ->sum('total_price');

            $structureWithFinishes = $structureElectro + $finishes;

            $approvedArea = $project->approved_area ?? 0;

            $footWithoutFinishes = $approvedArea > 0
                ? $structureElectro / $approvedArea
                : 0;

            $footWithFinishes = $approvedArea > 0
                ? $structureWithFinishes / $approvedArea
                : 0;

            $totalVillaWithWall = $structureWithFinishes + $boundaryWall;

            $vat = $totalVillaWithWall /21;//* 0.05;

            $finalTotal = $totalVillaWithWall + $vat;

            // نخزنهم
            /*$contractor->structureElectro = $structureElectro;
            $contractor->structureWithFinishes = $structureWithFinishes;
            $contractor->footWithoutFinishes = $footWithoutFinishes;
            $contractor->footWithFinishes = $footWithFinishes;
            $contractor->boundaryWall = $boundaryWall;
            $contractor->totalVillaWithWall = $totalVillaWithWall;
            $contractor->vat = $vat;
            $contractor->finalTotal = $finalTotal;*/


            //dd($finalTotal);
            // 2️⃣ تحديث جدول المشاريع
            $project->update([
                'contractor_id' => $contractorId,
                'bank_contract_value' => $finalTotal,
                'project_owner_support'=>($finalTotal-($project->project_bank_support))
            ]);


            ProjectUser::where('project_id',$project->id)
                ->where('user_id',$contractorId)
                ->update(['status'=>'awarded','role_id'=>3]);

            // 3️⃣ حذف كل المرشحين
            /*$project->users()
                ->wherePivot('role_id', 8)
                ->detach();*/

            // 4️⃣ إضافة المقاول كرول رسمي
            /*$project->users()->syncWithoutDetaching([
                $contractorId => ['role_id' => 3]
            ]);*/

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