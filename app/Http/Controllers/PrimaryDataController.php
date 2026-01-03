<?php

namespace App\Http\Controllers;

class PrimaryDataController extends AbstractPrimaryDataController
{
    public function __construct(\App\Repositories\PrimaryDataRepository $repo)
    {
        $this->modelClass = \App\Models\PrimaryData::class;
        $this->repository = $repo;
        $this->viewFolder = 'primary_datas';
        $this->routeName = 'primaryDatas';
    }



    
}















// namespace App\Http\Controllers;

// use App\Http\Requests\CreatePrimaryDataRequest;
// use App\Http\Requests\UpdatePrimaryDataRequest;
// use App\Http\Controllers\AppBaseController;
// use App\Repositories\PrimaryDataRepository;
// use Illuminate\Http\Request;
// use Illuminate\Support\Str;
// use App\Models\PrimaryData;
// use Illuminate\Support\Facades\Schema;
// use App\Models\Nationalit;
// use App\Models\Career;
// use App\Models\MaritalStatus;
// use App\Models\HouseType;
// use App\Models\User;
// use Carbon\Carbon;

// use Flash;
// use App\Helpers\AuditHelper;

// class PrimaryDataController extends AppBaseController
// {
//     /** @var PrimaryDataRepository $primaryDataRepository*/
//     private $primaryDataRepository;

//     public function __construct(PrimaryDataRepository $primaryDataRepo)
//     {
//         $this->primaryDataRepository = $primaryDataRepo;
//     }

  
//     public function index(Request $request)
//     {
//         $query = PrimaryData::query();

//         // Get all column names from the table
//         $columns = Schema::getColumnListing((new PrimaryData)->getTable());

//         // Loop through each column and apply conditional filters
//         foreach ($columns as $column) {
//             // Handle date range filtering
//             if ($column === 'Sex' && $request->filled('Sex')) {
//                 $query->where('Sex', $request->Sex); // filters by ID (1 or 2)
//             } 
//             if (Str::contains($column, ['_date', 'Date','LastUpdate','IDExpiry'])) {
//                 if ($request->filled("{$column}_from")) {
//                     $query->whereDate($column, '>=', $request->input("{$column}_from"));
//                 }
//                 if ($request->filled("{$column}_to")) {
//                     $query->whereDate($column, '<=', $request->input("{$column}_to"));
//                 }
//                 // Optional exact match if provided
//                 if ($request->filled($column)) {
//                     $query->whereDate($column, $request->$column);
//                 }
//             } elseif ($request->filled($column)) {
//                 // Determine if this is a boolean or exact match field
//                 if (Str::startsWith($column, ['is_', 'has_', 'approved', 'active', 'status'])) {
//                     $query->where($column, $request->$column);
//                 } elseif (Str::contains($column, ['ID','FileNo','count', 'Count', 'number', 'Number'])) {
//                     $query->where($column, $request->$column);
//                 } else {
//                     $query->where($column, 'like', $request->$column . '%');
//                 }
//             }
//         }

//         //$primaryDatas = $query->orderBy('CaseDate', 'desc')->paginate(10);
//         $primaryDatas = $query
//             ->with(['Nationality','Region', 'Career', 'MaritalStatus', 'WifeCareer', 'WifeNationality', 'HouseType', 'userAdd', 'userEdit'])
//             ->orderBy('ID', 'desc')
//             ->paginate(10);
//         //\Log::info($primaryDatas->pluck('userEdit'));
//         $nationalities = Nationalit::pluck('nationality','id');
//         $careers = Career::pluck('career','id');
//         $maritalStatuses = MaritalStatus::pluck('MaritalStatus','id');
//         $users = User::pluck('name','id');
//         $houseTypes = HouseType::pluck('HouseType','id');

//         return view('primary_datas.index', compact(
//             'primaryDatas','nationalities', 'careers', 'maritalStatuses','columns','users','houseTypes'
//         ));

//         //return view('primary_datas.index', compact('primaryDatas', 'columns'));
        
//         //$primaryDatas = $query->paginate(10);

//         //return view('primary_datas.index', compact('primaryDatas', 'columns'));
    
//         //$primaryDatas = $this->primaryDataRepository->paginate(10);

//         //return view('primary_datas.index')->with('primaryDatas', $primaryDatas);
//     }


//     public function create()
//     {
//         $nationalities = Nationalit::pluck('nationality','id');
//         $careers = Career::pluck('career','id');
//         $maritalStatuses = MaritalStatus::pluck('MaritalStatus','id');
//         $users = User::pluck('name','id');
//         $houseTypes = HouseType::pluck('HouseType','id');
//         $sexes = \App\Models\Sex::pluck('sex', 'id');
//         $regions = \App\Models\Region::pluck('region', 'id');

//         return view('primary_datas.create', compact(
//             'nationalities', 'careers', 'maritalStatuses','users','houseTypes','sexes','regions'
//         ));
//         //$nationalities = Nationality::pluck('name', 'id');
//         //$regions = Region::pluck('name', 'id');
//         //return view('cases.create', compact('nationalities', 'regions'));
//         //return view('primary_datas.create');
//     }


