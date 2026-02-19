<?php

namespace App\Http\Controllers;

use App\BloqueEntrenamiento;
use Illuminate\Http\Request;

class BloqueController extends Controller
{
    public function index()
    {
        $bloques = BloqueEntrenamiento::orderBy('id', 'desc')->get();

        return view('bloque.index', ['bloques' => $bloques]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'tipo' => ['required', 'in:rodaje,intervalos,fuerza,recuperacion,test'],
            'duracion_estimada' => ['nullable', 'date_format:H:i'],
            'potencia_pct_min' => ['nullable', 'numeric', 'between:0,999.99'],
            'potencia_pct_max' => ['nullable', 'numeric', 'between:0,999.99'],
            'pulso_pct_max' => ['nullable', 'numeric', 'between:0,999.99'],
            'pulso_reserva_pct' => ['nullable', 'numeric', 'between:0,999.99'],
            'comentario' => ['nullable', 'string', 'max:255'],
        ]);

        if (!empty($validated['duracion_estimada'])) {
            $validated['duracion_estimada'] .= ':00';
        }

        if (
            isset($validated['potencia_pct_min'], $validated['potencia_pct_max']) &&
            $validated['potencia_pct_min'] > $validated['potencia_pct_max']
        ) {
            return back()
                ->withErrors(['potencia_pct_min' => 'La potencia minima no puede ser mayor que la maxima.'])
                ->withInput();
        }

        BloqueEntrenamiento::create($validated);

        return redirect('/bloque')->with('status', 'Bloque de entrenamiento creado correctamente.');
    }

    public function show($id)
    {
        $bloque = BloqueEntrenamiento::findOrFail((int) $id);

        return view('bloque.show', ['bloque' => $bloque]);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Bloque eliminado', 'id' => (int) $id]);
    }
}
