<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;




class UserAttachmentController extends Controller
{
    //
    /*public function create($userId)
    {
        $user = \App\Models\User::findOrFail($userId);

        $attTypes = \App\Models\AttachmentType::where('active', 1)
            ->orderBy('name_ar')
            ->get();

        return view('users.attachments.create', compact('user', 'attTypes'));
    }*/
        private function resolveModel($type)
        {
            return match ($type) {
                'users'    => \App\Models\User::class,
                'projects' => \App\Models\Project::class,
                //'tender' => \App\Models\ProjectTender::class,
                default    => abort(404)
            };
        }

        /*public function create($type, $id)
        {
            $modelClass = $this->resolveModel($type);
            $model = $modelClass::findOrFail($id);

            //$attTypes = \App\Models\AttachmentType::where('active', 1)->get();
            $attTypes = \App\Models\AttachmentType::where('active', 1)
                ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');
            return view('users.attachments.create', [
                'model'     => $model,
                'type'      => $type,
                'attTypes'  => $attTypes
            ]);
        }*/

        /*public function create($type, $id)
        {
            $modelClass = $this->resolveModel($type); // returns User::class or Project::class
            $model = $modelClass::findOrFail($id);

            $attTypes = \App\Models\AttachmentType::where('active', 1)
                ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');

            return view('users.attachments.create', [
                'model'    => $model,
                'type'     => $type,
                'attTypes' => $attTypes,
            ]);
        }*/
        /*public function create(Request $request, $id)
        {
            $type = $request->query('type', 'users'); // default users

            $modelClass = match ($type) {
                'users'    => \App\Models\User::class,
                'projects' => \App\Models\Project::class,
                default    => abort(404),
            };

            $model = $modelClass::findOrFail($id);

            $attTypes = \App\Models\AttachmentType::where('active', 1)
                ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');

            return view('users.attachments.create', compact(
                'model',
                'type',
                'attTypes'
            ));
        }*/

