(function ($) {

    "use strict";

    /**
     * Описание объекта
     */
    var cart = function () {
        return cart.init.apply(this, arguments);
    };

    /**
     * Расширение объекта
     */
    $.extend(cart, {
        /**
         * Настройки по умолчанию
         */
        options: {
            routes: {
                index: '/cart',
                add: '/cart/add',
                remove: '/cart/remove',
                inc: '/cart/inc',
                dec: '/cart/dec',
                quantity: '/cart/quantity'
            },
        },
        /**
         * Инициализация
         * @param options
         */
        init: function (options) {
            this.options = $.extend(this.options, options);

            this.bind();

            return this;
        },
        /**
         * "Навешиваем" события
         */
        bind: function () {
            var me = this;

            $(document).on('click', '[data-to-cart]', function(e) {
                e.preventDefault();
                var $button = $(this);
                me.add($button.data('id'));
                return false;
            });

            $(document).on('click', '[data-cart-dec]', function(e) {
                e.preventDefault();
                var $button = $(this);
                me.dec($button.data('cart-dec'));
                return false;
            });

            $(document).on('click', '[data-cart-inc]', function(e) {
                e.preventDefault();
                var $button = $(this);
                me.inc($button.data('cart-inc'));
                return false;
            });

            $(document).on('click', '[data-cart-remove]', function(e) {
                e.preventDefault();
                var $button = $(this);
                me.remove($button.data('cart-remove'));
                return false;
            });
        },
        add: function (id) {
            this.request(this.options.routes.add, {
                id: id
            });
        },
        dec: function (position) {
            this.request(this.options.routes.dec, {
                position: position
            });
        },
        inc: function (position) {
            this.request(this.options.routes.inc, {
                position: position
            });
        },
        remove: function (position) {
            this.request(this.options.routes.remove, {
                position: position
            });
        },
        request: function (route, request) {
            var me = this;
            $.ajax({
                url: route,
                dataType: 'json',
                type: 'post',
                data: request,
                success: function (data) {
                    if (data.status && data.message) {
                        me.message(status, data.message)
                    }
                    if (data.status == "success") {
                        me.update();
                    }
                }
            });
        },
        /**
         * @param status "success"|"error"
         * @param message
         */
        message: function (status, message) {
            console.log(status, message);
        },
        update: function () {
            var me = this;
            var $blocks = $('[data-cart-block]');
            if ($blocks.length > 0) {
                $blocks.addClass('loading');
                $.ajax({
                    success: function (page) {
                        var $page = $(page);
                        me.updateBlocks($page);
                    }
                });
            }
        },
        updateBlocks: function ($page) {
            $page.find('[data-cart-block]').each(function () {
                var $newBlock = $(this);
                var name = $newBlock.data('cart-block');
                var $block = $('[data-cart-block="' + name + '"]');
                $block.removeClass('loading');
                $block.html($newBlock.html());
            });
        },
    });

    /**
     * Инициализация функции объекта для jQuery
     */
    return $.cart = function (options) {
        return cart.init(options);
    };

})($);

//$(function(){
//	$('body').cart();
//});

$.cart();