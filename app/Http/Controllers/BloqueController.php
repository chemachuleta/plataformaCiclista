<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BloqueController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Listar bloques']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Crear bloque', 'data' => $request->all()], 201);
    }

    public function show($id)
    {
        return response()->json(['message' => 'Detalle de bloque', 'id' => (int) $id]);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Bloque eliminado', 'id' => (int) $id]);
    }
}
