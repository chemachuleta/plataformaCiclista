<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Listar sesiones']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Crear sesion', 'data' => $request->all()], 201);
    }

    public function show($id)
    {
        return response()->json(['message' => 'Detalle de sesion', 'id' => (int) $id]);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Sesion eliminada', 'id' => (int) $id]);
    }
}
