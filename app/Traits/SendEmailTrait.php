<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SendEmailTrait
{
    function sendBrevoEmail($data,$bitacora_id,$subject,$to): string
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'api-key' => env('BREVO_API_KEY'),
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name' => 'Only One Coin',
                'email' => $to
            ],
            'to' => [
                [
                    'email' => $data['correo'],
                    'name' => $data['nombres'] . ' ' . $data['apellidos'],
                ]
            ],
            'subject' => $subject,
            'htmlContent' => $this->generarCorreoSiniestro($data),
            'tags' => [strval($bitacora_id)]
        ]);

        if ($response->successful()) {
            return 'Email sent successfully!';
        } else {
            return 'Failed to send email: ' . $response->body();
        }
    }
    function generarCorreoSiniestro($data): string
    {
        $html = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <title>CORREO SINIESTRO</title>
              <link rel="stylesheet" href="' . asset('assets/dist/css/adminlte.min.css') . '">
            </head>
            <body>
            <div class="wrapper">
              <section>
                <div style="background-color:#f3f6f8;height:100%;width:900px;text-justify: auto;">
                  <p style="font-size: 20px;">Estimado alumno ' . $data['nombres'] . ' ' . $data['apellidos'] . ', informarle que su matrícula es procesada con éxito, por favor de unirse al siguiente link</p>

                  <p style="font-size: 20px;font-weight: bolder;">Datos del estudiante:</p>
                  <p style="font-size: 20px;">Nombre del Estudiante: ' . $data['nombres'] . ' ' . $data['apellidos'] . '</p>
                  <p style="font-size: 20px;">Número de contacto: ' . $data['telefono'] . '</p>
                  <p style="font-size: 20px;font-weight: bolder;">Información de clase:</p>
                  <p style="font-size: 20px;">Clase: ' . $data['modulo'] . '</p>
                  <p style="font-size: 20px;">Horario: ' . $data['horario'] . '</p>
                  <p style="font-size: 20px;">Fecha de Inicio: ' . date_format(date_create($data['f_inicio']), 'd-m-Y') . '</p>
                  <p style="font-size: 20px;">Link de Classroom: <a href="' . $data['url_classrom'] . '" style="font-weight: bold;">' . $data['url_classrom'] . '</a></p>
                  <p style="font-size: 20px;">CÓDIGO DE CLASE: ' . $data['codigo_clase'] . '</p>

                  <p style="font-size: 21px;font-weight: bolder;">Recuerde que es obligatorio el unirse al classroom, ya que TODO se publicará por ese medio. Es d instrucciones.</p>
                  <p>EL CAMBIO DE HORARIO TIENE UN COSTO DE S/10.00 SOLES ASÍ QUE FAVOR DE REVISAR BIEN</p>
                  <p>PARA TRANSFERENCIA A OTRA PERSONA SOLO SE PERMITE HASTA 3 DÍAS DESPUÉS DE EMPEZAR</p>
                  <p>SI DESEA CONGELAR SU MATRÍCULA SÓLO ES POSIBLE POR TRES MESES Y DEBE PAGAR S/10.</p>
                  <p>LOS EXÁMENES SON OBLIGATORIOS Y NO SON REPROGRAMABLES, SOLO POR TEMAS MÉDICO</p>
                  <p>ALUMNO ESTAR INFORMADO DE LAS FECHAS Y DURACIÓN DE LAS EVALUACIONES</p>
                  <p>RECUERDE: EL PAGO ES NO REEMBOLSABLE, SÓLO TRANSFERIBLE</p>
                </div>
              </section>
            </div>
            </body>
            </html>';
        return $html;
    }


}
