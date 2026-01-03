<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Flash;
use App\Helpers\AuditHelper;

use App\Http\Requests\CreatePrimaryDataRequest;
use App\Http\Requests\UpdatePrimaryDataRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PrimaryDataRepository;
use App\Models\PrimaryData;
use App\Models\Nationalit;
use App\Models\Career;
use App\Models\MaritalStatus;
use App\Models\HouseType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


abstract class AbstractPrimaryDataController extends Controller
{
    protected $modelClass;
    protected $repository;
    protected $viewFolder;
    protected $routeName;

    public function index(Request $request)
    {
        $query = $this->modelClass::query();
        $columns = Schema::getColumnListing((new $this->modelClass)->getTable());

        foreach ($columns as $column) {
            if ($column === 'Sex' && $request->filled('Sex')) {
                $query->where('Sex', $request->Sex);
            } elseif (Str::contains($column, ['_date', 'Date','LastUpdate','IDExpiry'])) {
                if ($request->filled("{$column}_from")) {
                    $query->whereDate($column, '>=', $request->input("{$column}_from"));
                }
                if ($request->filled("{$column}_to")) {
                    $query->whereDate($column, '<=', $request->input("{$column}_to"));
                }
                if ($request->filled($column)) {
                    $query->whereDate($column, $request->$column);
                }
            } elseif ($request->filled($column)) {
                if (Str::startsWith($column, ['is_', 'has_', 'approved', 'active', 'status'])) {
                    $query->where($column, $request->$column);
                } elseif (Str::contains($column, ['ID','FileNo','count', 'Count', 'number', 'Number'])) {
                    $query->where($column, $request->$column);
                } else {
                    $query->where($column, 'like', $request->$column . '%');
                }
            }
        }

        //$items = $query->with(['Nationality','Region','Career','MaritalStatus','WifeCareer','WifeNationality','HouseType','userAdd','userEdit'])
        //    ->orderBy('ID', 'desc')
        //    ->paginate(10);
        if (\Route::currentRouteName() === 'primary_datas.mySubmissions') {
            $query->where('request_status_user_id', auth()->id());
        }
        $primaryDatas = $query
            //->where('is_completed', true)
            //->whereNull('request_status_user_id')
            ->with(['Nationality','Region', 'Career', 'MaritalStatus', 'WifeCareer', 'WifeNationality', 'HouseType', 'userAdd', 'userEdit'])
            ->orderBy('ID', 'desc')
            ->paginate(10);
        //\Log::info($primaryDatas->pluck('userEdit'));
        $nationalities = Nationalit::pluck('nationality','id');
        $careers = Career::pluck('career','id');
        $maritalStatuses = MaritalStatus::pluck('MaritalStatus','id');
        $users = User::pluck('name','id');
        $houseTypes = HouseType::pluck('HouseType','id');

        return view('primary_datas.index', compact(
            'primaryDatas','nationalities', 'careers', 'maritalStatuses','columns','users','houseTypes'
        ));

        //return view("{$this->viewFolder}.index", compact('items', 'columns'));
    }

    public function create()
    {
        $data = $this->sharedFormData();
        return view("{$this->viewFolder}.create", $data);
    }

    /*public function store(Request $request)
    {
        $input = $request->all();
        $now = Carbon::now();

        $input['UserAdd'] = auth()->id();
        $input['UserEdit'] = auth()->id();
        $input['CaseDate'] = $now;
        $input['LastUpdate'] = $now;
        $input['FileNo'] = mt_rand(10000000, 99999999);

        $record = $this->repository->create($input);
        $record->FileNo = $record->ID + 2;
        $record->save();

        AuditHelper::logAudit('created', $record, [], $record->getAttributes());
        Flash::success("Data saved successfully.");

        return redirect()->route("{$this->routeName}.index");
    }*/




    public function store(Request $request)
    {
        $routeName = \Route::currentRouteName();

        $input = $request->all();
        $now = Carbon::now();
        $input['UserAdd'] = auth()->id();
        $input['UserEdit'] = auth()->id();
        $input['CaseDate'] = $now;
        $input['LastUpdate'] = $now;
        $input['FileNo'] = mt_rand(10000000, 99999999);

        if ($routeName === 'primaryDatasSubmissions.store') {
            $id = DB::table('primary_datas_submissions')->insertGetId($input);
            AuditHelper::logAudit('created', 'primary_datas_submissions', [], $input);
            Flash::success("✅ تم حفظ البيانات مؤقتًا.");
            return redirect()->route("{$this->routeName}.index");
        }

        $record = $this->repository->create($input);
        $record->FileNo = $record->ID + 2;
        $record->save();

        AuditHelper::logAudit('created', $record, [], $record->getAttributes());
        Flash::success("Data saved successfully.");

        return redirect()->route("{$this->routeName}.index");
    }


