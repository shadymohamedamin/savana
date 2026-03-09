<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Reason8SmsService;

class SmsController extends Controller
{                        
    /**
     * Send SMS to users using Reson8 service.
     *             
     * @param  \App\Services\Reason8SmsService  $smsService
     * @return \Illuminate\Http\JsonResponse
     */
    //https://www.reson8.ae/sendsms.jsp?username=rakcharity&password=Rakc@2022&sendername=rakcharity&mobileno=971568384460&message=Test%20Message
    public function sendCampaign(Reason8SmsService $smsService)
    {
        $numbers = ['971568384460', '971557627677'];
        $message = 'Test message from rakcharity.ae';
        $campaign = 'RakCharity Campaign';

        $response = $smsService->sendCampaignSMS($numbers, $message, $campaign);

        return response()->json($response);
    }

}