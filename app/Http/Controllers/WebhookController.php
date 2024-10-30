<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebhookController extends Controller
{
    public function webhook(Request $request): JsonResponse
    {
        $data = $request->all();

        // Extraer el ID de bitácora desde el array 'tags'
        $bitacoraId = $data['tags'][0];

        // Crear el nuevo estado con la fecha
        $newStatus = [
            'status' => $data['event'],
            'date' => now()->toDateTimeString()
        ];

        // Usar una transacción para asegurarnos de que el proceso sea seguro en concurrencia
        DB::transaction(function () use ($bitacoraId, $newStatus) {
            // Obtener el valor actual de 'emails_status'
            $currentStatus = DB::table('bitacora')
                ->where('id', $bitacoraId)
                ->value('email_status');

            // Decodificar el JSON existente o inicializar como array si está vacío
            $emailsStatusArray = $currentStatus ? json_decode($currentStatus, true) : [];

            // Agregar el nuevo estado al array
            $emailsStatusArray[] = $newStatus;

            // Actualizar el campo 'email_status' con el array incrementado
            DB::table('bitacora')
                ->where('id', $bitacoraId)
                ->update([
                    'email_status' => json_encode($emailsStatusArray), // Guardar como JSON
                    'updated_at' => now()
                ]);
        });

        return response()->json([
            'message' => 'Webhook received successfully!'
        ]);
    }

}
