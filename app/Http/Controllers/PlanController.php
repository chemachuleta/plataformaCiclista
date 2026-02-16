<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Listar planes']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Crear plan', 'data' => $request->all()], 201);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'Actualizar plan',
            'id' => (int) $id,
            'data' => $request->all(),
        ]);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Plan eliminado', 'id' => (int) $id]);
    }
}
