<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menus = $this->loadMenus();

        return view('home', ['menus' => $menus]);
    }

    public function consulta($key)
    {
        $menus = $this->loadMenus();
        $selected = $this->findMenuByKey($menus, $key);

        if (!$selected) {
            abort(404);
        }

        return view('consulta', [
            'menus' => $menus,
            'selected' => $selected,
        ]);
    }

    private function loadMenus()
    {
        $menuPath = resource_path('data/menus.json');
        if (!file_exists($menuPath)) {
            return [];
        }

        $decoded = json_decode(file_get_contents($menuPath), true);
        if (!is_array($decoded)) {
            return [];
        }

        return $this->addUrls($decoded);
    }

    private function addUrls(array $menus)
    {
        foreach ($menus as &$menu) {
            $key = $menu['key'] ?? null;
            $menu['url'] = $this->resolveUrlByKey($key);

            if (!empty($menu['children']) && is_array($menu['children'])) {
                foreach ($menu['children'] as &$child) {
                    $childKey = $child['key'] ?? null;
                    $child['url'] = $this->resolveUrlByKey($childKey);
                }
                unset($child);
            }
        }
        unset($menu);

        return $menus;
    }

    private function resolveUrlByKey($key)
    {
        if (empty($key) || $key === 'inicio') {
            return '/';
        }

        $directRoutes = [
            'entrenamientos' => '/home',
            'bloques' => '/bloque',
            'sesion-bloques' => '/sesionbloque',
            'sesiones' => '/sesion',
            'planes' => '/plan',
            'ciclistas' => '/home',
        ];

        return $directRoutes[$key] ?? route('consulta', ['key' => $key]);
    }

    private function findMenuByKey(array $menus, $key)
    {
        foreach ($menus as $menu) {
            if (($menu['key'] ?? null) === $key) {
                return ['key' => $key, 'label' => $menu['label'] ?? $key];
            }

            if (!empty($menu['children']) && is_array($menu['children'])) {
                foreach ($menu['children'] as $child) {
                    if (($child['key'] ?? null) === $key) {
                        return ['key' => $key, 'label' => $child['label'] ?? $key];
                    }
                }
            }
        }

        return null;
    }
}
