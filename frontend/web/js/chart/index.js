(function () {
    "use strict";
    if (typeof $.cart == 'undefined') {
        $.cart = {
            call: function (request) {
                var args = arguments[1];
                var onDone = (typeof arguments[2] == 'function') ? arguments[2] : function () {
                };
                var onFailure = (typeof arguments[3] == 'function') ? arguments[3] : function () {
                };
                var call = $.post(request, args, null, 'json');
                call
                    .done(function (data) {
                        onDone.apply(this, arguments);
                    })
                    .fail(function (data) {
                        onFailure.apply(this, data);
                    });
            },
            items: {
                'build': function (element) {
                    var $this = $(element);
                    var $row = $this.closest('[data-row]');
                    var $quantity_input = $row.find('input[name="requested_quantity"]');
                    var item_id = $quantity_input.attr('id');
                    var request = $this.data('action');
                    var args = {
                        'id': item_id,
                        'quantity': $quantity_input.val()
                    };
                    return {
                        request: request,
                        args: args
                    };
                },
                'method': function () {
                    var data = $.cart.items.build(this);
                    $.cart.call(data.request, data.args);
                },
                'delete': function () {

                },
                'update': function () {
                    var $this = $(this);
                    var $cart = $this.closest('[data-type="cart"]');
                    var data = $.cart.items.build(this);
                    var onDone = function (return_data) {
                        var _data = return_data.data.cart;
                        $('body')
                            .trigger('updateCart', [{
                                'count': _data.count,
                                'text': _data.text
                            }]);

                        $this
                            .closest('[data-row="product"]')
                            .trigger('updateRow', [{price: _data.item_price}]);

                        $cart
                            .trigger('updateTotalPrice', [{price: _data.price}]);

                        $cart
                            .trigger('checkOutStatus', [{count: _data.count}]);
                    };
                    var onFailure = function (data) {
                        console.log(data);
                    };
                    $.cart.call(data.request, data.args, onDone, onFailure);
                }
            }
        };
    }

})(jQuery);

$(document).ready(function () {
    var $grid = $('[data-type="cart"]');
    $grid.on({
        'updateTotalPrice': function (e, data) {
            $(this).find('[data-price="total"]').empty().html(data.price);
        },
        'checkOutStatus': function (e, data) {
            var $checkOutButton = $(this).find('[data-button="checkout"]');
            if (data.count > 0) {
                $checkOutButton.attr('disabled', false);
            } else {
                $checkOutButton.attr('disabled', true);
            }
        }
    });

    $grid.on('updateRow', '[data-row="product"]', function (e, data) {
        var $this = $(this);
        $this.find('[data-price="sub-total"]').empty().html(data.price);
    });

    $grid.on('click', 'button[data-action][data-type]', function (e) {
        var $this = $(this);
        var method = $this.data('type');
        if (typeof $.cart.items[method] !== 'undefined') {
            $.cart.items[method].apply($this);
        } else {
            $.cart.items.method.apply($this);
        }
    });
});