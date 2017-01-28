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
 * @date 26/01/17 15:32
 */

namespace Modules\Cart\Components;


use Modules\Cart\Contrib\Item;
use Modules\Cart\Interfaces\CartItem;

abstract class Cart
{
    /**
     * Default class of item(product)
     * @var
     */
    public $defaultItemClass;

    /**
     * Total sum
     *
     * @return mixed
     */
    public function getSum()
    {
        return array_reduce($this->getItems(), function($carry, Item $item){
            $carry += $item->getSum();
            return $carry;
        });
    }

    /**
     * Sum quantities of all items
     *
     * @return mixed
     */
    public function getQuantity()
    {
        return array_reduce($this->getItems(), function($carry, Item $item){
            $carry += $item->quantity;
            return $carry;
        });
    }

    /**
     * @param CartItem $object
     * @param int $quantity
     * @param array $data
     */
    public function add($object, $quantity = 1, $data = [])
    {
        $item = new Item($object, $quantity, $data);
        $key = $item->getUniqueKey();
        $items = $this->getItems();
        $append = true;
        foreach ($items as $position => $cartItem) {
            if ($key == $cartItem->getUniqueKey()) {
                $cartItem->quantity += $quantity;
                $items[$position] = $cartItem;
                $append = false;
                break;
            }
        }
        if ($append) {
            $items[] = $item;
        }
        $this->setItems($items);
    }

    public function incQuantity($position, $step = 1)
    {
        $item = $this->getItem($position);
        $this->setQuantity($position, $item->quantity + $step);
    }

    public function decQuantity($position, $step = 1)
    {
        $item = $this->getItem($position);
        $this->setQuantity($position, $item->quantity - $step);
    }

    public function setQuantity($position, $quantity)
    {
        $item = $this->getItem($position);
        if ($quantity <= 0) {
            $this->removeItem($position);
        } else {
            $item->quantity = $quantity;
        }
        $this->setItem($position, $item);
    }

    public function getItem($position)
    {
        $items = $this->getItems();
        return isset($items[$position]) ? $items[$position]: null;
    }

    public function setItem($position, Item $item)
    {
        $items = $this->getItems();
        $items[$position] = $item;
        $this->setItems($items);
    }

    public function removeItem($position)
    {
        $items = $this->getItems();
        if (isset($items[$position])) {
            unset($items[$position]);
        }
        $this->setItems($items);
    }

    public function clean()
    {
        $this->setItems([]);
    }

    /**
     * Count of Items
     *
     * @return mixed
     */
    public function count()
    {
        return count($this->getItems());
    }

    /**
     * @return Item[]
     */
    abstract public function getItems();

    /**
     * @param Item[] $items
     */
    abstract public function setItems($items = []);
}