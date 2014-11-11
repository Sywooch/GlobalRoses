/*!
 * Author: Kondylis Andreas
 * Date: 11 Nov 2014
 * Description:
 *      This file should be included in all pages
 !**/

(function () {
    "use strict";

    $.fn.modalSetBehaviors = function (/*options*/) {
        var $this = $(this);
        var options = arguments[0] || $this.data('modalOptions');
        var settings = $.extend({
            'request': null,
            'method': 'post',
            'args': [],
            'format': 'json'
        }, options);
        if (settings.request == null) {
            return;
        }
        $this.data('modalOptions', settings);

        $this.on({
            'shown.bs.modal': function (e) {
                var $this = $(this);
                var settings = $this.data('modalOptions');
                var $body = $this.find('.modal-body');
                var contents = null;
                if (settings.method == 'post') {
                    contents = $.post(settings.request, settings.args, null,
                        settings.format);
                } else {
                    contents = $.get(settings.request, settings.args, null,
                        settings.format);
                }

                contents
                    .done(function (data) {
                        $body.empty().append(data.html);
                        var $model_content = $this.find('.modal-content');
                        $model_content.find('.overlay, .loading-img').hide();
                    })
                    .fail(function (data) {

                    });
            },
            'show.bs.modal': function (e) {
                var $this = $(this);
                var $mcontent = $this.find('.modal-content');
                var $overlay = $mcontent.find('.overlay');
                var $spinner = $mcontent.find('.loading-img');

                if ($overlay.size() == 0) {
                    $mcontent.append($('<div class="overlay">'));
                } else {
                    $overlay.show();
                }
                if ($spinner.size() == 0) {
                    $mcontent.append($('<div class="loading-img">'));
                } else {
                    $spinner.show();
                }
            },
            'hide.bs.modal': function (e) {
            },
            'hidden.bs.modal': function (e) {
                $(this).find('.modal-body').empty();
            }
        });
    };
})(jQuery);

$(window).load(function () {
    $('.modal[data-modal-type="app-modal"]').modalSetBehaviors();
});
