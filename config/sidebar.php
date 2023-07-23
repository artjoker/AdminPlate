<?php

return [
    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'menu' => [
        new \App\Infrastructure\Menu\Entity\MenuItem(
            icon: 'fa fa-th-large',
            title: 'dashboard',
            url: '/dashboard'
        ),
        new \App\Infrastructure\Menu\Entity\MenuItem(
            icon: 'fa fa-user',
            title: 'clients',
            url: '/clients'
        ),
        new \App\Infrastructure\Menu\Entity\MenuItem(
            icon: 'fa fa-users',
            title: 'users',
            caret: true,
            sub_menu: [
                new \App\Infrastructure\Menu\Entity\MenuItem(
                    title: 'user_managment',
                    url: '/users'
                ),
                new \App\Infrastructure\Menu\Entity\MenuItem(
                    title: 'roles',
                    url: '/roles'
                ),
                new \App\Infrastructure\Menu\Entity\MenuItem(
                    title: 'permissions',
                    url: '/permissions'
                ),
            ]
        ),
    ],
];
