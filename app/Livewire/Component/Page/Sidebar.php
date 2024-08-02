<?php

namespace App\Livewire\Component\Page;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public $menuUsers = [];
    protected $menus = [
        [
            'title' => 'Dashboard',
            'menus' => [
                [
                    'name' => 'Dashboard',
                    'url' => '/dashboard',
                    'route' => 'dashboard.index',
                    'icon' => 'bx bx-home-circle',
                    'roles' => 'Administrator'
                ],
            ]
        ],
        [
            'title' => 'Master Data',
            'menus' => [
                [
                    'name' => 'Merchant',
                    'url' => '/merchant',
                    'route' => 'merchant.index',
                    'icon' => 'bx bx-store-alt',
                    'roles' => 'Administrator',
                ],
                [
                    'name' => 'Customer',
                    'url' => '/customer',
                    'route' => 'customer.index',
                    'icon' => 'bx bx-building-house',
                    'roles' => 'Administrator',
                ],
                [
                    'name' => 'Product',
                    'url' => '/product',
                    'route' => 'product.index',
                    'icon' => 'bx bxl-shopify',
                    'roles' => 'Administrator'
                ],
            ]
        ],
        [
            'title' => 'Apps',
            'menus' => [
                [
                    'name' => 'Product',
                    'url' => '/product',
                    'route' => 'product.index',
                    'icon' => 'bx bxl-shopify',
                    'roles' => 'Merchant'
                ],
                [
                    'name' => 'Catering',
                    'url' => '/catering',
                    'route' => 'catering.index',
                    'icon' => 'bx bx-food-menu',
                    'roles' => 'Customer'
                ],
            ],
        ],
        [
            'title' => 'Transaksi',
            'menus' => [
                [
                    'name' => 'Order',
                    'url' => '/order',
                    'route' => 'order.index',
                    'icon' => 'bx bx-shopping-bag',
                    'roles' => 'Administrator'
                ],
                [
                    'name' => 'Order',
                    'url' => '/order',
                    'route' => 'order.index',
                    'icon' => 'bx bx-shopping-bag',
                    'roles' => 'Customer'
                ],
                [
                    'name' => 'Order',
                    'url' => '/order',
                    'route' => 'order.index',
                    'icon' => 'bx bx-shopping-bag',
                    'roles' => 'Merchant'
                ],
            ]
        ],
    ];

    public function filterMenus()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        $this->menuUsers = [];

        foreach ($this->menus as $menu) {
            $filteredMenus = [];

            foreach ($menu['menus'] as $subMenu) {
                $hasroles = $user->hasRole($subMenu['roles']);

                if (isset($subMenu['subMenus'])) {
                    $filteredSubMenus = [];
                    foreach ($subMenu['subMenus'] as $subSubMenu) {
                        if ($user->hasRole($subSubMenu['roles'])) {
                            $filteredSubMenus[] = [
                                'name' => $subSubMenu['name'],
                                'url' => $subSubMenu['url'],
                                'route' => $subSubMenu['route'],
                                'icon' => $subSubMenu['icon'],
                                'roles' => $subSubMenu['roles']
                            ];
                        }
                    }
                    if (!empty($filteredSubMenus)) {
                        $filteredMenus[] = [
                            'name' => $subMenu['name'],
                            'icon' => $subMenu['icon'],
                            'roles' => $subMenu['roles'],
                            'subMenus' => $filteredSubMenus
                        ];
                    }
                } elseif ($hasroles) {
                    $filteredMenus[] = [
                        'name' => $subMenu['name'],
                        'url' => $subMenu['url'],
                        'route' => $subMenu['route'],
                        'icon' => $subMenu['icon'],
                        'roles' => $subMenu['roles']
                    ];
                }
            }

            if (!empty($filteredMenus)) {
                $this->menuUsers[] = ['title' => $menu['title'], 'menus' => $filteredMenus];
            }
        }
    }

    public function mount()
    {
        $this->filterMenus();
    }

    public function render()
    {
        return view('livewire.component.page.sidebar');
    }
}
