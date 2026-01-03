<?php
// sms_helper.php


//<?php
// require_once 'sms_helper.php';

// $recipients = ['971568384460']; 
// $result = sendSms(
//     'AD-RAKC',
//     $recipients,                         
//     'Hello, this is a test message.',
//     'TestCampaign20250604140000'          
// );

// echo "<pre>";
// print_r($result);
// echo "</pre>"; 


//laravel
//require_once base_path('sms_helper.php');
//sendSms('AD-RAKC', ['971568384460'], 'Message from Laravel');


function sendSms($from = 'AD-RAKC', $toArray, $text, $campaignName = 'rakcharity', $type = 'Marketing') {
    $reson8Id = 'reson8rest-oa';
    $reson8Token = 'ada2dbe85881dd101af6e4854577f56a30c733eb31de07d84eeb3f83d11c6825';
    $apiKey = '9b88cfdb234ba79871d5b22f99c1a55f17bc2e2f9d8d032b4ba6a9aca80ccf22';
    $endpoint = 'https://www.reson8.ae/rest-api/v1/message/campaign';
    $logFile = __DIR__ . '/sms_log.txt';

    if ($campaignName === null) {
        $campaignName = 'Campaign_' . date('YmdHis');
    }

    $data = [
        'from' => $from,
        'to' => $toArray,
        'text' => $text,
        'name' => $campaignName,
        'type' => $type,
    ];

    $headers = [
        "Content-Type: application/json",
        "X-Reson8-ID: $reson8Id",
        "X-Reson8-Token: $reson8Token",
        "api-key: $apiKey"
    ];

    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Logging (prepend latest)
    $logEntry = date("Y-m-d H:i:s") . " | [$httpCode] | $response\n";
    if (file_exists($logFile)) {
        file_put_contents($logFile, $logEntry . file_get_contents($logFile));
    } else {
        file_put_contents($logFile, $logEntry);
    }

    return [
        'code' => $httpCode,
        'response' => $response
    ];
}
