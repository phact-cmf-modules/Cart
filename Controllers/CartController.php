<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @company HashStudio
 * @site http://hashstudio.ru
 * @date 26/01/17 15:17
 */

namespace Modules\Cart\Controllers;

use Modules\Cart\Components\Cart;
use Phact\Controller\Controller;
use Phact\Main\Phact;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        echo $this->render('cart/index.tpl', [
            'cart' => $cart
        ]);
    }

    public function add()
    {
        $cart = $this->getCart();
        $id = $this->request->post->get('id');
        $item = null;
        if ($id && ($itemClass = $cart->defaultItemClass)) {
            $item = $itemClass::objects()->filter([
                'pk' => $id
            ])->get();
        }
        $response = [
            'status' => 'success',
            'message' => 'Товар добавлен в корзину'
        ];
        if ($item) {
            $this->getCart()->add($item);
        } else {
            $response['status'] = 'error';
            $response['message'] = 'При добавлении товара в корзину произошла ошибка';
        }
        $this->jsonResponse($response);
    }

    public function remove()
    {
        $position = $this->request->post->get('position');
        $this->getCart()->removeItem($position);
        $this->jsonResponse([
            'status' => 'success'
        ]);
    }

    public function inc()
    {
        $position = $this->request->post->get('position');
        $this->getCart()->incQuantity($position);
        $this->jsonResponse([
            'status' => 'success'
        ]);
    }

    public function dec()
    {
        $position = $this->request->post->get('position');
        $this->getCart()->decQuantity($position);
        $this->jsonResponse([
            'status' => 'success'
        ]);
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return Phact::app()->cart;
    }
}