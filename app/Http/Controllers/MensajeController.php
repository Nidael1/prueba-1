<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class MensajeController extends Controller
{
    public function registrosJson(): JsonResponse
    {
        $path = public_path('mensajes.json');

        $mensajes = [];

        if (file_exists($path)) {
            $mensajes = json_decode(file_get_contents($path), true) ?? [];
            if (!is_array($mensajes)) {
                $mensajes = [];
            }
        }

        // más nuevos primero
        $mensajes = array_reverse($mensajes);

        return response()->json(['registros' => $mensajes]);
    }
}
    