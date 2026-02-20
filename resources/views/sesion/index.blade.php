@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">Crear sesion de entrenamiento</div>
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

                    @if ($planes->isEmpty())
                        <div class="alert alert-warning mb-0" role="alert">
                            Necesitas al menos un plan de entrenamiento para crear sesiones.
                        </div>
                    @else
                        <form method="POST" action="/sesion/crear">
                            @csrf

                            <div class="form-group">
                                <label for="id_plan">Plan de entrenamiento</label>
                                <select id="id_plan" name="id_plan" class="form-control @error('id_plan') is-invalid @enderror" required>
                                    <option value="">Selecciona un plan...</option>
                                    @foreach ($planes as $plan)
                                        <option value="{{ $plan->id }}" {{ (string) old('id_plan') === (string) $plan->id ? 'selected' : '' }}>
                                            #{{ $plan->id }} - {{ $plan->nombre }} ({{ $plan->fecha_inicio }} a {{ $plan->fecha_fin }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_plan')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input id="fecha" name="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha') }}" required>
                                @error('fecha')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" maxlength="100">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea id="descripcion" name="descripcion" rows="2" class="form-control @error('descripcion') is-invalid @enderror" maxlength="255">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group form-check">
                                <input id="completada" name="completada" type="checkbox" value="1" class="form-check-input" {{ old('completada') ? 'checked' : '' }}>
                                <label for="completada" class="form-check-label">Marcar como completada</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar sesion</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">Sesiones registradas</div>
                <div class="card-body">
                    @if ($sesiones->isEmpty())
                        <p class="mb-0 text-muted">Todavia no hay sesiones creadas.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Plan</th>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Completada</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sesiones as $sesion)
                                        <tr>
                                            <td>{{ $sesion->id }}</td>
                                            <td>#{{ $sesion->id_plan }} - {{ $sesion->plan_nombre }}</td>
                                            <td>{{ $sesion->fecha }}</td>
                                            <td>{{ $sesion->nombre ?: '-' }}</td>
                                            <td>{{ $sesion->completada ? 'Si' : 'No' }}</td>
                                            <td style="text-align: right;">
                                                <form method="POST" action="/sesion/{{ $sesion->id }}" style="display: inline-block; margin: 0;" onsubmit="return confirm('Seguro que deseas eliminar esta sesion de entrenamiento?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                                                </form>
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
