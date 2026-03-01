<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function contractors(Project $project)
{
    $contractors = User::where('role_id', 3)->get(); // 👈 هنا التعديل

    $selected = $project->users()
        ->wherePivot('role_id', 8)
        ->pluck('users.id')
        ->toArray();

    return view('projects.tender.contractors', compact('project','contractors','selected'));
}

    public function store(Request $request, Project $project)
{
    $project->users()
        ->wherePivot('role_id', 8)
        ->detach(); // نحذف القديم

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
