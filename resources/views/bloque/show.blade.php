@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Detalle de bloque #{{ $bloque->id }}</span>
                    <a href="/bloque" class="btn btn-sm btn-secondary">Volver</a>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Nombre</dt>
                        <dd class="col-sm-8">{{ $bloque->nombre }}</dd>

                        <dt class="col-sm-4">Descripcion</dt>
                        <dd class="col-sm-8">{{ $bloque->descripcion ?: '-' }}</dd>

                        <dt class="col-sm-4">Tipo</dt>
                        <dd class="col-sm-8">{{ $bloque->tipo }}</dd>

                        <dt class="col-sm-4">Duracion estimada</dt>
                        <dd class="col-sm-8">{{ $bloque->duracion_estimada ?: '-' }}</dd>

                        <dt class="col-sm-4">Potencia % minima</dt>
                        <dd class="col-sm-8">{{ $bloque->potencia_pct_min ?? '-' }}</dd>

                        <dt class="col-sm-4">Potencia % maxima</dt>
                        <dd class="col-sm-8">{{ $bloque->potencia_pct_max ?? '-' }}</dd>

                        <dt class="col-sm-4">Pulso % maximo</dt>
                        <dd class="col-sm-8">{{ $bloque->pulso_pct_max ?? '-' }}</dd>

                        <dt class="col-sm-4">Pulso reserva %</dt>
                        <dd class="col-sm-8">{{ $bloque->pulso_reserva_pct ?? '-' }}</dd>

                        <dt class="col-sm-4">Comentario</dt>
                        <dd class="col-sm-8">{{ $bloque->comentario ?: '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