    /*public function edit($id)
    {
        $item = $this->repository->find($id);
        if (empty($item)) {
            Flash::error('Record not found');
            return redirect()->route("{$this->routeName}.index");
        }

        $data = $this->sharedFormData();
        return view("{$this->viewFolder}.edit", array_merge($data, ['primaryData' => $item]));
    }*/
    public function edit($id)
    {
        $routeName = \Route::currentRouteName();
        if ($routeName === 'primaryDatasSubmissions.edit') {
            $item = DB::table('primary_datas_submissions')->where('id', $id)->first();
            if (!$item) {
                Flash::error('Record not found');
                return redirect()->route("{$this->routeName}.index");
            }

            $data = $this->sharedFormData();
            return view("{$this->viewFolder}.edit", array_merge($data, ['primaryData' => (object)$item]));
        }

        $item = $this->repository->find($id);
        if (empty($item)) {
            Flash::error('Record not found');
            return redirect()->route("{$this->routeName}.index");
        }

        $data = $this->sharedFormData();
        return view("{$this->viewFolder}.edit", array_merge($data, ['primaryData' => $item]));
    }


    /*public function update($id, Request $request)
    {
        $item = $this->repository->find($id);
        if (empty($item)) {
            Flash::error('Record not found');
            return redirect()->route("{$this->routeName}.index");
        }
        
        $input = $request->except(['_token', '_method']);
        $input['UserEdit'] = auth()->id();
        $input['LastUpdate'] = Carbon::now();
            if (isset($input['request_status_user_id']) && $input['request_status_user_id'] === 'completed') {
                $input['request_status_user_id'] = null;
                //$input['is_completed'] = true;
            } else {
                //$input['is_completed'] = false;
            }
        //dd($input);
        $input['is_completed'] = $request->has('is_completed') ? 1 : 0;
        //dd($input);
        $oldValues = $item->getAttributes();
        $updatedItem = $this->repository->update($input, $id);
        $newValues = $updatedItem->getAttributes();

        AuditHelper::logAudit('updated', $item, $oldValues, $newValues);
        Flash::success("Data updated successfully.");

        return redirect()->route("{$this->routeName}.index");
    }*/




    
    /*public function update($id, Request $request)
{
    $item = DB::table('primary_datas_submissions')->where('id', $id)->first();

    if (!$item) {
        Flash::error('Record not found');
        return redirect()->route("{$this->routeName}.index");
    }

    $input = $request->except(['_token', '_method']);
    $input['UserEdit'] = auth()->id();
    $input['LastUpdate'] = now();
    $input['is_completed'] = $request->has('is_completed') ? 1 : 0;

    if (isset($input['request_status_user_id']) && $input['request_status_user_id'] === 'completed') {
        $input['request_status_user_id'] = null;
    }

    $oldValues = (array) $item;

    if ($input['is_completed']) {
        DB::beginTransaction();

        try {
            $dataToTransfer = array_merge((array) $item, $input);

            unset($dataToTransfer['id'], $dataToTransfer['created_at'], $dataToTransfer['updated_at']);

            // توليد FileNo إذا لم يكن موجودًا
            

            // حذف من جدول الـ submission بعد النقل
            //DB::table('primary_datas_submissions')->where('id', $id)->delete();
            $record = new PrimaryData($dataToTransfer);
            $record->save();
            $record->FileNo = $record->ID + 2;
            $record->save();

            AuditHelper::logAudit('moved', 'primary_datas_submissions', $oldValues, $dataToTransfer);
            DB::commit();
            Flash::success("✅ تم نقل البيانات بنجاح.");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('❌ فشل النقل: ' . $e->getMessage());
            Flash::error("حدث خطأ أثناء نقل البيانات.");
        }
    } else {
        // تحديث فقط في جدول الـ submissions
        DB::table('primary_datas_submissions')->where('id', $id)->update($input);
        AuditHelper::logAudit('updated', 'primary_datas_submissions', $oldValues, $input);
        Flash::success("تم التحديث بنجاح.");
    }

    return redirect()->route("{$this->routeName}.index");
}*/

// public function update($id, Request $request)
// {
//     $item = DB::table('primary_datas_submissions')->where('id', $id)->first();

//     if (!$item) {
//         Flash::error('Record not found');
//         return redirect()->route("{$this->routeName}.index");
//     }

//     $input = $request->except(['_token', '_method']);
//     $input['UserEdit'] = auth()->id();
//     $input['LastUpdate'] = now();
//     $input['is_completed'] = $request->has('is_completed') ? 1 : 0;

//     if (isset($input['request_status_user_id']) && $input['request_status_user_id'] === 'completed') {
//         $input['request_status_user_id'] = null;
//     }

//     $oldValues = (array) $item;

//     if ($input['is_completed']) {
//         DB::beginTransaction();

//         try {
//             // دمج البيانات الأصلية من الجدول المؤقت مع البيانات القادمة من الفورم
//             $dataToTransfer = array_merge((array) $item, $input);
//             unset($dataToTransfer['ID'], $dataToTransfer['created_at'], $dataToTransfer['updated_at']);

//             // تنسيق التواريخ إذا كانت من نوع Carbon
//             $dateFields = ['CaseDate', 'Renew_Date', 'Permission_Date', 'DateOfBirth', 'LastUpdate', 'IDExpiry'];
//             foreach ($dateFields as $field) {
//                 if (!empty($dataToTransfer[$field]) && $dataToTransfer[$field] instanceof \Carbon\Carbon) {
//                     $dataToTransfer[$field] = $dataToTransfer[$field]->format('Y-m-d');
//                 }
//             }

//             // تحقق من وجود السجل مسبقًا بنفس رقم الهوية
//             $existing = DB::table('primary_datas')->where('IDNo', $dataToTransfer['IDNo'])->first();

//             if ($existing) {
//                 // ✅ تحديث السجل الموجود
//                 //DB::table('primary_datas')
//                 //    ->where('IDNo', $dataToTransfer['IDNo'])
//                 //    ->update($dataToTransfer);
                
                
//                 /*$record = PrimaryData::where('IDNo', $dataToTransfer['IDNo'])->first();
//                 $record->fill($dataToTransfer);
//                 $record->save();*/
//                 //$dataToTransfer['CaseDate'] = now()->format('Y-m-d');
//                 //$record = PrimaryData::where('IDNo', $dataToTransfer['IDNo'])->first();
//                 //$record->Nam=$dataToTransfer["Nam"];
//                 //$record->Trustee=$dataToTransfer["Trustee"];
                
//                 //dd($record."edit");
                
                
//                 //$record = PrimaryData::where('IDNo', $dataToTransfer['IDNo'])->first();

//                 /*if ($record) {
//                     $record->Section = $dataToTransfer['Section'] ?? $record->Section;
//                     $record->Nam = $dataToTransfer['Nam'] ?? $record->Nam;
//                     $record->NamEn = $dataToTransfer['NamEn'] ?? $record->NamEn;
//                     $record->Trustee = $dataToTransfer['Trustee'] ?? $record->Trustee;
//                     $record->TrusteeEn = $dataToTransfer['TrusteeEn'] ?? $record->TrusteeEn;
//                     $record->Sex = $dataToTransfer['Sex'] ?? $record->Sex;
//                     $record->Nationality = $dataToTransfer['Nationality'] ?? $record->Nationality;
//                     $record->Career = $dataToTransfer['Career'] ?? $record->Career;
//                     $record->CareerAddress = $dataToTransfer['CareerAddress'] ?? $record->CareerAddress;
//                     $record->FamilyCount = $dataToTransfer['FamilyCount'] ?? $record->FamilyCount;
//                     $record->InSchool = $dataToTransfer['InSchool'] ?? $record->InSchool;
//                     $record->IDNo = $dataToTransfer['IDNo'] ?? $record->IDNo;
//                     $record->MaritalStatus = $dataToTransfer['MaritalStatus'] ?? $record->MaritalStatus;
//                     $record->WifeName = $dataToTransfer['WifeName'] ?? $record->WifeName;
//                     $record->WifeAddress = $dataToTransfer['WifeAddress'] ?? $record->WifeAddress;
//                     $record->WifeCareer = $dataToTransfer['WifeCareer'] ?? $record->WifeCareer;
//                     $record->WifeNationality = $dataToTransfer['WifeNationality'] ?? $record->WifeNationality;
//                     $record->HouseType = $dataToTransfer['HouseType'] ?? $record->HouseType;
//                     $record->mob = $dataToTransfer['mob'] ?? $record->mob;
//                     $record->Tel1 = $dataToTransfer['Tel1'] ?? $record->Tel1;
//                     $record->Tel2 = $dataToTransfer['Tel2'] ?? $record->Tel2;
//                     $record->Email = $dataToTransfer['Email'] ?? $record->Email;
//                     $record->Region = $dataToTransfer['Region'] ?? $record->Region;
//                     $record->CaseDate = $dataToTransfer['CaseDate'] ?? $record->CaseDate;
//                     $record->Approved = $dataToTransfer['Approved'] ?? $record->Approved;
//                     $record->UserAdd = $dataToTransfer['UserAdd'] ?? $record->UserAdd;
//                     $record->UserEdit = $dataToTransfer['UserEdit'] ?? $record->UserEdit;
//                     $record->request_status_user_id = $dataToTransfer['request_status_user_id'] ?? $record->request_status_user_id;
//                     $record->LastUpdate = $dataToTransfer['LastUpdate'] ?? $record->LastUpdate;
//                     $record->Cancel = $dataToTransfer['Cancel'] ?? $record->Cancel;
//                     $record->Permission_No = $dataToTransfer['Permission_No'] ?? $record->Permission_No;
//                     $record->Permission_Date = $dataToTransfer['Permission_Date'] ?? $record->Permission_Date;
//                     $record->Renew_Date = $dataToTransfer['Renew_Date'] ?? $record->Renew_Date;
//                     $record->Accomodation = $dataToTransfer['Accomodation'] ?? $record->Accomodation;
//                     $record->DateOfBirth = $dataToTransfer['DateOfBirth'] ?? $record->DateOfBirth;
//                     $record->Revised = $dataToTransfer['Revised'] ?? $record->Revised;
//                     $record->IBAN = $dataToTransfer['IBAN'] ?? $record->IBAN;
//                     $record->IDExpiry = $dataToTransfer['IDExpiry'] ?? $record->IDExpiry;
//                     $record->HeadRemarks = $dataToTransfer['HeadRemarks'] ?? $record->HeadRemarks;
//                     $record->is_completed = $dataToTransfer['is_completed'] ?? $record->is_completed;
//                     $record->FileNo = $dataToTransfer['FileNo'] ?? $record->FileNo;
                    
//                     dump($record->toArray());
//                     //                        exit("✅ Saved and now debugging");
//                     if ($record->save()) {
//                         dump($record);
//                         exit("✅ Saved and now debugging");
//                     } else {
//                         dd("❌ Failed to save");
//                     }
//                     //$record->save();
//                     //dd($record->toArray());
//                     }*/




//                     // $record = PrimaryData::where('IDNo', $dataToTransfer['IDNo'])->first();
//                     // PrimaryData::where('IDNo', $dataToTransfer['IDNo'])->update($dataToTransfer);
//                     // $record->fill($dataToTransfer);
//                     // if ($record->save()) {
//                     //     dump($record->toArray());
//                     //     exit("✅ Saved with fill() and now debugging");
//                     // } else {
//                     //     dd("❌ Failed to save with fill()");
//                     // }










//                     $existingRecord = PrimaryData::where('IDNo', $dataToTransfer['IDNo'])->first();

//                     if ($existingRecord) {
//                         // Convert model to array
//                         $existingData = $existingRecord->toArray();

//                         // Normalize dates in both arrays to 'Y-m-d' to make comparison fair
//                         $dateFields = ['CaseDate', 'Renew_Date', 'Permission_Date', 'DateOfBirth', 'LastUpdate', 'IDExpiry'];
//                         foreach ($dateFields as $field) {
//                             if (isset($existingData[$field]) && $existingData[$field]) {
//                                 $existingData[$field] = \Carbon\Carbon::parse($existingData[$field])->format('Y-m-d');
//                             }
//                             if (isset($dataToTransfer[$field]) && $dataToTransfer[$field] instanceof \Carbon\Carbon) {
//                                 $dataToTransfer[$field] = $dataToTransfer[$field]->format('Y-m-d');
//                             }
//                         }

//                         // Show differences: what's different between input and existing DB
//                         $diffFromInput = array_diff_assoc($dataToTransfer, $existingData);
//                         $diffFromDB = array_diff_assoc($existingData, $dataToTransfer);

//                         dump([
//                             '✅ Data from form (dataToTransfer)' => $dataToTransfer,
//                             '✅ Data from DB (existingRecord)' => $existingData,
//                             '🟠 Different fields (input != db)' => $diffFromInput,
//                             '🟠 Different fields (db != input)' => $diffFromDB,
//                         ]);

//                         exit('🕵️ Comparison finished.');
//                     } else {
//                         dd("❌ No existing record found to compare.");
//                     }

                
//                 //dd($record);
//                 /*if ($record) {
//                     foreach ($dataToTransfer as $key => $value) {
//                         $record->$key = $value;
//                     }

//                     $record->save();
//                 }*/
//                 //dd($dataToTransfer);
//                 //dd($dataToTransfer);
//             } else {
//                 // ✅ إدراج جديد باستخدام Eloquent للحصول على ID
//                 $record = new PrimaryData($dataToTransfer);
//                 //dd($record."added");
//                 //$record->save();
//                 if ($record->save()) {
//                     dump($record);
//                     exit("✅ Saved and now debugging");
//                 } else {
//                     dd("❌ Failed to save");
//                 }
//                 // ✅ حساب FileNo على أساس ID
                
//                 $record->FileNo = $record->ID + 2;
//                 $record->save();
//             }

//             // حذف من جدول الإدخالات المؤقتة بعد النقل
//             //DB::table('primary_datas_submissions')->where('id', $id)->delete();

//             AuditHelper::logAudit('moved', 'primary_datas_submissions', $oldValues, $dataToTransfer);
//             DB::commit();
//             Flash::success("✅ تم نقل البيانات بنجاح.");
//         } catch (\Exception $e) {
//             DB::rollBack();
//             Log::error('❌ فشل النقل: ' . $e->getMessage());
//             Flash::error("حدث خطأ أثناء نقل البيانات.");
//         }
//     } else {
//         // ✅ تحديث فقط داخل جدول الإدخالات المؤقتة
//         DB::table('primary_datas_submissions')->where('id', $id)->update($input);
//         AuditHelper::logAudit('updated', 'primary_datas_submissions', $oldValues, $input);
//         Flash::success("تم التحديث بنجاح.");
//     }

//     return redirect()->route("{$this->routeName}.index");
// }

public function update($id, Request $request)
{
    $routeName = $request->route()->getName(); // 🔍 Check current route name
    //dd($routeName);
    if ($routeName === 'primaryDatas.update') {
        return $this->updatePrimaryDatas($id, $request);
    } elseif ($routeName === 'primaryDatasSubmissions.update') {
        //dd(2);
        return $this->updatePrimaryDatasSubmissions($id, $request);
    }

    abort(404); // If route name is unknown
}





public function updatePrimaryDatas($id, Request $request)
    {
        $record = PrimaryData::find($id);

        if (!$record) {
            Flash::error("السجل غير موجود.");
            return redirect()->route("primaryDatas.index");
        }

        $input = $request->except(['_token', '_method']);
        //dd($input);
        $input['UserEdit'] = auth()->id();
        $input['LastUpdate'] = now();
        $input['Accomodation'] = $request->has('Accomodation') ? 1 : 0;///////////check it print on
        if (
            isset($input['request_status_user_id']) &&
            $input['request_status_user_id'] === 'completed' &&
            $record->is_completed === 1 // or true, depending on how your DB stores it
        ) {
            $input['request_status_user_id'] = null;
        }
        //$input['Revised'] = $request->has('Revised') ? 1 : 0;
        //$input['Cancel'] = $request->has('Cancel') ? 1 : 0;

        // Format date fields
        $dateFields = ['CaseDate', 'Renew_Date', 'Permission_Date', 'DateOfBirth', 'LastUpdate', 'IDExpiry'];
        foreach ($dateFields as $field) {
            if (!empty($input[$field]) && $input[$field] instanceof \Carbon\Carbon) {
                $input[$field] = $input[$field]->format('Y-m-d');
            }
        }

        $oldValues = $record->toArray();
        $record->fill($input);

        if ($record->save()) {
            if (
                isset($input['request_status_user_id']) &&
                $input['request_status_user_id'] === 'completed' &&
                $record->is_completed === 1
            ) 
            {
                $latestSupport = $record->supports()->latest()->first();
                if ($latestSupport) {
                    $latestSupport->is_completed = true;
                    $latestSupport->save();
                }
            }
            


            AuditHelper::logAudit('updated', 'primary_datas', $oldValues, $input);
            Flash::success("✅ تم تعديل السجل بنجاح.");
            return redirect()->route("primaryDatas.index");
        } else {
            return back()->withErrors("❌ فشل التحديث.");
        }
    }


public function updatePrimaryDatasSubmissions($id, Request $request)
{
    $item = DB::table('primary_datas_submissions')->where('id', $id)->first();

    if (!$item) {
        Flash::error('Record not found');
        return redirect()->route("{$this->routeName}.index");
    }

    $input = $request->except(['_token', '_method']);
    $input['UserEdit'] = auth()->id();
    $input['LastUpdate'] = now();
    $input['is_completed'] = $request->has('is_completed') ? 1 : 0;

    if (isset($input['request_status_user_id']) && $input['request_status_user_id'] === 'completed') {
        $input['request_status_user_id'] = null;
    }
    
    $oldValues = (array) $item;
    
    if ($input['is_completed'] && ($input['request_transfer_to_admin'] ?? 0) == 1) {
        DB::beginTransaction();
        
        try {
            $dataToTransfer = array_merge((array) $item, $input);
            //$IDTEMP=$input["ID"];
            unset($dataToTransfer['id'], $dataToTransfer['created_at'], $dataToTransfer['updated_at']);
            
            // Normalize date fields
            $dateFields = ['CaseDate', 'Renew_Date', 'Permission_Date', 'DateOfBirth', 'LastUpdate', 'IDExpiry'];
            foreach ($dateFields as $field) {
                if (!empty($dataToTransfer[$field]) && $dataToTransfer[$field] instanceof \Carbon\Carbon) {
                    $dataToTransfer[$field] = $dataToTransfer[$field]->format('Y-m-d');
                }
            }
            
            $existing = PrimaryData::where('IDNo', $dataToTransfer['IDNo'])->first();
            if ($existing) {
                // ✅ UPDATE
                $existing->fill($dataToTransfer);
                
                if ($existing->save()) {
                    
                    DB::table('attachments')->where('CaseID', $existing->ID)->delete();
                    
                    $attachmentsSub = DB::table('attachments_submissions')->where('CaseID', $id)->get();
                    
                    foreach ($attachmentsSub as $att) {
                        DB::table('attachments')->insert([
                            'CaseID' => $existing->ID,
                            'AttID' => $att->AttID,
                            'AttPath' => $att->AttPath,
                            'Remarks' => $att->Remarks,
                            'uae_id'=>$dataToTransfer['IDNo'],
                        ]);
                        
                        AuditHelper::logAudit('inserted', 'attachments', [], [
                            'CaseID' => $existing->ID,
                            'AttID' => $att->AttID,
                            'AttPath' => $att->AttPath,
                            'Remarks' => $att->Remarks,
                            'uae_id'=>$dataToTransfer['IDNo'],
                        ]);
                    }



                    $support = DB::table('supports_submissions')->where('CaseID', $id)->get();

                    // تحويل إلى array مع إزالة الحقل ID
                    $supportArray = $support->map(function ($row) use ($existing) {
                        $data = (array) $row;
                        unset($data['ID']);
                        $data['CaseID'] = $existing->ID; // ✅ عوضنا ID القديم بالجديد
                        $data['uae_id']=$dataToTransfer['IDNo'];
                        return $data;
                    })->toArray();


                    DB::table('supports')->insert($supportArray);



                    //$support = DB::table('supports_submissions')->where('CaseID', $item->id)->get();
                    //DB::table('supports')->insert($support);

                    AuditHelper::logAudit('inserted', 'supports', [], $support);
                    

                    DB::table('primary_datas_submissions')->where('id', $id)->delete();
                    DB::table('attachments_submissions')->where('CaseID', $id)->delete();
                    DB::table('supports_submissions')->where('CaseID', $id)->delete();
                    
                    AuditHelper::logAudit('updated', 'primary_datas', $oldValues, $dataToTransfer);
                    DB::commit();
                    Flash::success("✅ تم تحديث البيانات بنجاح.");
                    return redirect()->route("{$this->routeName}.index");
                } else {
                    DB::rollBack();
                    return back()->withErrors("❌ فشل التحديث.");
                }
            } else {
                // ✅ INSERT
                $record = new PrimaryData($dataToTransfer);
                if ($record->save()) {
                    // Auto-generate FileNo based on ID
                    //$record->FileNo = $record->ID + 2;
                    $record->save();
                    
                    //DB::table('attachments')->where('CaseID', $record->ID)->delete(); // Just in case
                    $attachmentsSub = DB::table('attachments_submissions')->where('CaseID', $id)->get();
                    
                    foreach ($attachmentsSub as $att) {
                        DB::table('attachments')->insert([
                            'CaseID' => $record->ID,
                            'AttID' => $att->AttID,
                            'AttPath' => $att->AttPath,
                            'Remarks' => $att->Remarks,
                            'uae_id'=>$dataToTransfer['IDNo'],
                        ]);

                        AuditHelper::logAudit('inserted', 'attachments', [], [
                            'CaseID' => $record->ID,
                            'AttID' => $att->AttID,
                            'AttPath' => $att->AttPath,
                            'Remarks' => $att->Remarks,
                            'uae_id'=>$dataToTransfer['IDNo'],
                        ]);
                    }
                    
                    $support = DB::table('supports_submissions')->where('CaseID', $id)->get();

                    // تحويل إلى array مع إزالة الحقل ID
                    $supportArray = $support->map(function ($row) use ($record) {
                        $data = (array) $row;
                        unset($data['ID']);
                        $data['CaseID'] = $record->ID; 
                        $data['uae_id']=$dataToTransfer['IDNo'];
                        
                        return $data;
                    })->toArray();

                    DB::table('supports')->insert($supportArray);


                    //$support = DB::table('supports_submissions')->where('CaseID', $id)->get();
                    //DB::table('supports')->insert($support);
                    AuditHelper::logAudit('inserted', 'supports', [], $support->map(fn ($row) => (array) $row)->toArray());
                    
                    
                    DB::table('primary_datas_submissions')->where('id', $id)->delete();
                    //DB::table('primary_datas_submissions')->where('id', $id)->delete();
                    DB::table('attachments_submissions')->where('CaseID', $id)->delete();
                    DB::table('supports_submissions')->where('CaseID', $id)->delete();
                    
                    AuditHelper::logAudit('inserted', 'primary_datas', [], $dataToTransfer);
                    //dd($input);
                    DB::commit();
                    Flash::success("✅ تم إدخال البيانات بنجاح.");
                    return redirect()->route("{$this->routeName}.index");
                } else {
                    DB::rollBack();
                    return back()->withErrors("❌ فشل الإدخال.");
                }
            }

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            \Log::error('❌ فشل العملية: ' . $e->getMessage());
            Flash::error("حدث خطأ أثناء نقل البيانات.");
            return back();
        }
    } else {


            DB::table('primary_datas_submissions')->where('id', $id)->update($input);

            // ✅ Update supports_submissions with selected fields from input
            $fieldsToUpdate = [
                'request_status',
                'request_reply',
                'request_custom_reply',
                //'archieved',
                //'deleted',
            ];

            $updateSupport = [];
            foreach ($fieldsToUpdate as $field) {
                if (isset($input[$field])) {
                    $updateSupport[$field] = $input[$field];
                }
            }

            if (!empty($updateSupport)) {
                DB::table('supports_submissions')->where('CaseID', $id)->update($updateSupport);
                AuditHelper::logAudit('updated', 'supports_submissions', [], $updateSupport);
            }

            AuditHelper::logAudit('updated', 'primary_datas_submissions', $oldValues, $input);
            Flash::success("تم التحديث بنجاح.");
            return redirect()->route("{$this->routeName}.index");

        // ✅ تحديث فقط في جدول الإدخالات المؤقتة
        //DB::table('primary_datas_submissions')->where('id', $id)->update($input);
        //AuditHelper::logAudit('updated', 'primary_datas_submissions', $oldValues, $input);
        //Flash::success("تم التحديث بنجاح.");
        //return redirect()->route("{$this->routeName}.index");
    }
}






// public function update($id, Request $request)
// {
//     $item = DB::table('primary_datas_submissions')->where('id', $id)->first();

//     if (!$item) {
//         Flash::error('Record not found');
//         return redirect()->route("{$this->routeName}.index");
//     }

//     $input = $request->except(['_token', '_method']);
//     $input['UserEdit'] = auth()->id();
//     $input['LastUpdate'] = now();
//     $input['is_completed'] = $request->has('is_completed') ? 1 : 0;

//     if (isset($input['request_status_user_id']) && $input['request_status_user_id'] === 'completed') {
//         $input['request_status_user_id'] = null;
//     }

//     $oldValues = (array) $item;

//     if ($input['is_completed']) {
//         DB::beginTransaction();

//         try {
//             $dataToTransfer = array_merge((array) $item, $input);
//             unset($dataToTransfer['id'], $dataToTransfer['created_at'], $dataToTransfer['updated_at']);

//             // تنسيق التاريخ
//             $dateFields = ['CaseDate', 'Renew_Date', 'Permission_Date', 'DateOfBirth', 'LastUpdate', 'IDExpiry'];
//             foreach ($dateFields as $field) {
//                 if (!empty($dataToTransfer[$field]) && $dataToTransfer[$field] instanceof \Carbon\Carbon) {
//                     $dataToTransfer[$field] = $dataToTransfer[$field]->format('Y-m-d');
//                 }
//             }

//             // تحقق من وجود السجل
//             $existing = DB::select("SELECT * FROM primary_datas WHERE IDNo = ?", [$dataToTransfer['IDNo']]);

//             if ($existing) {
//                 // ✅ تعديل مباشر باستخدام SQL
//                 $updateSql = "UPDATE primary_datas SET ";
//                 $updateParts = [];
//                 $bindings = [];

//                 foreach ($dataToTransfer as $column => $value) {
//                     $updateParts[] = "`$column` = ?";
//                     $bindings[] = $value;
//                 }

//                 $updateSql .= implode(', ', $updateParts) . " WHERE IDNo = ?";
//                 $bindings[] = $dataToTransfer['IDNo'];
                
//                 \Illuminate\Support\Facades\DB::table('primary_datas')->update($dataToTransfer);
//                 dd($dataToTransfer);
//             } else {
//                 // ✅ إدخال مباشر باستخدام SQL
//                 $columns = array_keys($dataToTransfer);
//                 $placeholders = array_fill(0, count($columns), '?');
//                 $values = array_values($dataToTransfer);

//                 $insertSql = "INSERT INTO primary_datas (" . implode(', ', $columns) . ")
//                               VALUES (" . implode(', ', $placeholders) . ")";

//                 DB::insert($insertSql, $values);
//             }

//             AuditHelper::logAudit('moved', 'primary_datas_submissions', $oldValues, $dataToTransfer);
//             DB::commit();
//             Flash::success("✅ تم نقل البيانات بنجاح.");
//         } catch (\Exception $e) {
//             DB::rollBack();
//             Log::error('❌ فشل النقل: ' . $e->getMessage());
//             Flash::error("حدث خطأ أثناء نقل البيانات.");
//         }
//     } else {
//         // تحديث مؤقت باستخدام SQL
//         $updateParts = [];
//         $bindings = [];

//         foreach ($input as $column => $value) {
//             $updateParts[] = "`$column` = ?";
//             $bindings[] = $value;
//         }

//         $bindings[] = $id;
//         $updateSql = "UPDATE primary_datas_submissions SET " . implode(', ', $updateParts) . " WHERE id = ?";
//         DB::update($updateSql, $bindings);

//         AuditHelper::logAudit('updated', 'primary_datas_submissions', $oldValues, $input);
//         Flash::success("تم التحديث بنجاح.");
//     }

//     return redirect()->route("{$this->routeName}.index");
// }











