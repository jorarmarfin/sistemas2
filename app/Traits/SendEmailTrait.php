<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SendEmailTrait
{
    function sendBrevoEmail($data,$bitacora_id): string
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'api-key' => env('BREVO_API_KEY'),
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name' => 'Institución',
                'email' => 'luis.mayta@gmail.com'
            ],
            'to' => [
                [
                    'email' => $data['correo'],
                    'name' => $data['nombres'] . ' ' . $data['apellidos'],
                ]
            ],
            'subject' => 'Intento1',
            'htmlContent' => '<html><head></head><body><p>Correo 1.</p></body></html>',
            'tags' => [strval($bitacora_id)]
        ]);

        if ($response->successful()) {
            return 'Email sent successfully!';
        } else {
            return 'Failed to send email: ' . $response->body();
        }
    }

}
