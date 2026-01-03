<?php
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
require_once base_path('sms_helper.php');
sendSms('AD-RAKC', ['971568384460'], 'Message from Laravel');
