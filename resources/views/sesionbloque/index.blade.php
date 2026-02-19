@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">Crear sesion de bloque</div>
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

                    @if ($sesiones->isEmpty() || $bloques->isEmpty())
                        <div class="alert alert-warning mb-0" role="alert">
                            Necesitas al menos una sesion y un bloque para crear una sesion de bloque.
                        </div>
                    @else
                        <form method="POST" action="/sesionbloque/crear">
                            @csrf

                            <div class="form-group">
                                <label for="id_sesion_entrenamiento">Sesion de entrenamiento</label>
                                <select id="id_sesion_entrenamiento" name="id_sesion_entrenamiento" class="form-control @error('id_sesion_entrenamiento') is-invalid @enderror" required>
                                    <option value="">Selecciona una sesion...</option>
                                    @foreach ($sesiones as $sesion)
                                        <option value="{{ $sesion->id }}" {{ (string) old('id_sesion_entrenamiento') === (string) $sesion->id ? 'selected' : '' }}>
                                            #{{ $sesion->id }} - {{ $sesion->nombre ?: 'Sesion sin nombre' }} ({{ $sesion->fecha }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_sesion_entrenamiento')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_bloque_entrenamiento">Bloque de entrenamiento</label>
                                <select id="id_bloque_entrenamiento" name="id_bloque_entrenamiento" class="form-control @error('id_bloque_entrenamiento') is-invalid @enderror" required>
                                    <option value="">Selecciona un bloque...</option>
                                    @foreach ($bloques as $bloque)
                                        <option value="{{ $bloque->id }}" {{ (string) old('id_bloque_entrenamiento') === (string) $bloque->id ? 'selected' : '' }}>
                                            #{{ $bloque->id }} - {{ $bloque->nombre }} ({{ $bloque->tipo }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_bloque_entrenamiento')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="orden">Orden</label>
                                    <input id="orden" name="orden" type="number" min="1" class="form-control @error('orden') is-invalid @enderror" value="{{ old('orden', 1) }}" required>
                                    @error('orden')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="repeticiones">Repeticiones</label>
                                    <input id="repeticiones" name="repeticiones" type="number" min="1" class="form-control @error('repeticiones') is-invalid @enderror" value="{{ old('repeticiones', 1) }}">
                                    @error('repeticiones')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar sesion de bloque</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">Sesiones de bloque registradas</div>
                <div class="card-body">
                    @if ($sesionBloques->isEmpty())
                        <p class="mb-0 text-muted">Todavia no hay sesiones de bloque creadas.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Sesion</th>
                                        <th>Bloque</th>
                                        <th>Orden</th>
                                        <th>Repeticiones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sesionBloques as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>#{{ $item->id_sesion_entrenamiento }} - {{ $item->sesion_nombre ?: 'Sin nombre' }} ({{ $item->sesion_fecha }})</td>
                                            <td>#{{ $item->id_bloque_entrenamiento }} - {{ $item->bloque_nombre }} ({{ $item->bloque_tipo }})</td>
                                            <td>{{ $item->orden }}</td>
                                            <td>{{ $item->repeticiones }}</td>
                                            <td style="text-align: right;">
                                                <form method="POST" action="/sesionbloque/{{ $item->id }}" style="display: inline-block; margin: 0;" onsubmit="return confirm('Seguro que deseas eliminar esta sesion de bloque?');">
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