//     public function store(CreatePrimaryDataRequest $request)
//     {
        
//         $now = Carbon::now();
//         $input = $request->all();
//         if (PrimaryData::where('IDNo', $input['IDNo'])->exists()) {
//             return back()->withErrors(['IDNo' => 'This IDNo already exists.'])->withInput();
//         }
//         $input['UserAdd'] = auth()->id();
//         $input['UserEdit'] = auth()->id();
//         $input['CaseDate'] = $now;
//         $input['LastUpdate'] = $now;
//         $input['FileNo'] = mt_rand(10000000, 99999999);
//         $primaryData = $this->primaryDataRepository->create($input);
//         $primaryData->FileNo = $primaryData->ID+2;
//         $primaryData->save();
//         //\Log::info($request->all());
//         //dd($request->all());


//         AuditHelper::logAudit('created', $primaryData, [], $primaryData->getAttributes());
//         Flash::success('Primary Data saved successfully.');

//         return redirect()->route('primaryDatas.index')->with('success', 'Primary data created successfully!');

//         //return redirect(route('primaryDatas.index'));
//     }


//     public function show($id)
//     {
//         $primaryData = PrimaryData::with(['supports.supporttype','supports.supportrequiredarch', 'attachments.attid'])->findOrFail($id);//$primaryData = $this->primaryDataRepository->find($id);

//         $attTypes = \App\Models\AttachmentType::all(); 

    
//         if (empty($primaryData)) {
//             Flash::error('Primary Data not found');

//             return redirect(route('primaryDatas.index'));
//         }
//         //\Log::info('primary data request data:', $primaryData->toArray());
//         return view('primary_datas.show', compact('primaryData', 'attTypes'));//return view('primary_datas.show')->with('primaryData', $primaryData);
//     }


//     public function edit($id)
//     {
//         $primaryData = $this->primaryDataRepository->find($id);

//         if (empty($primaryData)) {
//             Flash::error('Primary Data not found');
//             return redirect(route('primaryDatas.index'));
//         }

//         // Fetch related models for dropdown fields
//         $careers = \App\Models\Career::pluck('career', 'id');
//         $nationalities = \App\Models\Nationalit::pluck('nationality', 'id');
//         $maritalStatuses = \App\Models\MaritalStatus::pluck('maritalStatus', 'id');
//         $sexes = \App\Models\Sex::pluck('sex', 'id');
//         $regions = \App\Models\Region::pluck('region', 'id');
//         $houseTypes = \App\Models\HouseType::pluck('houseType', 'id');
//         $users = \App\Models\User::pluck('name', 'id');

//         return view('primary_datas.edit')->with([
//             'primaryData' => $primaryData,
//             'careers' => $careers,
//             'nationalities' => $nationalities,
//             'maritalStatuses' => $maritalStatuses,
//             'sexes' => $sexes,
//             'regions' => $regions,
//             'houseTypes' => $houseTypes,
//             'users' => $users,
//         ]);
//     }


  
//     public function update($id, UpdatePrimaryDataRequest $request)
//     {
//         //\Log::info('Raw request data:', $request->all());
        
//         $primaryData = $this->primaryDataRepository->find($id);

//         if (empty($primaryData)) {
//             Flash::error('Primary Data not found');

//             return redirect(route('primaryDatas.index'));
//         }
//         $now = Carbon::now();
//         //$input = $request->all();
//         $input = $request->except(['_method', '_token']);
//         $input['UserEdit'] = auth()->id();
//         $input['LastUpdate'] = $now;
//         //\Log::info('Raw request data from controller:', $input);
        


//         $oldValues = $primaryData->getAttributes();
//         $updatedPrimaryData = $this->primaryDataRepository->update($input, $id);
//         if (!$updatedPrimaryData) {
//             return response()->json(['error' => 'Record not found or not updated'], 404);
//         }
//         $newValues = $updatedPrimaryData->getAttributes();
//         AuditHelper::logAudit('updated', $primaryData, $oldValues, $newValues);


//         if (!$primaryData) {
//             return response()->json(['error' => 'Record not found or not updated'], 404);
//         }
//         Flash::success('Primary Data updated successfully.');

//         return redirect()->route('primaryDatas.index')->with('success', 'Primary data updated successfully!');//return redirect(route('primaryDatas.index'));
//     }


//     public function destroy($id)
//     {
//         $primaryData = $this->primaryDataRepository->find($id);

//         if (empty($primaryData)) {
//             Flash::error('Primary Data not found');

//             return redirect(route('primaryDatas.index'));
//         }

//         AuditHelper::logAudit('deleted', $primaryData, $primaryData, []);
//         $this->primaryDataRepository->delete($id);

//         Flash::success('Primary Data deleted successfully.');
//         //\Log::info('thi is the destory function so sell tell first' . $id);

//         return redirect()->route('primaryDatas.index')->with('success', 'Primary data deleted successfully!');
//         //return redirect(route('primaryDatas.index'));
//     }
// }
