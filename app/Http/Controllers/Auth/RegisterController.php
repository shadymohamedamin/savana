<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Sex;
use App\Models\Nationalit;
use App\Models\MaritalStatus;
use App\Models\Career;
use App\Models\Region;
use App\Models\HouseType;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    public function showRegistrationForm($id=null)
    {
        //$user = $id ? User::with('primaryData')->findOrFail($id) : null;
        $sexes = Sex::pluck('Sex', 'ID');
        $nationalities = Nationalit::pluck('Nationality', 'ID');
        $maritalStatuses = MaritalStatus::pluck('MaritalStatus', 'ID');
        $careers = Career::pluck('Career', 'ID');
        $regions = Region::pluck('Region', 'ID');
        $houseTypes = HouseType::pluck('HouseType', 'ID');
        $supportTypes = \App\Models\SupportType::pluck('SupportType', 'ID');
        $attTypes = \App\Models\AttachmentType::pluck('AttType', 'ID');

        return view('auth.register', compact(
            //'user',
            'sexes',
            'nationalities',
            'maritalStatuses',
            'careers',
            'regions',
            'houseTypes',
            'supportTypes',
            'attTypes'
        ));
    }


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*protected function validator(array $data)
    {
        //dd("1");
        dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'uae_id' => ['required', 'string', 'min:14'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:255', 'in:admin'],
        ]);
    }*/
//['label' => 'support_ammount_user', 'name' => 'support_ammount_user','type' => 'number'],
//                    //['label' => 'support_ammount_user', 'name' => 'support_ammount_user'],
//                    ['label' => 'case_description_user'
        // Income / Expense fields
        /*'SalaryArch' => ['nullable', 'numeric'],
        'IncomeArch' => ['nullable', 'numeric'],
        'WifeSalaryArch' => ['nullable', 'numeric'],
        'OfflineSalaryArch' => ['nullable', 'numeric'],
        'SocialSalaryArch' => ['nullable', 'numeric'],
        'OtherSalaryArch' => ['nullable', 'numeric'],
        'ChildrenInArch' => ['nullable', 'numeric'],
        'LoanArch' => ['nullable', 'numeric'],
        'RentArch' => ['nullable', 'numeric'],
        'DriverArch' => ['nullable', 'numeric'],
        'FeesArch' => ['nullable', 'numeric'],
        'ServantArch' => ['nullable', 'numeric'],
        'EleWaterArch' => ['nullable', 'numeric'],
        'HouseArch' => ['nullable', 'numeric'],
        'BankArch' => ['nullable', 'numeric'],
        'FurnatureArch' => ['nullable', 'numeric'],
        'CarArch' => ['nullable', 'numeric'],
        'CourtArch' => ['nullable', 'numeric'],
        'ChildrenOutArch' => ['nullable', 'numeric'],*/

        //'role' => ['required', 'string', 'max:255', Rule::in(['admin'])],

