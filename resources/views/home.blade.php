@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">Menu principal</div>
                <div class="card-body">
                    <ul class="menu-tree">
                        @forelse ($menus as $menu)
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
                        @empty
                            <li class="text-muted">No hay menus configurados en resources/data/menus.json</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
