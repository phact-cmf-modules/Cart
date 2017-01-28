<?php

return [
    [
        'route' => '',
        'target' => [\Modules\Cart\Controllers\CartController::class, 'index'],
        'name' => 'index'
    ],
    [
        'route' => '/add',
        'target' => [\Modules\Cart\Controllers\CartController::class, 'add'],
        'name' => 'add'
    ],
    [
        'route' => '/remove',
        'target' => [\Modules\Cart\Controllers\CartController::class, 'remove'],
        'name' => 'remove'
    ],
    [
        'route' => '/inc',
        'target' => [\Modules\Cart\Controllers\CartController::class, 'inc'],
        'name' => 'inc'
    ],
    [
        'route' => '/dec',
        'target' => [\Modules\Cart\Controllers\CartController::class, 'dec'],
        'name' => 'dec'
    ],
    [
        'route' => '/quantity',
        'target' => [\Modules\Cart\Controllers\CartController::class, 'quantity'],
        'name' => 'quantity'
    ],
];