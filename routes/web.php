<?php

use App\Http\Controllers\UserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\LogViewerController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\LicenseController;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Request;
use OwenIt\Auditing\Auditor;
use OwenIt\Auditing\Facades\Auditing;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\RegisterController;
// routes/web.php
use App\Http\Controllers\UserAttachmentController;
use App\Http\Controllers\PrimaryDataController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BaladyaApprovalController;
use App\Http\Controllers\ProjectPaymentController;
use App\Http\Controllers\BaladyaStatusTypeController;
use App\Http\Controllers\OwnerRequirementController;
use App\Http\Controllers\ProjectOwnerRequirementController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*Route::get('/user-with-primary/{uae_id}', function ($uae_id) {
    $user = App\Models\User::with('primaryData')->where('uae_id', $uae_id)->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    return response()->json([
        'user' => $user,
        'primary_data' => $user->primaryData
    ]);
});*/


Route::get('/', function () {
    return redirect(Auth::check() ? '/home' : '/login');
});
Route::get('/two-factor-challenge', [AuthenticatedSessionController::class, 'showTwoFactorChallengeForm']);

/*Route::get('/register', function () {
    return redirect(Auth::check() ? '/home' : '/login');
})->name('register');*/

//Auth::routes(['register' => false]); 
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::middleware(['auth', 'checkRole:admin,co-admin'])->group(function () {
    
    Route::get('/audit-logs', [App\Http\Controllers\AuditLogController::class, 'index'])->name('audit-logs.index');

    Route::get('/activate-license', [LicenseController::class, 'form'])->name('license.form');
    Route::post('/activate-license', [LicenseController::class, 'activate'])
        ->middleware('throttle:5,1')
        ->name('license.activate');

});


/*use Illuminate\Support\Facades\DB;
use App\Models\User;

Route::get('/audit-test', function () {
    $user = User::find(13);

    $oldName = $user->name;
    $newName = 'Updated via DB::update at ' . now();

    // Perform the update
    DB::table('users')
        ->where('id', $user->id)
        ->update(['name' => $newName]);

    // Manually insert audit
    Audit::create([
        'user_type'      => User::class,
        'user_id'        => 1,
        'event'          => 'updated',
        'auditable_type' => User::class,
        'auditable_id'   => $user->id,
        'old_values'     => ['name' => $oldName],
        'new_values'     => ['name' => $newName],
        'url'            => request()->fullUrl(),
        'ip_address'     => request()->ip(),
        'user_agent'     => request()->userAgent(),
        'tags'           => 'manual',
    ]);

    Audit::created(function ($audit) {
        \Illuminate\Support\Facades\Log::info('Audit entry created:', $audit->toArray());
    });
    return 'Manual audit logged for DB update';
});*/
//Route::post('/attachments/save', [AttachmentController::class, 'storeOrUpdate'])->name('attachments.storeOrUpdate');
//Route::middleware('web')->group(function () {
//Route::post('/attachments/storeOrUpdate', [App\Http\Controllers\AttachmentController::class, 'storeOrUpdate'])->name('attachments.storeOrUpdate');
//});