        /*public function create(Request $request, $id)
        {
            $type = $request->query('type'); // users | projects

            if (!in_array($type, ['users', 'projects'])) {
                abort(code: 404);
            }

            $modelClass = match ($type) {
                'users'    => \App\Models\User::class,
                'projects' => \App\Models\Project::class,
            };

            $model = $modelClass::findOrFail($id);

            $attTypes = \App\Models\AttachmentType::where('active', 1)
                ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');

            return view('users.attachments.create', compact('model', 'type', 'attTypes'));
        }*/

/*public function create(Request $request, $id)
{
    // type comes from ?type=projects
    $type = $request->query('type', 'users'); // default = users

    $modelClass = $this->resolveModel($type);
    $model = $modelClass::findOrFail($id);

    $attTypes = \App\Models\AttachmentType::where('active', 1)
        ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');

    return view('users.attachments.create', [
        'model'    => $model,
        'type'     => $type,
        'attTypes' => $attTypes,
    ]);
}*/




/*public function create(Request $request, $id)
{
    $type = $request->query('type', 'users'); // default users

    $modelClass = $this->resolveModel($type);
    $model = $modelClass::findOrFail($id);

    $attTypes = \App\Models\AttachmentType::where('active', 1)
        ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');

    return view('users.attachments.create', [
        'model'    => $model,
        'type'     => $type,
        'attTypes' => $attTypes,
    ]);
}*/



//tender ==>(25-33-34-35)
public function create(Request $request, $id)
{
    // type from query string
    $type = $request->query('type', 'users'); // default users
    $mode = $request->query('mode');
    $isTender = $mode === 'tender';
    
    $isContractorFiles=$mode === 'contractor_files';

    $modelClass = $this->resolveModel($type);
    $model = $modelClass::findOrFail($id);
    $project = null;
    //$project = null;$project = null;
    if ($type === 'projects') {
        $project = $model;
    }
    $isAdminFiles=false;

    // Attachment types
    //$attTypes = \App\Models\AttachmentType::where('active', 1)
    //    ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');

    // ✅ Default types by model .11 26 27 22 28 29

    $baseUserTypes = [1,3];
    $defaultTypes = $baseUserTypes;
    // contractor specific attachments
    $contractorTypes = [11,21,22,23,24];
    $defaultTypes = $type === 'projects'
        ? [2,10,12,13,14,15,16,17,18,19,32]  //20,25
        : [1,3]; 


        // default user attachments
    


    // 👇 get current user role    auth()->user()
    $userRoleId = $model->role_id;

    // 👇 admin extra attachment types
    $adminExtraTypes = [11,26,27,22,28,29,30,31,44,45];
    $currentUser = auth()->user();
    



    // 👇 if admin or special role, merge types
    if (
        ($currentUser->role_id == 1 || $currentUser->role_id == 4 || $currentUser->role_id == 11) &&
        $type === 'users' &&
        $model->id === $currentUser->id
    ) {
        $defaultTypes = array_unique(array_merge($defaultTypes, $adminExtraTypes));
        $isAdminFiles=true;
    }


    $isContractorModel = (
        $type === 'users' &&
        $model->role_id == 3 // الملف تابع لمقاول
    );

    $isContractorUser = (
        $currentUser->role_id == 3 // المستخدم نفسه مقاول
    );


   

    // لو المستخدم مقاول أو بيشوف ملفات مقاول
    if ($isContractorUser || $isContractorModel) {
        $defaultTypes = $contractorTypes;//array_unique(array_merge($baseUserTypes, $contractorTypes));
    }


    if ($isTender) {

        // tender ==>(25-33-34-35)
        $defaultTypes = [40,41,2,14,13];//[25, 33, 34, 35];
    }



    if ($isContractorFiles) {

        // tender ==>(25-33-34-35)
        $defaultTypes = [25, 33, 34, 35,36,37,38,39];
    }



    //dd($defaultTypes);
    $userRoleId = auth()->user()->role_id;

    // allowed types
    $allowedTypes = $defaultTypes;

    // fetch only allowed attachment types
    $attTypes = \App\Models\AttachmentType::where('active', 1)
        ->whereIn('id', $allowedTypes)
        ->pluck(
            app()->getLocale() === 'ar' ? 'name_ar' : 'name_en',
            'id'
        );



    $attachments = \App\Models\Attachment::where('attachable_type', get_class($model))
        ->where('attachable_id', $model->id)
        ->get();

    $attachments->transform(function ($att) {
        if ($att->AttPath) {
            // شيل UNC prefix
            $path = str_replace('\\\\svr\\RAKcMainApp$', '', $att->AttPath);

            // حول \ إلى /
            $path = str_replace('\\', '/', $path);

            // خزنه مؤقتًا للعرض
            $att->web_path = $path; // Files/xxx.pdf
        }

        return $att;
    });

    $attachmentsByType = $attachments->keyBy('attachment_type_id');

    $rows = collect($allowedTypes)->map(function ($typeId) use ($attachmentsByType) {
        return [
            'type_id'   => $typeId,
            'attachment'=> $attachmentsByType->get($typeId), // null لو مش مرفوع
        ];
    });


    //dd($attachments);
    return view('users.attachments.create', compact(
        'model',
        'isTender',
        'type',
        'rows',
        'attTypes',
        'defaultTypes',
        'attachments',
        'isAdminFiles',
        'project'
    ));
}



/*public function form(Request $request, $id)
{
    $type = $request->get('type', 'users');

    $attachments = Attachment::where('attachable_type', User::class)
        ->where('attachable_id', $id)
        ->get();

    return view('users.attachments.form', compact(
        'id',
        'type',
        'attachments'
    ));
}*/



public function store(Request $request, $id)
{
    $type = $request->query('type', 'users');
    //dd($isContractorFiles);
    if($type==1)$type='projects';
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
    //
    
    $isTender = $request->query('mode') === 'tender';

    $modelClass = $this->resolveModel($type);
    
    $model = $modelClass::findOrFail($id);

    if ($request->has('attachments')) {
        foreach ($request->attachments as $attachment) {




            if (!empty($attachment['id'])) {

                $att = Attachment::find($attachment['id']);
                if (!$att) continue;

                if (!empty($attachment['file'])) {
                    $file = $attachment['file'];
                    $filename = uniqid().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('Files'), $filename);

                    $att->file_name = $file->getClientOriginalName();
                    $att->file_type = $file->getClientOriginalExtension();
                    $att->AttPath   = '\\\\svr\\RAKcMainApp$\\Files\\'.$filename;
                }

                $att->attachment_type_id = $attachment['attachment_type_id'];
                $att->expiration_date = $attachment['expiration_date'] ?? null;
                $att->notes = $attachment['notes'] ?? null;
                $att->save();

                continue;
            }



            if (
                empty($attachment['file']) ||
                !$attachment['file']->isValid() ||
                empty($attachment['attachment_type_id'])
            ) {
                continue;
            }

            $file = $attachment['file'];

            $filename = $model->id . '_' . $type . '_' . time() . '_' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $path = public_path('Files');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);

            \App\Models\Attachment::create([
                'attachable_id'   => $model->id,
                'attachable_type' => get_class($model),
                'attachment_type_id' => $attachment['attachment_type_id'],
                'file_name'       => $file->getClientOriginalName(),
                'file_type'       => $file->getClientOriginalExtension(),
                'AttPath'         => '\\\\svr\\RAKcMainApp$\\Files\\' . $filename,


                'expiration_date'   => $attachment['expiration_date'] ?? null,
                'is_expired'        => isset($attachment['expiration_date'])
                                        ? now()->gt($attachment['expiration_date'])
                                        : false,

                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }

    //return redirect()
    //    ->route('attachments.create', ['id' => $id, 'type' => $type])
    //    ->with('success', 'Attachments uploaded successfully');



    $type = $request->get('type');

   if ($request->action === 'save') {

    if ($type === 'projects') {
        return redirect()
            ->back()
            ->with('toast', [
                'type' => 'success',
                'message' => __('Saved successfully')
            ]);
    }

    return redirect()
        ->back()
        ->with('toast', [
            'type' => 'success',
            'message' => __('Saved successfully')
        ]);
}

if ($request->action === 'save_create_project') {
    /*return redirect()
        ->route('projects.create')
        ->with('toast', [
            'type' => 'success',
            'message' => __('Saved successfully')
        ]);*/
        $params = [];

        if ($model->role_id == 3) {
            // Contractor
            $params['contractor_id'] = $model->id;
        } elseif ($model->role_id == 2) {
            // Owner
            $params['owner_id'] = $model->id;
        }

        return redirect()
            ->route('projects.create', $params)
            ->with('toast', [
                'type' => 'success',
                'message' => __('Saved successfully')
            ]);
    

}

}














/*public function update(Request $request, $type, $id)
{
    foreach ($request->attachments as $attId => $data) {

        $attachment = Attachment::find($attId);
        if (!$attachment) continue;

        // Replace file if uploaded
        if (!empty($data['file'])) {
            $file = $data['file'];
            $filename = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path('Files'), $filename);

            $attachment->AttPath = '\\\\svr\\RAKcMainApp$\\Files\\' . $filename;
            $attachment->file_name = $file->getClientOriginalName();
            $attachment->file_type = $file->getClientOriginalExtension();
        }

        $attachment->update([
            'attachment_type_id' => $data['attachment_type_id'],
            'expiration_date'    => $data['expiration_date'] ?? null,
            'notes'              => $data['notes'] ?? null,
            'is_expired'         => isset($data['expiration_date'])
                                    ? now()->gt($data['expiration_date'])
                                    : false,
        ]);
    }

    return redirect()
        ->back()
        ->with('toast', [
            'type' => 'success',
            'message' => __('Attachments updated successfully')
        ]);
}*/

        /*public function store(Request $request, $id)
{
    $type = $request->query('type');

    if (!in_array($type, ['users', 'projects'])) {
        abort(404);
    }

    $modelClass = match ($type) {
        'users' => \App\Models\User::class,
        'projects' => \App\Models\Project::class,
    };

    $model = $modelClass::findOrFail($id);

    foreach ($request->attachments ?? [] as $attachment) {
        if (empty($attachment['file']) || !$attachment['file']->isValid()) continue;

        $file = $attachment['file'];

        $filename = $model->id.'_'.time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $filename);

        \App\Models\Attachment::create([
            'attachable_id'   => $model->id,
            'attachable_type' => $modelClass,
            'attachment_type_id' => $attachment['attachment_type_id'],
            'file_name'       => $file->getClientOriginalName(),
            'file_type'       => $file->getClientOriginalExtension(),
            'AttPath'         => '\\\\svr\\RAKcMainApp$\\Files\\' . $filename,
            'notes'           => $attachment['notes'] ?? null,
        ]);
    }

    return redirect()
        ->route('attachments.create', [$id, 'type' => $type])
        ->with('success', 'Attachments uploaded successfully');
}*/



        /*public function store(Request $request, $type, $id)
        {
            $modelClass = $this->resolveModel($type);
            $model = $modelClass::findOrFail($id);

            if ($request->has('attachments')) {
                foreach ($request->attachments as $attachment) {

                    if (
                        empty($attachment['file']) ||
                        !$attachment['file']->isValid() ||
                        empty($attachment['attachment_type_id'])
                    ) {
                        continue;
                    }

                    $file = $attachment['file'];

                    $filename = $model->id . '_' . $type . '_' . time() . '_' . uniqid()
                        . '.' . $file->getClientOriginalExtension();

                    $path = public_path('Files');
                    if (!file_exists($path)) {
                        mkdir($path, 0755, true);
                    }

                    $file->move($path, $filename);

                    \App\Models\Attachment::create([
                        'attachable_id'   => $model->id,
                        'attachable_type' => get_class($model),
                        'attachment_type_id' => $attachment['attachment_type_id'],
                        'file_name'       => $file->getClientOriginalName(),
                        'file_type'       => $file->getClientOriginalExtension(),
                        'AttPath'         => '\\\\svr\\RAKcMainApp$\\Files\\' . $filename,
                        'notes'           => $attachment['notes'] ?? null,
                    ]);
                }
            }

            // 🔁 Redirect smartly
            return redirect()
                ->route($type . '.index')
                ->with('success', '✅ Attachments uploaded successfully');
        }*/




/*public function store(Request $request, $userId)
{
    //dd($request->all());
    $user = User::findOrFail($userId);

    if ($request->has('attachments')) {

        foreach ($request->attachments as $attachment) {

            if (
                !isset($attachment['file']) ||
                !$attachment['file']->isValid() ||
                empty($attachment['attachment_type_id'])
            ) {
                continue;
            }

            $file = $attachment['file'];

            $date = now()->format('d-m-Y');
            $filename = $user->id
                . '_users_'
                . $date
                . '_' . time()
                . '_' . uniqid()
                . '.' . $file->getClientOriginalExtension();

            $path = public_path('Files');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);

            Attachment::create([
                'attachable_id'     => $user->id,
                'attachable_type'   => User::class, // polymorphic
                'attachment_type_id'=> $attachment['attachment_type_id'],
                'file_name'         => $file->getClientOriginalName(),
                'file_type'         => $file->getClientOriginalExtension(),
                'AttPath'           => '\\\\svr\\RAKcMainApp$\\Files\\' . $filename,
                'notes'             => $attachment['notes'] ?? null,
            ]);
        }
    }

    if ($request->action === 'save_create_project') {
        return redirect()->route('projects.create', ['user_id' => $user->id]);
    }

    return redirect()
        ->route('users.index')
        ->with('success', '✅ Attachments uploaded successfully');
}*/









}
