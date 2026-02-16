<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionBloqueController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Listar sesion-bloque']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Crear sesion-bloque', 'data' => $request->all()], 201);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Sesion-bloque eliminada', 'id' => (int) $id]);
    }
}