Route::middleware(['auth', 'checkRole:co-admin,admin'])->group(function () {
    


    Route::resource('primaryDatas', App\Http\Controllers\PrimaryDataController::class);
    Route::resource('primaryDatasSubmissions', App\Http\Controllers\PrimaryDataSubmissionController::class);
    Route::get('/mySubmissions', [App\Http\Controllers\PrimaryDataController::class, 'index'])->name('primary_datas.mySubmissions');

    




    
    //Route::resource('attachments', App\Http\Controllers\PrimaryDataController::class);
    
    //Route::resource('primary_datas', App\Http\Controllers\PrimaryDataController::class);
});
Route::middleware(['auth'])->group(function () {











Route::prefix('projects/{project}')
    ->name('projects.')
    ->group(function () {

        /*Route::resource(
            'baladya-approvals',
            BaladyaApprovalController::class
        );*/
        /*Route::resource(
                'project-payments',
                ProjectPaymentController::class
            );*/
    });






Route::prefix('projects/{project}/owner-requirements')
    ->name('projects.owner-requirements.')
    ->group(function () {

        Route::get('/', [OwnerRequirementController::class, 'index'])
            ->name('index');

        Route::post('/', [OwnerRequirementController::class, 'store'])
            ->name('store');

        Route::get('/print', [OwnerRequirementController::class, 'print'])
            ->name('print');
    });







// Project Payments routes
Route::prefix('projects/{project}/project-payments')->group(function() {

    Route::get('/', 
        [ProjectPaymentController::class, 'index']
    )->name('projects.project-payments.index');

    Route::get('create', 
        [ProjectPaymentController::class, 'create']
    )->name('projects.project-payments.create');

    Route::post('/', 
        [ProjectPaymentController::class, 'store']
    )->name('projects.project-payments.store');

    Route::get('{id}/edit', 
        [ProjectPaymentController::class, 'edit']
    )->name('projects.project-payments.edit');

    Route::put('{id}', 
        [ProjectPaymentController::class, 'update']
    )->name('projects.project-payments.update');

    Route::delete('{id}', 
        [ProjectPaymentController::class, 'destroy']
    )->name('projects.project-payments.destroy');
});


// Baladya Approvals routes
Route::prefix('projects/{project}/baladya-approvals')->group(function() {
    Route::get('/', [BaladyaApprovalController::class, 'index'])->name('projects.baladya-approvals.index');
    Route::get('create', [BaladyaApprovalController::class, 'create'])->name('projects.baladya-approvals.create');
    Route::post('/', [BaladyaApprovalController::class, 'store'])->name('projects.baladya-approvals.store');
    Route::get('{id}/edit', [BaladyaApprovalController::class, 'edit'])->name('projects.baladya-approvals.edit');
    Route::put('{id}', [BaladyaApprovalController::class, 'update'])->name('projects.baladya-approvals.update');
    Route::delete('{id}', [BaladyaApprovalController::class, 'destroy'])->name('projects.baladya-approvals.destroy');
});
Route::get('projects/{project}/baladya-approvals/create', [BaladyaApprovalController::class, 'create'])
     ->name('projects.baladya-approvals.create');



Route::get(
    'projects/{project}/project-payments/create',
    [ProjectPaymentController::class, 'create']
)->name('projects.project-payments.create');




Route::get('/projects/{id}/contract-owner-requirements', 
    [App\Http\Controllers\ProjectController::class, 'ownerRequirementContractPdf']
)->name('projects.contract.owner-requirements.pdf');


    Route::get(
        '/projects/{id}/contract',
        [App\Http\Controllers\ProjectController::class, 'contractPdf']
        )->name('projects.contract.pdf');
Route::get('/projects/{id}/contract-owner-consultant', 
    [App\Http\Controllers\ProjectController::class, 'contractOwnerConsultantPdf']
)->name('projects.contract.owner_consultant.pdf');

Route::get('/projects/{id}/takleef-contract', 
    [App\Http\Controllers\ProjectController::class, 'takleefContractPdf']
)->name('projects.contract.takleef.pdf');

Route::get('/projects/{id}/hawya-contract', 
    [App\Http\Controllers\ProjectController::class, 'hawyaContractPdf']
)->name('projects.contract.hawya.pdf');



Route::get('/projects/{id}/site-delivery-contract', 
    [App\Http\Controllers\ProjectController::class, 'siteDeliveryContractPdf']
)->name('projects.contract.site_delivery.pdf');



Route::get('/projects/{id}/bank-contract', 
    [App\Http\Controllers\ProjectController::class, 'bankContractPdf']
)->name('projects.contract.bank.pdf');


Route::get('/projects/{id}/bank-table-contract', 
    [App\Http\Controllers\ProjectController::class, 'bankTableContractPdf']
)->name('projects.contract.bank_table.pdf');

Route::get(
    'users/{id}/attachments',
    [UserAttachmentController::class, 'form']
)->name('users.attachments.form');


Route::get('/projects/{id}/bank-table-contract', 
    [App\Http\Controllers\ProjectController::class, 'bankTableContractPdf']
)->name('projects.contract.bank_table.pdf');





    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //Route::get('users/{user}/attachments/create', [UserAttachmentController::class, 'create'])->name('users.attachments.create');

    //Route::post('users/{user}/attachments', [UserAttachmentController::class, 'store'])->name('users.attachments.store');
    
    
    
    
    
    /*Route::prefix('{type}/{id}')->group(function () {
        Route::get('attachments/create', [UserAttachmentController::class, 'create'])
            ->name('attachments.create');

        Route::post('attachments', [UserAttachmentController::class, 'store'])
            ->name('attachments.store');
    });*/
    Route::get('/users/{id}/attachments/create', [UserAttachmentController::class, 'create'])->name('users.attachments.create');

    Route::post('/users/{id}/attachments', [UserAttachmentController::class, 'store'])->name('users.attachments.store');

    Route::get('/contracts/project/{project}', [ProjectController::class, 'downloadAgreement'])
        ->name('projects.contract.download');








    Route::post('/change-lang', [SettingController::class, 'changeLang'])
        ->name('change.lang');







     //Route::get('/primary-datas/{id}/edit', [PrimaryDataController::class, 'edit'])->name('primary_datas.edit');



    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('profile.changePassword');















    Route::get('/user/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('user.edit');
    //Route::put('/user/update', [App\Http\Controllers\HomeController::class, 'update'])->name('user.update');
    Route::put('user/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('user.update');

    //Route::get('/support/{id}/edit', [App\Http\Controllers\PrimaryDataController::class, 'edit'])
    //    ->name('support.primaryDatas.edit');
    //Route::put('/support/{id}', [App\Http\Controllers\PrimaryDataController::class, 'update'])
    //    ->name('support.primaryDatas.update');

    





    

    //Route::get('/send-sms', [SmsController::class, 'sendCampaign']);
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //Route::put('/primary_datas/{id}', [PrimaryDataController::class, 'update'])->name('primary_datas.update');

    // Edit/update from primary_datas_submissions
    //Route::put('/primary_datas_submissions/{id}', [PrimaryDatasSubmissionsController::class, 'update'])->name('primary_datas_submissions.update');




    Route::get('/primaryDatas/support/pdf/{id}', function ($id) {
        $support = \App\Models\Support::with([
            'searcherarch',
            'supportrequiredarch',
            'caseid.region',
        ])->findOrFail($id);

        return view('supports.pdf', compact('support'));
    });



    
    Route::get('/supports/{id}/download', [App\Http\Controllers\SupportController::class, 'download'])->name('supports.download');
    Route::get('/supports/{id}/print', [App\Http\Controllers\SupportController::class, 'print'])->name('supports.print');
   
    Route::resource('careers', App\Http\Controllers\careerController::class);
    Route::resource('careers', App\Http\Controllers\CareerController::class);
    Route::resource('house-types', App\Http\Controllers\HouseTypeController::class);
    Route::resource('marital-statuses', App\Http\Controllers\MaritalStatusController::class);
    Route::resource('nationalits', App\Http\Controllers\NationalitController::class);
    Route::resource('regions', App\Http\Controllers\RegionController::class);
    Route::resource('sexes', App\Http\Controllers\SexController::class);
    Route::resource('supports', App\Http\Controllers\SupportController::class);
    Route::resource('attachments', App\Http\Controllers\AttachmentController::class);
    Route::resource('support-types', App\Http\Controllers\SupportTypeController::class);
    Route::resource('attachment-types', App\Http\Controllers\AttachmentTypeController::class);
    Route::get('/logs', [LogViewerController::class, 'index']);
    Route::resource('alerts', App\Http\Controllers\AlertController::class);

    Route::get('/admin/audit-logs', [AuditLogController::class, 'index'])->name('audit.logs');
    Route::get('/admin/audit-logs/export/{type}', [AuditLogController::class, 'export'])->name('audits.export');
});

Route::get('/two-factor-challenge', function () {
        return view('auth.two-factor-challenge'); // 👈 create this Blade view
    })->middleware(['guest:' . config('fortify.guard')])
    ->name('two-factor.login');


Route::get('/reset-password/{token}', function ($token) {
    return app(\Laravel\Fortify\Contracts\ResetPasswordViewResponse::class)->toResponse(request()->merge(['token' => $token]));
})->middleware(['guest'])->name('password.reset');





Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

//Route::resource('users', App\Http\Controllers\UserController::class);
// routes/web.php


//Auth::routes();


//Route::get('attachments/create', [AttachmentController::class, 'create'])->name('attachments.create');

//Route::resource('primary-datas', App\Http\Controllers\PrimaryDataController::class);













Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('projects', App\Http\Controllers\ProjectController::class);
Route::resource('statuses', App\Http\Controllers\StatusController::class);
Route::resource('settings', App\Http\Controllers\SettingController::class);
Route::resource('project-users', App\Http\Controllers\ProjectUserController::class);
Route::resource('baladya-approvals', App\Http\Controllers\BaladyaApprovalController::class);
Route::resource('baladya-status-types', App\Http\Controllers\BaladyaStatusTypeController::class);
Route::resource('project-stages', App\Http\Controllers\ProjectStageController::class);
Route::resource('project-names', App\Http\Controllers\ProjectNameController::class);
Route::resource('project-regions', App\Http\Controllers\ProjectRegionController::class);
Route::resource('project-payments', App\Http\Controllers\ProjectPaymentController::class);
Route::resource('owner-requirements', App\Http\Controllers\OwnerRequirementController::class);
Route::resource('project-owner-requirements', App\Http\Controllers\ProjectOwnerRequirementController::class);
Route::resource('project-design-preferences', App\Http\Controllers\ProjectDesignPreferencesController::class);