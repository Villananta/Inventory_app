<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */

    public $links;
    public function __construct()
    {
        $this->links = [
            [
            'label' => 'Dashboard Analitik',
            'route' => 'home',
            'is_active' => request()->routeIs('home'),
            'icon' => 'fas fa-chart-line',
            'if_dropdown' => false,
            ],
            [
            'label' => 'Master data',
            'route' => '#',
            'is_active' => request()->routeIs('master-date.*'),
            'icon' => 'fas fa-cloud',
            'if_dropdown' => true,
            'items' => [
                [
                    'label' => 'Kategori Produk',
                    'route' => 'master-data.kategori-produk.index',
 
                ]
            ]
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
