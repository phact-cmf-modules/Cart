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
 * @date 27/01/17 14:31
 */

namespace Modules\Cart\TemplateLibraries;


use Phact\Main\Phact;
use Phact\Template\TemplateLibrary;

class CartLibrary extends TemplateLibrary
{
    /**
     * @name cart
     * @kind accessorProperty
     * @return mixed
     */
    public static function getCart()
    {
        return Phact::app()->cart;
    }
}