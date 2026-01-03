<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrimaryData;
use App\Models\PrimaryDataSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /*public function index()
    {
        return view('home');
    }*/


    /*public function index()
    {
        $user = Auth::user();
        //dd($user);
        $idNo = $user->uae_id;
        
        //dd($idNo);
        // Try to get from submissions
        $data = PrimaryDataSubmission::with('nationality')->where('IDNo', $idNo)->first();

        if (!$data) {
            $data = PrimaryData::with('nationality')->where('IDNo', $idNo)->first();
        }

        // Example: also fetch attached files if exists
        $files = $data ? $data->files ?? [] : [];

        return view('home', compact('data', 'files'));
    }*/

    /*public function index()
    {
        $user = Auth::user();
        //$user = Auth::user();
        //dd($user);
        $idNo = $user->uae_id;
        
        //dd($idNo);
        // Try to get from submissions
        $data = PrimaryDataSubmission::with('nationality')->where('IDNo', $idNo)->first();

        if (!$data) {
            $data = PrimaryData::with('nationality')->where('IDNo', $idNo)->first();
        }


        $submissions = \App\Models\SupportSubmission::where('IDNo', $user->uae_id)->get();


        $completedSupports = \App\Models\Support::where('CaseID', $data->ID)
                                        ->where('is_completed', true)
                                        ->get();
        $incompleteSupports = \App\Models\Support::where('CaseID', $data->ID)
                                         ->where('is_completed', false)
                                         ->get();

        $files = $data ? $data->files : [];

        return view('home', compact('data', 'submissions', 'completedSupports','incompletedSupports', 'files'));
    }*/

    /*public function index()
    {
        $user = Auth::user();
        $idNo = $user->uae_id;

        // Try to get data from submissions first
        $data = PrimaryDataSubmission::with('nationality')->where('IDNo', $idNo)->first();
        if (!$data) {
            $data = PrimaryData::with('nationality')->where('IDNo', $idNo)->first();
        }
        //dd($data);
        // Files
        $files = $data ? $data->files : [];

        // Completed supports
        $completedSupports = \App\Models\Support::where('uae_id', $idNo)
                                            ->where('is_completed', true)
                                            ->get();

        // Incompleted from supports
        $incompleteSupports = \App\Models\Support::where('uae_id', $idNo)
                                             ->where('is_completed', false)
                                             ->get()
                                             ->map(function ($item) {
                                                 $item->source = 'supports';
                                                 return $item;
                                             });

        // Incompleted from support_submissions
        $submissions = \App\Models\SupportSubmission::where('uae_id', $idNo)
                                                ->get()
                                                ->map(function ($item) {
                                                    $item->source = 'submissions';
                                                    return $item;
                                                });

        // Merge both
        $mergedSupports = $incompleteSupports->concat($submissions);

        return view('home', compact('data', 'files', 'completedSupports', 'mergedSupports'));
    }*/


public function edit()
{
    $user = auth()->user();
    $uae=$user->uae_id;
    $primaryData = \App\Models\PrimaryDataSubmission::where('IDNo', $uae)->first();
    //$primaryData = \App\Models\SupportSubmission::where('uae_id', $uae)->first();
    $attachments = \App\Models\AttachmentSubmission::where('uae_id', $uae)->get();

    $supports = \App\Models\SupportSubmission::where('uae_id', $uae)->first();


    $sexes = \App\Models\Sex::pluck('Sex', 'ID');
    $nationalities = \App\Models\Nationalit::pluck('Nationality', 'ID');
    $maritalStatuses = \App\Models\MaritalStatus::pluck('MaritalStatus', 'ID');
    $careers = \App\Models\Career::pluck('Career', 'ID');
    $regions = \App\Models\Region::pluck('Region', 'ID');
    $houseTypes = \App\Models\HouseType::pluck('HouseType', 'ID');
    $supportTypes = \App\Models\SupportType::pluck('SupportType', 'ID');
    $attTypes = \App\Models\AttachmentType::pluck('AttType', 'ID');


    //dd($attachments);
    return view('user_edit', compact(
        'user',
        'attachments',
        'supports',
        'sexes',
        'nationalities',
        'maritalStatuses',
        'careers',
        'regions',
        'houseTypes',
        'supportTypes',
        'attTypes',
        'primaryData'
    ));
}




