@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Resultados de la sesion #{{ $sesion->id }}</span>
                    <a href="/sesion" style="text-decoration: underline; color: #0b6b56;">Volver a sesiones</a>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Plan</dt>
                        <dd class="col-sm-9">#{{ $sesion->plan_id }} - {{ $sesion->plan_nombre }}</dd>

                        <dt class="col-sm-3">Fecha sesion</dt>
                        <dd class="col-sm-9">{{ $sesion->fecha }}</dd>

                        <dt class="col-sm-3">Nombre sesion</dt>
                        <dd class="col-sm-9">{{ $sesion->nombre ?: '-' }}</dd>

                        <dt class="col-sm-3">Descripcion</dt>
                        <dd class="col-sm-9">{{ $sesion->descripcion ?: '-' }}</dd>
                    </dl>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Registrar resultado de entrenamiento</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Revisa los campos del formulario.
                        </div>
                    @endif

                    @if ($bicicletas->isEmpty())
                        <div class="alert alert-warning mb-0" role="alert">
                            No hay bicicletas registradas para asociar el resultado.
                        </div>
                    @else
                        <form method="POST" action="/resultado/crear">
                            @csrf
                            <input type="hidden" name="id_sesion" value="{{ $sesion->id }}">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fecha">Fecha</label>
                                    <input id="fecha" name="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $sesion->fecha) }}" required>
                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duracion">Duracion</label>
                                    <input id="duracion" name="duracion" type="time" step="60" class="form-control @error('duracion') is-invalid @enderror" value="{{ old('duracion') }}" required>
                                    @error('duracion')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="id_bicicleta">Bicicleta</label>
                                    <select id="id_bicicleta" name="id_bicicleta" class="form-control @error('id_bicicleta') is-invalid @enderror" required>
                                        <option value="">Selecciona una bicicleta...</option>
                                        @foreach ($bicicletas as $bicicleta)
                                            <option value="{{ $bicicleta->id }}" {{ (string) old('id_bicicleta') === (string) $bicicleta->id ? 'selected' : '' }}>
                                                #{{ $bicicleta->id }} - {{ $bicicleta->nombre }} ({{ $bicicleta->tipo }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_bicicleta')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kilometros">Kilometros</label>
                                    <input id="kilometros" name="kilometros" type="number" min="0" step="0.01" class="form-control @error('kilometros') is-invalid @enderror" value="{{ old('kilometros') }}" required>
                                    @error('kilometros')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="velocidad_media">Velocidad media</label>
                                    <input id="velocidad_media" name="velocidad_media" type="number" min="0" step="0.01" class="form-control @error('velocidad_media') is-invalid @enderror" value="{{ old('velocidad_media') }}" required>
                                    @error('velocidad_media')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="recorrido">Recorrido</label>
                                    <input id="recorrido" name="recorrido" type="text" maxlength="150" class="form-control @error('recorrido') is-invalid @enderror" value="{{ old('recorrido') }}" required>
                                    @error('recorrido')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="pulso_medio">Pulso medio</label>
                                    <input id="pulso_medio" name="pulso_medio" type="number" min="0" class="form-control @error('pulso_medio') is-invalid @enderror" value="{{ old('pulso_medio') }}">
                                    @error('pulso_medio')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="pulso_max">Pulso maximo</label>
                                    <input id="pulso_max" name="pulso_max" type="number" min="0" class="form-control @error('pulso_max') is-invalid @enderror" value="{{ old('pulso_max') }}">
                                    @error('pulso_max')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="potencia_media">Potencia media</label>
                                    <input id="potencia_media" name="potencia_media" type="number" min="0" class="form-control @error('potencia_media') is-invalid @enderror" value="{{ old('potencia_media') }}">
                                    @error('potencia_media')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="potencia_normalizada">Potencia normalizada</label>
                                    <input id="potencia_normalizada" name="potencia_normalizada" type="number" min="0" class="form-control @error('potencia_normalizada') is-invalid @enderror" value="{{ old('potencia_normalizada') }}" required>
                                    @error('potencia_normalizada')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="puntos_estres_tss">TSS</label>
                                    <input id="puntos_estres_tss" name="puntos_estres_tss" type="number" min="0" step="0.01" class="form-control @error('puntos_estres_tss') is-invalid @enderror" value="{{ old('puntos_estres_tss') }}">
                                    @error('puntos_estres_tss')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="factor_intensidad_if">IF</label>
                                    <input id="factor_intensidad_if" name="factor_intensidad_if" type="number" min="0" step="0.001" class="form-control @error('factor_intensidad_if') is-invalid @enderror" value="{{ old('factor_intensidad_if') }}">
                                    @error('factor_intensidad_if')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="ascenso_metros">Ascenso (m)</label>
                                    <input id="ascenso_metros" name="ascenso_metros" type="number" min="0" class="form-control @error('ascenso_metros') is-invalid @enderror" value="{{ old('ascenso_metros') }}">
                                    @error('ascenso_metros')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="comentario">Comentario</label>
                                <textarea id="comentario" name="comentario" rows="2" maxlength="255" class="form-control @error('comentario') is-invalid @enderror">{{ old('comentario') }}</textarea>
                                @error('comentario')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar resultado</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">Resultados registrados de esta sesion</div>
                <div class="card-body">
                    @if ($resultados->isEmpty())
                        <p class="mb-0 text-muted">Todavia no hay resultados para esta sesion.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Bicicleta</th>
                                        <th>Duracion</th>
                                        <th>Km</th>
                                        <th>Vel. media</th>
                                        <th>NP</th>
                                        <th>TSS</th>
                                        <th>IF</th>
                                        <th>Comentario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultados as $resultado)
                                        <tr>
                                            <td>{{ $resultado->id }}</td>
                                            <td>{{ $resultado->fecha }}</td>
                                            <td>{{ $resultado->bicicleta_nombre }} ({{ $resultado->bicicleta_tipo }})</td>
                                            <td>{{ $resultado->duracion }}</td>
                                            <td>{{ $resultado->kilometros }}</td>
                                            <td>{{ $resultado->velocidad_media }}</td>
                                            <td>{{ $resultado->potencia_normalizada }}</td>
                                            <td>{{ $resultado->puntos_estres_tss ?? '-' }}</td>
                                            <td>{{ $resultado->factor_intensidad_if ?? '-' }}</td>
                                            <td>{{ $resultado->comentario ?: '-' }}</td>
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
