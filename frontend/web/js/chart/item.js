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
                success: function (data) {
                    console.log(arguments);
                }
            });
            return false;
        });
});