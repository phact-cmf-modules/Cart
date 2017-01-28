# Установка


Компонент

```php
[
    'cart' => [
        'class' => \Modules\Cart\Components\SessionCart::class,
        'defaultItemClass' => \Modules\Catalog\Models\Product::class
    ]
]
```

Роуты

```php
[
    'route' => '/cart',
    'path' => 'Modules.Cart.routes',
    'namespace' => 'cart'
],
```

Интерфейс

```php
...
class Product extends Model implements CartItem
{
    ...
}
...
```

data-* аттибуты  можно посмотреть в шаблоне *cart/index.tpl*