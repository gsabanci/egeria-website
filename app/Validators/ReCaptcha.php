<?php

namespace App\Validators;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $secret = config('app.google_recaptcha_secret');
        
        if (!$secret) {
            Log::warning('reCAPTCHA secret key not configured');
            return false;
        }

        $client = new Client;
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => $secret,
                        'response' => $value,
                        'remoteip' => request()->ip()
                    ]
            ]
        );

        $body = json_decode((string)$response->getBody());
        
        Log::info('reCAPTCHA validation', [
            'success' => $body->success,
            'error_codes' => $body->error_codes ?? [],
            'ip' => request()->ip()
        ]);
        
        return $body->success;
    }
}