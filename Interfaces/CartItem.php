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
 * @date 26/01/17 15:47
 */

namespace Modules\Cart\Interfaces;


use Serializable;

interface CartItem extends Serializable
{
    /**
     * Single item price
     * @param $quantity
     * @param $data
     * @return mixed
     */
    public function getCartPrice($quantity, $data);
}