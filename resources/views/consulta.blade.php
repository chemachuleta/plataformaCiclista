@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-intro">
                <h4 class="mb-1">{{ $selected['label'] ?? 'Consulta' }}</h4>
                <p>Usa el menu para navegar entre los modulos de entrenamiento disponibles.</p>
            </div>

            <div class="card mb-4">
                <div class="card-header">Menu principal</div>
                <div class="card-body">
                    <ul class="menu-tree">
                        @foreach ($menus as $menu)
                            <li>
                                @if (!empty($menu['children']) && is_array($menu['children']))
                                    <span class="font-weight-bold menu-parent">
                                        {{ $menu['label'] ?? 'Menu' }}
                                    </span>
                                @else
                                    <a class="font-weight-bold" href="{{ $menu['url'] ?? '#' }}">
                                        {{ $menu['label'] ?? 'Menu' }}
                                    </a>
                                @endif

                                @if (!empty($menu['children']) && is_array($menu['children']))
                                    <ul class="menu-child">
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
</div>
@endsection
