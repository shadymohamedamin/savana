<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Support;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mpdf\Mpdf;
use App\Services\SmsService;
use App\Helpers\AuditHelper;

require_once base_path('whatsapp_helper.php');
require_once base_path('sms_helper.php');



class SupportController extends AppBaseController
{
    /** @var SupportRepository $supportRepository*/
    private $supportRepository;

    public function __construct(SupportRepository $supportRepo)
    {
        $this->supportRepository = $supportRepo;
    }
    private function isSubmissionRoute(): bool
    {
        return \Illuminate\Support\Str::contains(request()->route()->getName(), 'primaryDatasSubmissions');
    }
    /**
     * Display a listing of the Support.
     */
    public function index(Request $request)
    {
        $supports = $this->supportRepository->paginate(10);

        return view('supports.index')->with('supports', $supports);
    }




   public function print($id,Request $request)
    {
        //Mail::raw('This is a test email', function ($message) {
        //$message->to('it@rakcharity.ae')->subject('Test Email');});
        //sendSms('AD-RAKC', ['971568384460'], 'Message from Laravel');

        // $from = 'AD-RAKC'; 
        // $recipients = ['971568384460'];
        // $message = "Test WhatsApp message from rakcharity.ae";

        // foreach ($recipients as $to) {
        //     $result = sendWhatsAppMessage($from, $to, $message);
        //     echo "<pre>Sent to: $to\n";
        //     print_r($result);
        //     echo "</pre>";
        // }
        //$smsService = app()->make(\App\Services\Reason8SmsService::class);
        //$response = $smsService->sendCampaignSMS(['971568384460'], 'رسالة اختبار', 'RakCharity Campaign');









        //$recipients = ['971568384460'];php artisan config:clear
        //$message = 'رسالة اختبار';
        //$campaign = 'RakCharity Campaign';

        //$smsService = app(\App\Services\Reason8SmsService::class);
        //$smsService->sendCampaignSMS($recipients, $message, $campaign);
        //$smsService->sendWhatsAppMessage($recipients, 'Test WhatsApp message from rakcharity');


        //$support = \App\Models\Support::with(['searcherarch', 'supportrequiredarch','supporttype', 'caseid.region','caseid.nationality'])->findOrFail($id);
        
        $referer = $request->headers->get('referer');
        $isSubmission = str_contains($referer, '/primaryDatasSubmissions/');

        if ($isSubmission) {
            // لو جدول supports_submissions
            $support = \App\Models\SupportSubmission::with([
                'searcherarch', 'supportrequiredarch', 'supporttype', 
                'caseid.region', 'caseid.nationality'
            ])->findOrFail($id);
        } else {
            // لو جدول supports
            $support = \App\Models\Support::with([
                'searcherarch', 'supportrequiredarch', 'supporttype', 
                'caseid.region', 'caseid.nationality'
            ])->findOrFail($id);
        }
        
        $html = view('supports.pdf', compact('support'))->render();

        $mpdf = new Mpdf([
            'tempDir' => storage_path('app/mpdf-temp'),
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'amiri',
        ]);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $mpdf->WriteHTML($html);
        return $mpdf->Output('support_' . $support->ID . '.pdf', 'I'); 
    }

    public function download($id,Request $request)
    {
        //$support = \App\Models\Support::with(['searcherarch', 'supportrequiredarch','supporttype', 'caseid.region','caseid.nationality'])->findOrFail($id);
        //dd($support->toArray());
        
         $referer = $request->headers->get('referer');
        $isSubmission = str_contains($referer, '/primaryDatasSubmissions/');

        if ($isSubmission) {
            $support = \App\Models\SupportSubmission::with([
                'searcherarch', 'supportrequiredarch', 'supporttype', 
                'caseid.region', 'caseid.nationality'
            ])->findOrFail($id);
        } else {
            $support = \App\Models\Support::with([
                'searcherarch', 'supportrequiredarch', 'supporttype', 
                'caseid.region', 'caseid.nationality'
            ])->findOrFail($id);
        }
        
        
        $html = view('supports.pdf', compact('support'))->render();

        $mpdf = new Mpdf([
            'tempDir' => storage_path('app/mpdf-temp'),
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'amiri',
        ]);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $mpdf->WriteHTML($html);
        return $mpdf->Output('support_request_' . $support->ID . '.pdf', 'D'); // Download
    }

