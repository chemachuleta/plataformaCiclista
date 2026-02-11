@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">Menu principal</div>
                <div class="card-body">
                    <ul class="nav flex-column">
                        @foreach ($menus as $menu)
                            <li class="mb-2">
                                <a class="font-weight-bold" href="{{ $menu['url'] ?? '#' }}">
                                    {{ $menu['label'] ?? 'Menu' }}
                                </a>

                                @if (!empty($menu['children']) && is_array($menu['children']))
                                    <ul class="mb-0 mt-1">
                                        @foreach ($menu['children'] as $child)
                                            <li>
                                                <a href="{{ $child['url'] ?? '#' }}">{{ $child['label'] ?? 'Submenu' }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Consulta</div>
                <div class="card-body">
                    <h4>{{ $selected['label'] }}</h4>
                    <p class="mb-0">Pagina de consulta del elemento seleccionado.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
