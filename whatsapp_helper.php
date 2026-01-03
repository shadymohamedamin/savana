<?php
// whatsapp_helper.php





//<?php
// require_once 'whatsapp_helper.php';

// // Define your values
// $from = '1234567890'; // your WhatsApp registered number
// $recipients = ['971568384460', '971557627677'];
// $message = "Test WhatsApp message from rakcharity.ae";

// // Loop over recipients
// foreach ($recipients as $to) {
//     $result = sendWhatsAppMessage($from, $to, $message);
//     echo "<pre>Sent to: $to\n";
//     print_r($result);
//     echo "</pre>";
// }





function sendWhatsAppMessage($from, $to, $message, $type = 'Operational') {
    $url = "https://www.reson8.ae/rest-api/v1/whatsapp";

    $headers = [
        "Content-Type: application/json",
        "X-Reson8-ID: reson8rest-oa",
        "X-Reson8-Token: ada2dbe85881dd101af6e4854577f56a30c733eb31de07d84eeb3f83d11c6825", 
        "api-key: 9b88cfdb234ba79871d5b22f99c1a55f17bc2e2f9d8d032b4ba6a9aca80ccf22" 
    ];

    $payload = [
        "from" => $from,            
        "to" => $to,                
        "data" => [
            "type" => "text",       
            "msg" => $message
        ],
        "type" => $type
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $response = curl_exec($ch);
    $error    = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);


    //file_put_contents('whatsapp_log.txt', date('Y-m-d H:i:s') . " [$httpCode] $response\n" . file_get_contents('whatsapp_log.txt'));

    return $error ? ['error' => $error] : ['code' => $httpCode, 'response' => $response];
}