    /**
     * Show the form for creating a new Support.
     */
    public function create(Request $request)
    {
        //$attTypes = \App\Models\AttachmentType::pluck('AttType', 'ID');
        $CaseID = $request->case_id;//$request->get('case_id'); // Comes from modal button
        //return view('attachments.create', compact('attTypes', 'CaseID'));
        $supportTypes = \App\Models\SupportType::pluck('SupportType', 'ID');
        
        return view('supports.create', compact('supportTypes', 'CaseID'));
        //return view('supports.create');
    }

    /**
     * Store a newly created Support in storage.
     */
    /*public function store(CreateSupportRequest $request)
    {
        //\Illuminate\Support\Facades\Log::info($request->all());
        $input = $request->all();
        $now = Carbon::now();
        $input['CaseID'] = $request->get('case_id'); 
        //$input['UserAdd'] = auth()->id();
        //dd($input);
        //
        //dd($input);
        
        //$input['UserAdd'] = auth()->id();
        //$input['UserEdit'] = auth()->id();
        //$input['CaseDate'] = $now;
        //$support = $this->supportRepository->create($input);
        \Illuminate\Support\Facades\DB::table($this->isSubmissionRoute() ? 'supports_submissions' : 'supports')->insert([//DB::table('supports')->insert([
            'CaseID' => $input['CaseID'],
            'SupportRequiredArch' => $input['SupportRequiredArch'],
            'SupportType' => $input['SupportType'],
            'NeedAmount' => $input['NeedAmount'],
            'SupportAmount' => $input['SupportAmount'],
            'Note' => $input['Note'],
            'SalaryArch' => $input['SalaryArch'],
            'IncomeArch' => $input['IncomeArch'],
            'WifeSalaryArch' => $input['WifeSalaryArch'],
            'OfflineSalaryArch' => $input['OfflineSalaryArch'],
            'SocialSalaryArch' => $input['SocialSalaryArch'],
            'OtherSalaryArch' => $input['OtherSalaryArch'],
            'ChildrenInArch' => $input['ChildrenInArch'],
            'LoanArch' => $input['LoanArch'],
            'RentArch' => $input['RentArch'],
            'DriverArch' => $input['DriverArch'],
            'FeesArch' => $input['FeesArch'],
            'ServantArch' => $input['ServantArch'],
            'EleWaterArch' => $input['EleWaterArch'],
            'HouseArch' => $input['HouseArch'],
            'BankArch' => $input['BankArch'],
            'FurnatureArch' => $input['FurnatureArch'],
            'CarArch' => $input['CarArch'],
            'CourtArch' => $input['CourtArch'],
            'ChildrenOutArch' => $input['ChildrenOutArch'],
            'SearcherArch' => auth()->id(),
            'CaseDescription' => $input['CaseDescription'],
            'Application_Date' => $input['Application_Date'],
            'Dat' => $now,
            'AppRemarks' => $input['AppRemarks'],
        ]);
        AuditHelper::logAudit('created', 'supports', [], $input);
        session()->flash('success', 'Attachment created successfully.');
        Flash::success('Attachment saved successfully.');
        return redirect()->route('primaryDatas.show', ['primaryData' => $input['CaseID']])->withFragment('supports');


        //Flash::success('Support saved successfully.');

        //return redirect(route('supports.index'));
    }*/



    // public function store(CreateSupportRequest $request)
    // {
    //     $input = $request->all();
    //     $now = Carbon::now();
    //     $input['CaseID'] = $request->get('case_id');

