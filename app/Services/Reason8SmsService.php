<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// class Reason8SmsService
// {
//     public function sendCampaignSMS(array $recipients, string $message, string $campaignName = 'Default Campaign', string $type = 'Marketing')
//     {
//         $payload = [
//             'from' => config('services.reson8.sender'),
//             'to' => $recipients,
//             'text' => $message,
//             'name' => $campaignName,
//             'type' => $type,
//         ];
//         // $payload=[
//         //     "from"=> "AD-RAKC", 
//         //     "to"=> ["971568384460"],
//         //     "text"=> "Test message from rakcharity.ae",
//         //     "name"=> "Test Campaign",
//         //     "type"=> "Marketing"
//         // ];

//         $headers = [
//             'X-Reson8-ID' => config('services.reson8.reson8_id'),
//             'X-Reson8-Token' => config('services.reson8.token'),
//             'api-key' => config('services.reson8.api_key'),
//             'Content-Type' => 'application/json',
//         ];

//         $response = Http::withHeaders($headers)->post(config('services.reson8.campaign_url'), $payload);

//         if (!$response->successful()) {
//             Log::error('Reson8 campaign SMS failed', [
//                 'status' => $response->status(),
//                 'body' => $response->body(),
//             ]);
//         }

//         return $response->json(); 
//     }
//     public function sendWhatsAppMessage(array $recipients, string $message, string $type = 'Operational')
//     {
//         $responses = [];

//         foreach ($recipients as $recipient) {
//             $payload = [
//                 'from' => config('services.reson8.sender'),
//                 'to' => $recipient,
//                 'data' => [
//                     'type' => 'text',
//                     'msg' => $message,
//                 ],
//                 'type' => $type,
//             ];

//             $response = Http::withHeaders($this->headers)
//                 ->post(config('services.reson8.whatsapp_url'), $payload);

//             if (!$response->successful()) {
//                 Log::error('Reson8 WhatsApp failed', [
//                     'type' => 'WhatsApp',
//                     'recipient' => $recipient,
//                     'status' => $response->status(),
//                     'body' => $response->body(),
//                 ]);
//             }

//             $responses[$recipient] = $response->json();
//         }

//         return $responses;
//     }
// }

class Reason8SmsService
{
    protected $headers;

    public function __construct()
    {
        $this->headers = [
            'X-Reson8-ID' => config('services.reson8.reson8_id'),
            'X-Reson8-Token' => config('services.reson8.token'),
            'api-key' => config('services.reson8.api_key'),
            'Content-Type' => 'application/json',
        ];
    }

    public function sendCampaignSMS(array $recipients, string $message, string $campaignName = 'Default Campaign', string $type = 'Marketing')
    {
        $payload = [
            'from' => config('services.reson8.sender'),
            'to' => $recipients,
            'text' => $message,
            'name' => $campaignName,
            'type' => $type,
        ];

        $response = Http::withHeaders($this->headers)
            ->post(config('services.reson8.campaign_url'), $payload);

        if (!$response->successful()) {
            Log::error('Reson8 SMS failed', [
                'type' => 'SMS',
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }

        return $response->json();
    }

    public function sendWhatsAppMessage(array $recipients, string $message, string $type = 'Operational')
    {
        $responses = [];

        foreach ($recipients as $recipient) {
            $payload = [
                'from' => config('services.reson8.whatsapp_from'),
                'to' => $recipient,
                'data' => [
                    'type' => 'text',
                    'msg' => $message,
                ],
                'type' => $type,
            ];

            $response = Http::withHeaders($this->headers)
                ->post(config('services.reson8.whatsapp_url'), $payload);

            if (!$response->successful()) {
                Log::error('Reson8 WhatsApp failed', [
                    'type' => 'WhatsApp',
                    'recipient' => $recipient,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }

            $responses[$recipient] = $response->json();
        }

        return $responses;
    }
}