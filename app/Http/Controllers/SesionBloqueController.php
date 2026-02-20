<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SesionBloqueController extends Controller
{
    public function index()
    {
        return view('sesionbloque.index', $this->buildViewData());
    }

    public function edit($id)
    {
        $editSesionBloque = DB::table('sesion_bloque')->where('id', (int) $id)->first();
        if (!$editSesionBloque) {
            abort(404);
        }

        return view('sesionbloque.index', array_merge(
            $this->buildViewData(),
            ['editSesionBloque' => $editSesionBloque]
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_sesion_entrenamiento' => ['required', 'integer', 'exists:sesion_entrenamiento,id'],
            'id_bloque_entrenamiento' => ['required', 'integer', 'exists:bloque_entrenamiento,id'],
            'orden' => ['required', 'integer', 'min:1'],
            'repeticiones' => ['nullable', 'integer', 'min:1'],
        ]);

        $validated['repeticiones'] = $validated['repeticiones'] ?? 1;

        DB::table('sesion_bloque')->insert($validated);

        return redirect('/sesionbloque')->with('status', 'Sesion de bloque creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $sesionBloque = DB::table('sesion_bloque')->where('id', (int) $id)->first();
        if (!$sesionBloque) {
            abort(404);
        }

        $validated = $request->validate([
            'id_sesion_entrenamiento' => ['required', 'integer', 'exists:sesion_entrenamiento,id'],
            'id_bloque_entrenamiento' => ['required', 'integer', 'exists:bloque_entrenamiento,id'],
            'orden' => ['required', 'integer', 'min:1'],
            'repeticiones' => ['nullable', 'integer', 'min:1'],
        ]);

        $validated['repeticiones'] = $validated['repeticiones'] ?? 1;

        DB::table('sesion_bloque')->where('id', (int) $id)->update($validated);

        return redirect('/sesionbloque')->with('status', 'Sesion de bloque actualizada correctamente.');
    }

    public function destroy($id)
    {
        try {
            DB::table('sesion_bloque')->where('id', (int) $id)->delete();
        } catch (QueryException $e) {
            return redirect('/sesionbloque')->with('error', 'No se pudo eliminar la sesion de bloque.');
        }

        return redirect('/sesionbloque')->with('status', 'Sesion de bloque eliminada correctamente.');
    }

    private function buildViewData()
    {
        $sesiones = DB::table('sesion_entrenamiento')
            ->select('id', 'nombre', 'fecha')
            ->orderBy('fecha', 'desc')
            ->get();

        $bloques = DB::table('bloque_entrenamiento')
            ->select('id', 'nombre', 'tipo')
            ->orderBy('nombre')
            ->get();

        $sesionBloques = DB::table('sesion_bloque as sb')
            ->join('sesion_entrenamiento as se', 'se.id', '=', 'sb.id_sesion_entrenamiento')
            ->join('bloque_entrenamiento as be', 'be.id', '=', 'sb.id_bloque_entrenamiento')
            ->select(
                'sb.id',
                'sb.id_sesion_entrenamiento',
                'sb.id_bloque_entrenamiento',
                'sb.orden',
                'sb.repeticiones',
                'se.nombre as sesion_nombre',
                'se.fecha as sesion_fecha',
                'be.nombre as bloque_nombre',
                'be.tipo as bloque_tipo'
            )
            ->orderBy('sb.id', 'desc')
            ->get();

        return [
            'sesiones' => $sesiones,
            'bloques' => $bloques,
            'sesionBloques' => $sesionBloques,
        ];
    }
}
