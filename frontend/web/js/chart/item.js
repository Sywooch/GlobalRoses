$(document).ready(function () {
    $(".modal[data-modal-type='ajax-modal']")
        .on('beforeSubmit', 'form#form-load-item', function (form) {
            var $form = $(this);
            if ($form.find('.has-error').length) {
                return false;
            }
            $.ajax({
                url: $form.attr('action'),
                type: 'post',
                data: $form.serialize(),
                success: function (return_data) {
                    $form.closest('.modal').modal('hide');
                    var data = return_data.data.cart;
                    var cart_data = {
                        'count': data.count,
                        'text': data.text
                    };
                    $('body').trigger('updateCart', [cart_data]);
                }
            });
            return false;
        });
});