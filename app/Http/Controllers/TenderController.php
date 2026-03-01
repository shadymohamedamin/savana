<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\OwnerRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenderController extends Controller
{
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

        foreach ($contractors as $contractor) {

            $rows = DB::table('project_owner_requirements')
                ->where('project_id', $project->id)
                ->where('context', 'tender')
                ->where('tender_user_id', $contractor->id)
                ->get();

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

            $vat = $totalVillaWithWall * 0.05;

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
            'lowestPrice'
        ));
    }

    public function store(Request $request, Project $project)
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
    }
}