protected function validator(array $data)
{
    return Validator::make($data, [
        'Nam' => ['required', 'string', 'max:255'],
        'NamEn' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'uae_id' => ['required', 'string', 'min:14'],
        'mobile' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'sex' => ['required', 'exists:sexes,ID'],
        'Section' => ['required', 'integer'],
        'Trustee' => ['nullable', 'string', 'max:255'],
        'TrusteeEn' => ['nullable', 'string', 'max:255'],
        'DateOfBirth' => ['required', 'date'],
        'Nationality' => ['required', 'exists:nationalits,ID'],
        'Career' => ['required', 'exists:careers,ID'],
        'CareerAddress' => ['required', 'string'],
        'FamilyCount' => ['required', 'integer'],
        'InSchool' => ['required', 'integer'],
        'MaritalStatus' => ['required', 'exists:marital_statuses,ID'],
        'WifeName' => ['nullable', 'string'],
        'WifeAddress' => ['nullable', 'string'],
        'WifeCareer' => ['nullable', 'exists:careers,ID'],
        'WifeNationality' => ['nullable', 'exists:nationalits,ID'],


        'Region' => ['required', 'exists:regions,ID'],
        'HouseType' => ['required', 'exists:house_types,ID'],


        'help_type' => ['required', 'string'],
        'support_ammount_user' => ['required', 'integer'],
        'case_description_user' => ['required', 'string'],

    ]);
}


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */




    protected function create(array $data)
    {
        //dd($data);
        return DB::transaction(function () use ($data) {
            // 1. إدخال مستخدم جديد
            $user = User::create([
                'name' => $data['Nam'],
                'role' => 'public_user',
                'RoleID'=>'6',
                'uae_id' => $data['uae_id'], 
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'password' => Hash::make($data['password']),

            ]);

            // 2. إدخال في جدول primary_datas_submissions
            $primaryData = [
                //'UserAdd' => $user->id,
                //'UserEdit' => $user->id,
                'IBAN'=>'0',
                'Permission_No'=>'0',
                'IDNo' => $data['uae_id'], 
                'mob' => $data['mobile'],
                'Email' => $data['email'],
                'CaseDate' => now(),
                'LastUpdate' => now(),
                'FileNo' => mt_rand(50000, 1000000000),
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
                'request_status' =>'تم الارسال'
            ];

            $caseId = DB::table('primary_datas_submissions')->insertGetId($primaryData);

            // 3. إدخال في جدول supports_submissions
            $supportData = [
                'CaseID' => $caseId,
                'help_type' => $data['help_type'],
                'support_ammount_user' => $data['support_ammount_user'],
                'case_description_user' => $data['case_description_user'],
                'uae_id'=>$data['uae_id'],
                'Application_Date' => now(),
                'Dat' => now(),
                'request_status' =>'تم الارسال'
                
            ];
            //dd($primaryData."-----".$supportData);
            DB::table('supports_submissions')->insert($supportData);

            // 4. إدخال مرفقات في جدول attachments_submissions (إن وجدت)
            if (!empty($data['attachments']) && is_array($data['attachments'])) {
            foreach ($data['attachments'] as $attachment) {
                $attId = $attachment['type'];
                $file = $attachment['file'];

                $extension = $file->getClientOriginalExtension();
                $prefix = DB::table('attachment_types')->where('ID', $attId)->value('Prefix') ?? 'ATT';
                $fileName = $prefix . '_' . $caseId . '_' . uniqid() . '.' . $extension;

                // Save file locally in /public/Files
                $file->move(public_path('Files'), $fileName);

                $path = '\\\\svr\\RAKcMainApp$\\Files\\' . $fileName;

                DB::table('attachments_submissions')->insert([
                    'CaseID' => $caseId,
                    'AttID' => $attId,
                    'AttPath' => $path,
                    'Remarks' => '',
                    'uae_id'=>$data['uae_id'],
                ]);
            }
            
        }


            return $user;
        });
    }





    /*'SupportRequiredArch' => $data['SupportRequiredArch'],
                'SupportType' => $data['SupportType'],
                'NeedAmount' => $data['SupportAmount'],
                'SupportAmount' => $data['SupportAmount'],
                'Note' => '',
                'SalaryArch' => $data['SalaryArch'] ?? 0,
                'IncomeArch' => $data['IncomeArch'] ?? 0,
                'WifeSalaryArch' => $data['WifeSalaryArch'] ?? 0,
                'OfflineSalaryArch' => $data['OfflineSalaryArch'] ?? 0,
                'SocialSalaryArch' => $data['SocialSalaryArch'] ?? 0,
                'OtherSalaryArch' => $data['OtherSalaryArch'] ?? 0,
                'ChildrenInArch' => $data['ChildrenInArch'] ?? 0,
                'LoanArch' => $data['LoanArch'] ?? 0,
                'RentArch' => $data['RentArch'] ?? 0,
                'DriverArch' => $data['DriverArch'] ?? 0,
                'FeesArch' => $data['FeesArch'] ?? 0,
                'ServantArch' => $data['ServantArch'] ?? 0,
                'EleWaterArch' => $data['EleWaterArch'] ?? 0,
                'HouseArch' => $data['HouseArch'] ?? 0,
                'BankArch' => $data['BankArch'] ?? 0,
                'FurnatureArch' => $data['FurnatureArch'] ?? 0,
                'CarArch' => $data['CarArch'] ?? 0,
                'CourtArch' => $data['CourtArch'] ?? 0,
                'ChildrenOutArch' => $data['ChildrenOutArch'] ?? 0,
                'SearcherArch' => $user->id,
                'CaseDescription' => $data['CaseDescription'],
                'Application_Date' => now(),
                'Dat' => now(),
                'AppRemarks' => '',*/
    /*protected function create(array $data)
    {
        //dd("2");
        dd($data);
        return User::create([
            'name' => $data['Nam'],
            'role' => 'public_user',
            'uae_id' => $data['uae_id'], 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);




        $files = request()->file('AttFile'); // متعددة
        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $prefix = DB::table('attachment_types')->where('ID', $attId)->value('Prefix');
            $fileName = $prefix . '_' . $caseId . '.' . $extension;
            $file->move(public_path('Files'), $fileName);
            $path = '\\\\svr\\RAKcMainApp$\\Files\\' . $fileName;

            DB::table('attachments_submissions')->insert([
                'CaseID' => $caseId,
                'AttID' => $attId,
                'AttPath' => $path,
                'Remarks' => '',
            ]);
        }
        //return User::create([
            //'name' => $data['name'],
            //'email' => $data['email'],
            //'password' => Hash::make($data['password']),
            
        //]);
    }*/
}




