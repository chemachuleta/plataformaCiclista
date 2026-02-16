<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultadoController extends Controller
{
    public function store(Request $request)
    {
        return response()->json(['message' => 'Crear resultado', 'data' => $request->all()], 201);
    }

    public function show($id)
    {
        return response()->json(['message' => 'Detalle de resultado', 'id' => (int) $id]);
    }
}
