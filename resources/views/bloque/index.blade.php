@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">Crear bloque de entrenamiento</div>
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

                    <form method="POST" action="/bloque/crear">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input id="descripcion" name="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion') }}">
                            @error('descripcion')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select id="tipo" name="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                                <option value="">Selecciona tipo...</option>
                                <option value="rodaje" {{ old('tipo') === 'rodaje' ? 'selected' : '' }}>Rodaje</option>
                                <option value="intervalos" {{ old('tipo') === 'intervalos' ? 'selected' : '' }}>Intervalos</option>
                                <option value="fuerza" {{ old('tipo') === 'fuerza' ? 'selected' : '' }}>Fuerza</option>
                                <option value="recuperacion" {{ old('tipo') === 'recuperacion' ? 'selected' : '' }}>Recuperacion</option>
                                <option value="test" {{ old('tipo') === 'test' ? 'selected' : '' }}>Test</option>
                            </select>
                            @error('tipo')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="duracion_estimada">Duracion estimada</label>
                                <input id="duracion_estimada" name="duracion_estimada" type="time" class="form-control @error('duracion_estimada') is-invalid @enderror" value="{{ old('duracion_estimada') }}">
                                @error('duracion_estimada')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="potencia_pct_min">Potencia % min</label>
                                <input id="potencia_pct_min" name="potencia_pct_min" type="number" min="0" step="0.01" class="form-control @error('potencia_pct_min') is-invalid @enderror" value="{{ old('potencia_pct_min') }}">
                                @error('potencia_pct_min')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="potencia_pct_max">Potencia % max</label>
                                <input id="potencia_pct_max" name="potencia_pct_max" type="number" min="0" step="0.01" class="form-control @error('potencia_pct_max') is-invalid @enderror" value="{{ old('potencia_pct_max') }}">
                                @error('potencia_pct_max')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pulso_pct_max">Pulso % max</label>
                                <input id="pulso_pct_max" name="pulso_pct_max" type="number" min="0" step="0.01" class="form-control @error('pulso_pct_max') is-invalid @enderror" value="{{ old('pulso_pct_max') }}">
                                @error('pulso_pct_max')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pulso_reserva_pct">Pulso reserva %</label>
                                <input id="pulso_reserva_pct" name="pulso_reserva_pct" type="number" min="0" step="0.01" class="form-control @error('pulso_reserva_pct') is-invalid @enderror" value="{{ old('pulso_reserva_pct') }}">
                                @error('pulso_reserva_pct')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comentario">Comentario</label>
                            <textarea id="comentario" name="comentario" rows="2" class="form-control @error('comentario') is-invalid @enderror">{{ old('comentario') }}</textarea>
                            @error('comentario')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar bloque</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Bloques registrados</div>
                <div class="card-body">
                    @if ($bloques->isEmpty())
                        <p class="mb-0 text-muted">Todavia no hay bloques creados.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Duracion</th>
                                        <th>Potencia %</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bloques as $bloque)
                                        <tr>
                                            <td>{{ $bloque->id }}</td>
                                            <td>{{ $bloque->nombre }}</td>
                                            <td>{{ $bloque->tipo }}</td>
                                            <td>{{ $bloque->duracion_estimada ?: '-' }}</td>
                                            <td>
                                                {{ $bloque->potencia_pct_min ?? '-' }} - {{ $bloque->potencia_pct_max ?? '-' }}
                                            </td>
                                            <td style="text-align: right;">
                                                <div style="display: inline-flex; align-items: center; justify-content: flex-end; gap: 8px; white-space: nowrap;">
                                                    <a href="/bloque/{{ $bloque->id }}" style="text-decoration: underline; color: #0b6b56;">
                                                        Ver detalle
                                                    </a>
                                                <form method="POST" action="/bloque/{{ $bloque->id }}/eliminar" style="display: inline-block; margin: 0;" onsubmit="return confirm('Seguro que deseas eliminar este bloque?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">
                                                        Eliminar
                                                    </button>
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