/*
[▼ // app/Http/Controllers/Auth/RegisterController.php:80
  "_token" => "zghnQ6xIdZYlQLtmPwNzxyaM6JE3yS4BBKJkQrQc"
  "Nam" => "test"
  "NamEn" => "test"
  "email" => "it@rakcharity.aee"
  "uae_id" => "11111111111111"
  "mobile" => "11111"
  "password" => "rak@1234"
  "password_confirmation" => "rak@1234"
  "sex" => "2"
  "Section" => "1"
  "Trustee" => "test"
  "TrusteeEn" => "test"
  "DateOfBirth" => "2025-07-10"
  "Nationality" => "47"
  "Career" => "32"
  "CareerAddress" => "test"
  "FamilyCount" => "22"
  "InSchool" => "22"
  "MaritalStatus" => "2"
  "WifeName" => "test"
  "WifeAddress" => "test"
  "WifeCareer" => "32"
  "WifeNationality" => "57"
  "Region" => "9"
  "HouseType" => "4"
  "SupportRequiredArch" => "test"
  "SupportAmount" => "333"
  "CaseDescription" => "test"
  "SalaryArch" => "23"
  "IncomeArch" => "324"
  "WifeSalaryArch" => "3234"
  "OfflineSalaryArch" => "32"
  "SocialSalaryArch" => "32"
  "OtherSalaryArch" => "323"
  "ChildrenInArch" => "23"
  "LoanArch" => "323"
  "RentArch" => "32"
  "DriverArch" => "23"
  "FeesArch" => "32"
  "ServantArch" => "32"
  "EleWaterArch" => "23"
  "HouseArch" => "32"
  "BankArch" => "23"
  "FurnatureArch" => "3"
  "CarArch" => "3"
  "CourtArch" => "3"
  "ChildrenOutArch" => "3"
  "attachments" => array:1 [▼
    0 => array:2 [▼
      "type" => "43"
      "file" => Illuminate\Http\UploadedFile {#1598 ▼
        -test: false
        -originalName: "card-website.png"
        -mimeType: "image/png"
        -error: 0
        #hashName: null
        path: "/tmp"
        filename: "phpwbWZ6C"
        basename: "phpwbWZ6C"
        pathname: "/tmp/phpwbWZ6C"
        extension: ""
        realPath: "/tmp/phpwbWZ6C"
        aTime: 2025-07-03 08:51:30
        mTime: 2025-07-03 08:51:30
        cTime: 2025-07-03 08:51:30
        inode: 12976168
        size: 13788
        perms: 0100600
        owner: 1000
        group: 1000
        type: "file"
        writable: true
        readable: true
        executable: false
        file: true
        dir: false
        link: false
      }
    ]
  ]
]


*/