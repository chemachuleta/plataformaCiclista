<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogoApiController extends Controller
{
    public function bicicletas()
    {
        $bicicletas = DB::table('bicicleta')
            ->select('id', 'nombre', 'tipo', 'comentario')
            ->orderBy('nombre')
            ->get();

        return response()->json(['data' => $bicicletas]);
    }

    public function ciclistas()
    {
        $ciclistas = DB::table('ciclista')
            ->select('id', 'nombre', 'apellidos', 'email', 'fecha_nacimiento')
            ->orderBy('id')
            ->get();

        return response()->json(['data' => $ciclistas]);
    }

    public function planes(Request $request)
    {
        $query = DB::table('plan_entrenamiento')
            ->select('id', 'id_ciclista', 'nombre', 'fecha_inicio', 'fecha_fin', 'activo')
            ->orderBy('id', 'desc');

        if ($request->filled('id_ciclista')) {
            $query->where('id_ciclista', (int) $request->query('id_ciclista'));
        }

        return response()->json(['data' => $query->get()]);
    }
}