    // $dataToTransfer = [
    //     'Section' => 1,
    //     'Nam' => 'اختبار',
    //     'NamEn' => 'Test Name',
    //     'Sex' => 1,
    //     'Nationality' => 1,
    //     'Career' => 1,
    //     'CareerAddress' => 'عنوان تجريبي',
    //     'FamilyCount' => 3,
    //     'InSchool' => 0,
    //     'IDNo' => '99999999999999711',
    //     'MaritalStatus' => 1,
    //     'WifeName' => 'زوجة تجريبية',
    //     'WifeAddress' => 'داخل الدولة',
    //     'WifeCareer' => 1,
    //     'WifeNationality' => 1,
    //     'HouseType' => 1,
    //     'mob' => '0500000000',
    //     'Region' => 1,
    //     'CaseDate' => now(),
    //     'Approved' => 1,
    //     'UserAdd' => 1,
    //     'UserEdit' => 1,
    //     'LastUpdate' => now(),
    //     'Cancel' => 0,
    //     'Permission_No' => 123456,
    //     'Permission_Date' => now(),
    //     'Renew_Date' => now(),
    //     'Accomodation' => 1,
    //     'DateOfBirth' => '1990-01-01',
    //     'Revised' => 1,
    //     'is_completed' => 0,
    // ];



