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

        // Extract the id from the tags array
        $bitacoraId = $data['tags'][0];

        // Update the bitacora table with the new email status
        DB::table('bitacora')
            ->where('id', $bitacoraId)
            ->update([
                'email_status' => $data['event'],
                'updated_at' => now()
            ]);

        return response()->json([
            'message' => 'Webhook received successfully!'
        ]);
    }
}
