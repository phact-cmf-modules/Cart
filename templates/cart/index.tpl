{extends 'base.tpl'}

{block 'heading'}
    <h1>Корзина</h1>
{/block}

{block 'content'}
    <div class="cart-page">

        <button data-to-cart data-id="3">
            Купить
        </button>

        <div class="total-info" data-cart-block="totals">
            {var $cart = $.cart}
            Итого {$cart->getSum()|number_format:0:'':' '} руб
        </div>

        <div class="cart-list" data-cart-block="list">
            {var $cart = $.cart}
            {if $cart->count() > 0}
                <div class="list-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Наименование
                                </th>
                                <th>
                                    Цена
                                </th>
                                <th>
                                    Количество
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $cart->getItems() as $position => $item}
                                <tr>
                                    <td>
                                        {$item->getObject()}
                                    </td>
                                    <td>
                                        {$item->getPrice()}
                                    </td>
                                    <td>
                                        <button data-cart-dec="{$position}">
                                            -
                                        </button>
                                        <span class="quantity">
                                            {$item->getQuantity()}
                                        </span>
                                        <button data-cart-inc="{$position}">
                                            +
                                        </button>
                                    </td>
                                    <td>
                                        <button data-cart-remove="{$position}">
                                            &times;
                                        </button>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            {else}
                В вашей корзине нет товаров
            {/if}
        </div>
    </div>
{/block}