    //     $isSubmission = $this->isSubmissionRoute();
    //     dd($isSubmission);
    //     \Illuminate\Support\Facades\DB::table($isSubmission ? 'supports_submissions' : 'supports')->insert([
    //         'CaseID' => $input['CaseID'],
    //         'SupportRequiredArch' => $input['SupportRequiredArch'],
    //         'SupportType' => $input['SupportType'],
    //         'NeedAmount' => $input['NeedAmount'],
    //         'SupportAmount' => $input['SupportAmount'],
    //         'Note' => $input['Note'],
    //         'SalaryArch' => $input['SalaryArch'],
    //         'IncomeArch' => $input['IncomeArch'],
    //         'WifeSalaryArch' => $input['WifeSalaryArch'],
    //         'OfflineSalaryArch' => $input['OfflineSalaryArch'],
    //         'SocialSalaryArch' => $input['SocialSalaryArch'],
    //         'OtherSalaryArch' => $input['OtherSalaryArch'],
    //         'ChildrenInArch' => $input['ChildrenInArch'],
    //         'LoanArch' => $input['LoanArch'],
    //         'RentArch' => $input['RentArch'],
    //         'DriverArch' => $input['DriverArch'],
    //         'FeesArch' => $input['FeesArch'],
    //         'ServantArch' => $input['ServantArch'],
    //         'EleWaterArch' => $input['EleWaterArch'],
    //         'HouseArch' => $input['HouseArch'],
    //         'BankArch' => $input['BankArch'],
    //         'FurnatureArch' => $input['FurnatureArch'],
    //         'CarArch' => $input['CarArch'],
    //         'CourtArch' => $input['CourtArch'],
    //         'ChildrenOutArch' => $input['ChildrenOutArch'],
    //         'SearcherArch' => auth()->id(),
    //         'CaseDescription' => $input['CaseDescription'],
    //         'Application_Date' => $input['Application_Date'],
    //         'Dat' => $now,
    //         'AppRemarks' => $input['AppRemarks'],
    //     ]);

    //     AuditHelper::logAudit('created', 'supports', [], $input);

    //     session()->flash('success', 'Support created successfully.');

    //     if ($isSubmission) {
    //         return redirect()->route('primaryDatasSubmissions.show', ['id' => $input['CaseID']])->withFragment('supports');
    //     } else {
    //         return redirect()->route('primaryDatas.show', ['primaryData' => $input['CaseID']])->withFragment('supports');
    //     }
    // }



    public function store(CreateSupportRequest $request)
    {
        $input = $request->all();
        $now = Carbon::now();
        $isSubmission = $this->isSubmissionRoute();
        $input['CaseID'] = $request->get('case_id');

        $referer = $request->headers->get('referer');//str_contains($referer, '/primaryDatasSubmissions/')
        //dd($referer);
        \Illuminate\Support\Facades\DB::table(str_contains($referer, '/primaryDatasSubmissions/') ? 'supports_submissions' : 'supports')
            ->insert([
                'CaseID' => $input['CaseID'],
                'SupportRequiredArch' => $input['SupportRequiredArch'],
                'SupportType' => $input['SupportType'],
                'NeedAmount' => $input['NeedAmount'],
                'SupportAmount' => $input['SupportAmount'],
                'Note' => $input['Note'],
                'SalaryArch' => $input['SalaryArch'],
                'IncomeArch' => $input['IncomeArch'],
                'WifeSalaryArch' => $input['WifeSalaryArch'],
                'OfflineSalaryArch' => $input['OfflineSalaryArch'],
                'SocialSalaryArch' => $input['SocialSalaryArch'],
                'OtherSalaryArch' => $input['OtherSalaryArch'],
                'ChildrenInArch' => $input['ChildrenInArch'],
                'LoanArch' => $input['LoanArch'],
                'RentArch' => $input['RentArch'],
                'DriverArch' => $input['DriverArch'],
                'FeesArch' => $input['FeesArch'],
                'ServantArch' => $input['ServantArch'],
                'EleWaterArch' => $input['EleWaterArch'],
                'HouseArch' => $input['HouseArch'],
                'BankArch' => $input['BankArch'],
                'FurnatureArch' => $input['FurnatureArch'],
                'CarArch' => $input['CarArch'],
                'CourtArch' => $input['CourtArch'],
                'ChildrenOutArch' => $input['ChildrenOutArch'],
                'SearcherArch' => auth()->id(),
                'CaseDescription' => $input['CaseDescription'],
                'Application_Date' => $input['Application_Date'],
                'Dat' => $now,
                'AppRemarks' => $input['AppRemarks'],
            ]);

        //if (str_contains($referer, '/primaryDatasSubmissions/')) {
            //dd("true");
            // لا تخزن شيء، فقط رجّع للمصدر



        //    return redirect()->to($referer)->withFragment('supports');
        //}
        ///else
        //{

                

            AuditHelper::logAudit('created', 'supports', [], $input);

            session()->flash('success', 'Support created successfully.');

        // إذا لم تكن من صفحة submissions → خزّن في جدول supports
        

        if (str_contains($referer, '/primaryDatasSubmissions/')) {
            return redirect()->route('primaryDatasSubmissions.show', ['primaryDatasSubmission' => $input['CaseID']])->withFragment('supports');
        } else {
            return redirect()->route('primaryDatas.show', ['primaryData' => $input['CaseID']])->withFragment('supports');
        }
        //return redirect()->route('primaryDatas.show', ['primaryData' => $input['CaseID']])->withFragment('supports');
    }




