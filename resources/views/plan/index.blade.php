@extends('layouts.app')

@section('content')
<div class="container">
    @php
        $isEdit = isset($editPlan);
    @endphp

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">
                    {{ $isEdit ? 'Editar plan de entrenamiento #'.$editPlan->id : 'Crear plan de entrenamiento' }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ $isEdit ? '/plan/'.$editPlan->id : '/plan/crear' }}">
                        @csrf
                        @if ($isEdit)
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" name="nombre" type="text" maxlength="100" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $isEdit ? $editPlan->nombre : '') }}" required>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea id="descripcion" name="descripcion" rows="2" maxlength="255" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $isEdit ? $editPlan->descripcion : '') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha_inicio">Fecha inicio</label>
                                <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio', $isEdit ? $editPlan->fecha_inicio : '') }}" required>
                                @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fecha_fin">Fecha fin</label>
                                <input id="fecha_fin" name="fecha_fin" type="date" class="form-control @error('fecha_fin') is-invalid @enderror" value="{{ old('fecha_fin', $isEdit ? $editPlan->fecha_fin : '') }}" required>
                                @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="objetivo">Objetivo</label>
                            <input id="objetivo" name="objetivo" type="text" maxlength="100" class="form-control @error('objetivo') is-invalid @enderror" value="{{ old('objetivo', $isEdit ? $editPlan->objetivo : '') }}">
                            @error('objetivo')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group form-check">
                            <input id="activo" name="activo" type="checkbox" value="1" class="form-check-input" {{ old('activo', $isEdit ? $editPlan->activo : 1) ? 'checked' : '' }}>
                            <label for="activo" class="form-check-label">Plan activo</label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Actualizar plan' : 'Guardar plan' }}
                        </button>
                        @if ($isEdit)
                            <a href="/plan" class="btn btn-link">Cancelar</a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Planes de entrenamiento</div>
                <div class="card-body">
                    @if ($planes->isEmpty())
                        <p class="mb-0 text-muted">Todavia no hay planes registrados.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Fechas</th>
                                        <th>Objetivo</th>
                                        <th>Activo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($planes as $plan)
                                        <tr>
                                            <td>{{ $plan->id }}</td>
                                            <td>{{ $plan->nombre }}</td>
                                            <td>{{ $plan->fecha_inicio }} a {{ $plan->fecha_fin }}</td>
                                            <td>{{ $plan->objetivo ?: '-' }}</td>
                                            <td>{{ $plan->activo ? 'Si' : 'No' }}</td>
                                            <td style="text-align: right;">
                                                <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 8px; white-space: nowrap;">
                                                    <a href="/plan/{{ $plan->id }}/editar" style="text-decoration: underline; color: #0b6b56;">
                                                        Editar
                                                    </a>
                                                    <form method="POST" action="/plan/{{ $plan->id }}" style="display: inline-block; margin: 0;" onsubmit="return confirm('Seguro que deseas eliminar este plan de entrenamiento?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