public function update(Request $request, $userId)
{
    try {
        $data = $request->all();
        //dd($data);
        // 1. Validate
        $validator =Validator::make($data, [
            'Nam' => ['required', 'string', 'max:255'],
            'NamEn' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            //'uae_id' => ['required', 'string', 'min:14'],
            'mobile' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'exists:sexes,ID'],
            'Section' => ['required', 'integer'],
            'Trustee' => ['nullable', 'string'],
            'TrusteeEn' => ['nullable', 'string'],
            'DateOfBirth' => ['required', 'date'],
            'Nationality' => ['required' ],
            'Career' => ['required', ],
            'CareerAddress' => ['required'],
            'FamilyCount' => ['required', 'integer'],
            'InSchool' => ['required', 'integer'],
            'MaritalStatus' => ['required' ],
            'WifeName' => ['nullable'],
            'WifeAddress' => ['nullable'],
            'WifeCareer' => ['nullable', ],
            'WifeNationality' => ['nullable' ],
            'Region' => ['required', ],
            'HouseType' => ['required' ],
            'help_type' => ['required'],
            'support_ammount_user' => ['required', 'integer'],
            'case_description_user' => ['required'],
            'attachments.*.type' => ['required' ],
            'attachments.*.file' => ['nullable', 'file'],
        ]);//->validate();
        
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $validated = $validator->validated();
        $user = DB::transaction(function () use ($data, $userId) {
            // 2. Update user
            $user = \App\Models\User::findOrFail($userId);
            $user->update([
                'name' => $data['Nam'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                //'uae_id' => $data['uae_id'],
            ]);

            // 3. Update primary data
            DB::table('primary_datas_submissions')
                ->where('IDNo', $user->uae_id)
                ->update([
                    'Nam' => $data['Nam'],
                    'NamEn' => $data['NamEn'],
                    'Sex' => $data['sex'],
                    'Section' => $data['Section'],
                    'Nationality' => $data['Nationality'],
                    'MaritalStatus' => $data['MaritalStatus'],
                    'Career' => $data['Career'],
                    'CareerAddress' => $data['CareerAddress'],
                    'Region' => $data['Region'],
                    'HouseType' => $data['HouseType'],
                    'FamilyCount' => $data['FamilyCount'],
                    'InSchool' => $data['InSchool'],
                    'DateOfBirth' => $data['DateOfBirth'],
                    'Trustee' => $data['Trustee'] ?? null,
                    'TrusteeEn' => $data['TrusteeEn'] ?? null,
                    'WifeName' => $data['WifeName'] ?? null,
                    'WifeAddress' => $data['WifeAddress'] ?? null,
                    'WifeCareer' => $data['WifeCareer'] ?? null,
                    'WifeNationality' => $data['WifeNationality'] ?? null,
                    'LastUpdate' => now(),
                ]);

            // 4. Update support info
            DB::table('supports_submissions')
                ->where('uae_id', $user->uae_id)
                ->update([
                    'help_type' => $data['help_type'],
                    'support_ammount_user' => $data['support_ammount_user'],
                    'case_description_user' => $data['case_description_user'],
                    'Dat' => now(),
                ]);

            // 5. Handle attachments
            if (!empty($data['attachments']) && is_array($data['attachments'])) {
                foreach ($data['attachments'] as $attachment) {
                    $attId = $attachment['type'];
                    $file = $attachment['file'] ?? null;
                    $existingId = $attachment['id'] ?? null;

                    $filePath = null;
                    
                    if ($file && $file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) {
                        $ext = $file->getClientOriginalExtension() ?: $file->guessExtension();
                        $prefix = DB::table('attachment_types')->where('ID', $attId)->value('Prefix') ?? 'ATT';
                        $fileName = $prefix . '_' . $user->id . '_' . uniqid() . '.' . $ext;
                        $file->move(public_path('Files'), $fileName);
                        $filePath = '\\\\svr\\RAKcMainApp$\\Files\\' . $fileName;
                    }
                    $primaryData = DB::table('primary_datas_submissions')
                        ->where('IDNo', $user->uae_id)
                        ->first();

                    if (!$primaryData) {
                        return back()->with('error', 'لا يوجد بيانات رئيسية لهذا المستخدم');
                    }

                    $primaryId = $primaryData->ID; 
                   
                    if ($existingId) {
                        // Update existing attachment
                        $updateData = ['AttID' => $attId];
                        $updateData['CaseID']=$primaryId;

                        if ($filePath) {
                            $updateData['AttPath'] = $filePath;
                            
                        }
                        dd($updateData);
                        DB::table('attachments_submissions')
                            ->where('ID', $existingId)
                            ->update($updateData);
                    } elseif ($filePath) {
                        // Insert new attachment
                        //dd($user->id.$attId.$filePath.$user->uae_id);
                        DB::table('attachments_submissions')->insert([
                            'CaseID' => $primaryId,
                            'AttID' => $attId,
                            'AttPath' => $filePath,
                            'uae_id' => $user->uae_id,
                        ]);
                    }
                    else dd('error');


                }

            }

            return $user;
        });

        // ✅ Success
        dd('تم التحديث بنجاح: ' . $user->name);

    } catch (\Exception $e) {
        // ❌ Error
        dd('حدث خطأ: ' . $e->getMessage());
    }
}

/*public function update(Request $request)
{
    dd($request->toArray());
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'uae_id' => 'required|string',
        'mobile' => 'required|string',
        'sex' => 'required|in:1,2',
        'password' => 'nullable|confirmed|min:6',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'uae_id' => $request->uae_id,
        'mobile' => $request->mobile,
        'sex' => $request->sex,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
    ]);

    return redirect()->route('home')->with('success', 'Profile updated successfully.');
}*/







    public function index()
{
    $user = Auth::user();
    $uaeId = $user->uae_id;

    // Try to get data from submissions first
    $data = PrimaryDataSubmission::with('nationality')->where('IDNo', $uaeId)->first();
    if (!$data) {
        $data = PrimaryData::with('nationality')->where('IDNo', $uaeId)->first();
    }

    // Files (if relationship exists)
    $files = $data ? $data->files : [];

    // Completed supports
    $completedSupports = \App\Models\Support::where('uae_id', $uaeId)
                                            ->where('is_completed', true)
                                            ->get();

    // Incompleted supports
    $incompleteSupports = \App\Models\Support::where('uae_id', $uaeId)
                                             ->where('is_completed', false)
                                             ->get()
                                             ->map(function ($item) {
                                                 $item->source = 'supports';
                                                 return $item;
                                             });

    // Incompleted support submissions
    $submissions = \App\Models\SupportSubmission::where('uae_id', $uaeId)
                                                ->get()
                                                ->map(function ($item) {
                                                    $item->source = 'submissions';
                                                    return $item;
                                                });

    // Merge
    $mergedSupports = $incompleteSupports->concat($submissions);

    return view('home', compact('data', 'files', 'completedSupports', 'mergedSupports'));
}



}

