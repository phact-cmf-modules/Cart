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
 * @date 27/01/17 08:45
 */

namespace Modules\Cart\Components;

use Modules\Cart\Contrib\Item;
use Phact\Main\Phact;

class SessionCart extends Cart
{
    public $key = "CART";

    /**
     * @return Item[]
     */
    public function getItems()
    {
        $serialized = Phact::app()->request->session->get($this->key);
        if ($serialized) {
            return unserialize($serialized);
        }
        return [];
    }

    /**
     * @param Item[] $items
     */
    public function setItems($items = [])
    {
        $serialized = serialize($items);
        Phact::app()->request->session->add($this->key, $serialized);
    }
}