    /*public function destroy($id)
    {
        $item = $this->repository->find($id);
        if (empty($item)) {
            Flash::error('Record not found');
            return redirect()->route("{$this->routeName}.index");
        }

        AuditHelper::logAudit('deleted', $item, $item, []);
        $this->repository->delete($id);
        Flash::success("Data deleted successfully.");

        return redirect()->route("{$this->routeName}.index");
    }*/

    /*public function show($id)
    {
        $item = $this->repository->find($id);
        if (empty($item)) {
            Flash::error('Record not found');
            return redirect()->route("{$this->routeName}.index");
        }

        // Optionally, load relations if needed
        $relations = method_exists($item, 'load') ? $item->load([
            'supports.supporttype', 'supports.supportrequiredarch',
            'attachments.attid',
        ]) : $item;

        $attTypes = \App\Models\AttachmentType::all();

        return view("{$this->viewFolder}.show", [
            'primaryData' => $item,
            'attTypes' => $attTypes,
        ]);
    }*/


    public function destroy($id)
    {
        $routeName = \Route::currentRouteName();

        if ($routeName === 'primaryDatasSubmissions.destroy') {
            $item = DB::table('primary_datas_submissions')->where('id', $id)->first();
            if (!$item) {
                Flash::error('Record not found');
            } else {
                AuditHelper::logAudit('deleted', 'primary_datas_submissions', (array)$item, []);
                DB::table('primary_datas_submissions')->where('id', $id)->delete();
                Flash::success("تم حذف السجل بنجاح.");
            }

            return redirect()->route("{$this->routeName}.index");
        }

        $item = $this->repository->find($id);
        if (empty($item)) {
            Flash::error('Record not found');
            return redirect()->route("{$this->routeName}.index");
        }

        AuditHelper::logAudit('deleted', $item, $item->toArray(), []);
        $this->repository->delete($id);
        Flash::success("Data deleted successfully.");

        return redirect()->route("{$this->routeName}.index");
    }

