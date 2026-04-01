<?php

namespace App\Helpers;

class MenuHelper
{
    public static function getMainNavItems()
    {
        return [
            [
                'icon' => 'dashboard',
                'name' => 'Dashboard',
                'path' => '/dashboard',
                'roles' => ['admin', 'customer', 'manager']
            ],
            [
                'icon' => 'customers',
                'name' => 'Customers',
                'path' => '/customers',
                'roles' => ['admin']
            ],
            [
                'icon' => 'managers',
                'name' => 'Managers',
                'path' => '/managers',
                'roles' => ['admin']
            ],
            [
                'icon' => 'invoices',
                'name' => 'Invoices',
                'path' => '/invoices',
                'roles' => ['admin', 'manager']
            ],
            [
                'icon' => 'plans',
                'name' => 'Membership Plans',
                'path' => '/membership-plans',
                'roles' => ['admin']
            ],
            [
                'icon' => 'pins',
                'name' => 'Pins Generator',
                'path' => '/pins',
                'roles' => ['admin']
            ],
            [
                'icon' => 'withdraw',
                'name' => 'Withdraw',
                'path' => '/withdraw',
                'roles' => ['admin', 'customer']
            ],
        ];
    }
    public static function getMenuGroups()
    {
        return [
            [
                'title' => 'Menu',
                'items' => self::getMainNavItems()
            ]
        ];
    }

    public static function isActive($path)
    {
        return request()->is(ltrim($path, '/'));
    }

    public static function getIconSvg($iconName)
    {
        $icons = [
            'customers' => '<div class="w-[24px] h-[24px] flex items-center justify-center text-lg"><i class="fa-solid fa-user-group"></i></div>',

            'managers' => '<div class="w-[24px] h-[24px] flex items-center justify-center text-lg"><i class="fa-solid fa-user-tie"></i></div>',

            'invoices' => '<div class="w-[24px] h-[24px] flex items-center justify-center text-lg"><i class="fa-solid fa-file-lines"></i></div>',

            'plans' => '<div class="w-[24px] h-[24px] flex items-center justify-center text-lg"><i class="fa-solid fa-clipboard-list"></i></div>',

            'pins' => '<div class="w-[24px] h-[24px] flex items-center justify-center text-lg"><i class="fa-solid fa-unlock-keyhole"></i></div>',

            'dashboard' => '<div class="w-[24px] h-[24px] flex items-center justify-center text-lg"><i class="fa-solid fa-chart-line"></i></div>',

            'withdraw' => '<div class="w-[24px] h-[24px] flex items-center justify-center text-lg"><i class="fa-solid fa-wallet"></i></div>',
        ];

        return $icons[$iconName] ?? '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="currentColor"/></svg>';
    }

    public static function getProfileMenuItems()
    {
        return [
            [
                'icon' => '<i class="fa-regular fa-user"></i>',
                'text' => 'Profile',
                'path' => '/profile',
            ]
        ];
    }
}
