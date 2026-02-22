<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultadoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_sesion' => ['required', 'integer', 'exists:sesion_entrenamiento,id'],
            'id_bicicleta' => ['required', 'integer', 'exists:bicicleta,id'],
            'fecha' => ['required', 'date'],
            'duracion' => ['required', 'date_format:H:i'],
            'kilometros' => ['required', 'numeric', 'between:0,9999.99'],
            'recorrido' => ['required', 'string', 'max:150'],
            'pulso_medio' => ['nullable', 'integer', 'min:0', 'max:300'],
            'pulso_max' => ['nullable', 'integer', 'min:0', 'max:300'],
            'potencia_media' => ['nullable', 'integer', 'min:0'],
            'potencia_normalizada' => ['required', 'integer', 'min:0'],
            'velocidad_media' => ['required', 'numeric', 'between:0,999.99'],
            'puntos_estres_tss' => ['nullable', 'numeric', 'between:0,9999.99'],
            'factor_intensidad_if' => ['nullable', 'numeric', 'between:0,9.999'],
            'ascenso_metros' => ['nullable', 'integer', 'min:0'],
            'comentario' => ['nullable', 'string', 'max:255'],
        ]);

        $sesion = DB::table('sesion_entrenamiento')->where('id', (int) $validated['id_sesion'])->first();
        if (!$sesion) {
            abort(404);
        }

        DB::table('entrenamiento')->insert([
            'id_ciclista' => (int) auth()->id(),
            'id_bicicleta' => (int) $validated['id_bicicleta'],
            'id_sesion' => (int) $validated['id_sesion'],
            'fecha' => $validated['fecha'],
            'duracion' => $validated['duracion'] . ':00',
            'kilometros' => $validated['kilometros'],
            'recorrido' => $validated['recorrido'],
            'pulso_medio' => $validated['pulso_medio'] ?? null,
            'pulso_max' => $validated['pulso_max'] ?? null,
            'potencia_media' => $validated['potencia_media'] ?? null,
            'potencia_normalizada' => $validated['potencia_normalizada'],
            'velocidad_media' => $validated['velocidad_media'],
            'puntos_estres_tss' => $validated['puntos_estres_tss'] ?? null,
            'factor_intensidad_if' => $validated['factor_intensidad_if'] ?? null,
            'ascenso_metros' => $validated['ascenso_metros'] ?? null,
            'comentario' => $validated['comentario'] ?? null,
        ]);

        return redirect('/resultado/' . $validated['id_sesion'])
            ->with('status', 'Resultado de entrenamiento registrado correctamente.');
    }

    public function show($id)
    {
        $sesion = DB::table('sesion_entrenamiento as se')
            ->join('plan_entrenamiento as pe', 'pe.id', '=', 'se.id_plan')
            ->select(
                'se.id',
                'se.fecha',
                'se.nombre',
                'se.descripcion',
                'se.completada',
                'pe.id as plan_id',
                'pe.nombre as plan_nombre'
            )
            ->where('se.id', (int) $id)
            ->first();

        if (!$sesion) {
            abort(404);
        }

        $bicicletas = DB::table('bicicleta')
            ->select('id', 'nombre', 'tipo')
            ->orderBy('nombre')
            ->get();

        $resultados = DB::table('entrenamiento as e')
            ->join('bicicleta as b', 'b.id', '=', 'e.id_bicicleta')
            ->select(
                'e.id',
                'e.fecha',
                'e.duracion',
                'e.kilometros',
                'e.recorrido',
                'e.pulso_medio',
                'e.pulso_max',
                'e.potencia_media',
                'e.potencia_normalizada',
                'e.velocidad_media',
                'e.puntos_estres_tss',
                'e.factor_intensidad_if',
                'e.ascenso_metros',
                'e.comentario',
                'b.nombre as bicicleta_nombre',
                'b.tipo as bicicleta_tipo'
            )
            ->where('e.id_sesion', (int) $id)
            ->where('e.id_ciclista', (int) auth()->id())
            ->orderBy('e.fecha', 'desc')
            ->orderBy('e.id', 'desc')
            ->get();

        return view('resultado.show', [
            'sesion' => $sesion,
            'bicicletas' => $bicicletas,
            'resultados' => $resultados,
        ]);
    }
}