    /**
     * Display the specified Support.
     */
    public function show($id)
    {
        $support = $this->supportRepository->find($id);

        if (empty($support)) {
            Flash::error('Support not found');

            return redirect(route('supports.index'));
        }

        return view('supports.show')->with('support', $support);
    }

    /**
     * Show the form for editing the specified Support.
     */
    // public function edit($id)
    // {
    //     $support = $this->supportRepository->find($id);

    //     if (empty($support)) {
    //         Flash::error('Support not found');

    //         return redirect(route('supports.index'));
    //     }
    //     $supportTypes = \App\Models\SupportType::pluck('SupportType', 'ID');
    //     return view('supports.edit')
    //         ->with('support', $support)
    //         ->with('supportTypes', $supportTypes);
    //     //return view('supports.edit')->with('support', $support);
    // }
    public function edit($id,Request $request)
    {
        $referer = $request->headers->get('referer');//str_contains($referer, '/primaryDatasSubmissions/')
        //dd(str_contains($referer, '/primaryDatasSubmissions/'));
        $support = \Illuminate\Support\Facades\DB::table(str_contains($referer, '/primaryDatasSubmissions/') ? 'supports_submissions' : 'supports')->where('id', $id)->first();

        if (!$support) {
            Flash::error('Support not found');
            return redirect(route('supports.index'));
        }

        $supportTypes = \App\Models\SupportType::pluck('SupportType', 'ID');

        return view('supports.edit', compact('support', 'supportTypes'));
    }


    /**
     * Update the specified Support in storage.
     */
    // public function update($id, UpdateSupportRequest $request)
    // {
    //     $support = $this->supportRepository->find($id);

    //     if (empty($support)) {
    //         Flash::error('Support not found');

    //         return redirect(route('supports.index'));
    //     }

    //     $support = $this->supportRepository->update($request->all(), $id);

    //     Flash::success('Support updated successfully.');