    public function show($id)
    {
        $routeName = \Route::currentRouteName();

        // if ($routeName === 'primaryDatasSubmissions.show') {
        //     $item = DB::table('primary_datas_submissions')->where('id', $id)->first();
        //     if (!$item) {
        //         Flash::error('Record not found');
        //         return redirect()->route("{$this->routeName}.index");
        //     }
        //     $item->supports = collect();
        //     $item->attachments = collect();
        //     $attTypes = \App\Models\AttachmentType::all();
        //     $attachments = DB::table('attachments_submissions')->where('CaseID', $id)->get();

        //     return view("{$this->viewFolder}.show", [
        //         'primaryData' => (object)$item,
        //         'attTypes' => $attTypes,
        //         'attachments' => $attachments,
        //     ]);
        // }
        if ($routeName === 'primaryDatasSubmissions.show') {
            $item = DB::table('primary_datas_submissions')->where('id', $id)->first();
            if (!$item) {
                Flash::error('Record not found');
                return redirect()->route("{$this->routeName}.index");
            }

            $supports = \App\Models\SupportSubmission::with(['supportrequiredarch', 'supporttype'])
                        ->where('CaseID', $id)
                        ->get();

            $attachments = \App\Models\AttachmentSubmission::with(['attid', 'caseid'])
                        ->where('CaseID', $id)
                        ->get();
            
            //DB::table('attachments_submissions')->where('CaseID', $id)->get();

            $item->supports = $supports;
            $item->attachments = $attachments;

            $attTypes = \App\Models\AttachmentType::all();

            return view("{$this->viewFolder}.show", [
                'primaryData' => (object)$item,
                //'attTypes' => $attTypes,
                'attachments' => $attachments,
            ]);
        }



        /*$item = $this->repository->find($id);
        if (empty($item)) {
            Flash::error('Record not found');
            return redirect()->route("{$this->routeName}.index");
        }

        $relations = method_exists($item, 'load') ? $item->load([
            //'supports.caseid',
            'supports.supporttype', 'supports.supportrequiredarch',
            'attachments.attid',
        ]) : $item;
        dd($item);
        $attTypes = \App\Models\AttachmentType::all();

        return view("{$this->viewFolder}.show", [
            'primaryData' => $item,
            'attTypes' => $attTypes,
        ]);*/

        $item = $this->repository->find($id);
        if (empty($item)) {
            Flash::error('Record not found');
            return redirect()->route("{$this->routeName}.index");
        }

            $supports = \App\Models\Support::with(['supportrequiredarch', 'supporttype'])
                        ->where('CaseID', $id)
                        ->get();

            $attachments = \App\Models\Attachment::with(['attid', 'caseid'])
                        ->where('CaseID', $id)
                        ->get();
            
            //DB::table('attachments_submissions')->where('CaseID', $id)->get();

            $item->supports = $supports;
            $item->attachments = $attachments;

            $attTypes = \App\Models\AttachmentType::all();

            return view("{$this->viewFolder}.show", [
                'primaryData' => (object)$item,
                //'attTypes' => $attTypes,
                'attachments' => $attachments,
            ]);
    }



    protected function sharedFormData()
    {
        return [
            'nationalities' => \App\Models\Nationalit::pluck('nationality', 'id'),
            'careers' => \App\Models\Career::pluck('career', 'id'),
            'maritalStatuses' => \App\Models\MaritalStatus::pluck('MaritalStatus', 'id'),
            'users' => \App\Models\User::pluck('name', 'id'),
            'houseTypes' => \App\Models\HouseType::pluck('HouseType', 'id'),
            'sexes' => \App\Models\Sex::pluck('sex', 'id'),
            'regions' => \App\Models\Region::pluck('region', 'id'),
        ];
    }
}