    //     return redirect(route('supports.index'));
    // }
    public function update($id, Request $request)
    {
        $referer = $request->headers->get('referer');//str_contains($referer, '/primaryDatasSubmissions/')
        $support = \Illuminate\Support\Facades\DB::table(str_contains($referer, '/primaryDatasSubmissions/') ? 'supports_submissions' : 'supports')->where('id', $id)->first();

        if (!$support) {
            Flash::error('Support not found');
            return redirect(route('supports.index'));
        }

        $input = $request->all();
        //dd($id, $input);
        $oldValues = (array) $support;
        $now = \Carbon\Carbon::now();

        $updatedFields = [
            'SupportRequiredArch' => $input['SupportRequiredArch'],
            'SupportType' => $input['SupportType'],
            'NeedAmount' => $input['NeedAmount'],
            'SupportAmount' => $input['SupportAmount'],
            'Note' => $input['Note'],
            'SalaryArch' => $input['SalaryArch'],
            'IncomeArch' => $input['IncomeArch'],
            'WifeSalaryArch' => $input['WifeSalaryArch'],
            'OfflineSalaryArch' => $input['OfflineSalaryArch'],
            'SocialSalaryArch' => $input['SocialSalaryArch'],
            'OtherSalaryArch' => $input['OtherSalaryArch'],
            'ChildrenInArch' => $input['ChildrenInArch'],
            'LoanArch' => $input['LoanArch'],
            'RentArch' => $input['RentArch'],
            'DriverArch' => $input['DriverArch'],
            'FeesArch' => $input['FeesArch'],
            'ServantArch' => $input['ServantArch'],
            'EleWaterArch' => $input['EleWaterArch'],
            'HouseArch' => $input['HouseArch'],
            'BankArch' => $input['BankArch'],
            'FurnatureArch' => $input['FurnatureArch'],
            'CarArch' => $input['CarArch'],
            'CourtArch' => $input['CourtArch'],
            'ChildrenOutArch' => $input['ChildrenOutArch'],
            'Application_Date' => $input['Application_Date'],
            'CaseDescription' => $input['CaseDescription'],
            'AppRemarks' => $input['AppRemarks'],
            'Dat' => $now
        ];

        \Illuminate\Support\Facades\DB::table(str_contains($referer, '/primaryDatasSubmissions/') ? 'supports_submissions' : 'supports')->where('id', $id)->update($updatedFields);
        $fakeSupportModel = new Support();
        $fakeSupportModel->exists = true;
        $fakeSupportModel->id = $id;

        AuditHelper::logAudit('updated', $fakeSupportModel, $oldValues, $updatedFields);
        Flash::success('Support updated successfully.');
        session()->flash('success', 'Attachment updated successfully.');

        $referer = $request->headers->get('referer');//str_contains($referer, '/primaryDatasSubmissions/')
        $routeName = str_contains($referer, '/primaryDatasSubmissions/')
            ? 'primaryDatasSubmissions.show'
            : 'primaryDatas.show';

        $routeParams = str_contains($referer, '/primaryDatasSubmissions/')
            ? ['primaryDatasSubmission' => $support->CaseID]
            : ['primaryData' => $support->CaseID];

        return redirect()->route($routeName, $routeParams)->withFragment('supports');
        
        //return redirect()->route('primaryDatas.show', ['primaryData' => $support->CaseID])->withFragment('supports');
    }


    /**
     * Remove the specified Support from storage.
     *
     * @rthows \Exception
     */
    // public function destroy($id)
    // {
    //     $support = $this->supportRepository->find($id);

    //     if (empty($support)) {
    //         Flash::error('Support not found');

    //         return redirect(route('supports.index'));
    //     }

    //     $this->supportRepository->delete($id);

    //     Flash::success('Support deleted successfully.');

    //     return redirect(route('supports.index'));
    // }
    public function destroy($id, Request $request)
    {
        $referer = $request->headers->get('referer');
        //dd(str_contains($referer, '/primaryDatasSubmissions/'));
        $support = \Illuminate\Support\Facades\DB::table(str_contains($referer, '/primaryDatasSubmissions/') ? 'supports_submissions' : 'supports')->where('id', $id)->first();
        //dd(str_contains($referer, '/primaryDatasSubmissions/'));
        if (!$support) {
            Flash::error('Support not found');
            return redirect(route('supports.index'));
        }
        $supportArray = json_decode(json_encode($support), true);

        AuditHelper::logAudit('deleted', $support, $supportArray, []);
        \Illuminate\Support\Facades\DB::table(str_contains($referer, '/primaryDatasSubmissions/') ? 'supports_submissions' : 'supports')->where('id', $id)->delete();

        

        Flash::success('Support deleted successfully.');
        session()->flash('success', 'Attachment deleted successfully.');
        $routeName = str_contains($referer, '/primaryDatasSubmissions/')
            ? 'primaryDatasSubmissions.show'
            : 'primaryDatas.show';

        $routeParams = str_contains($referer, '/primaryDatasSubmissions/')
            ? ['primaryDatasSubmission' => $support->CaseID]
            : ['primaryData' => $support->CaseID];

        return redirect()->route($routeName, $routeParams)->withFragment('supports');

//return redirect()->route('primaryDatas.show', ['primaryData' => $support->CaseID])->withFragment('supports');
    }

}
