/*!
 * Author: Kondylis Andreas
 * Date: 2014-12-05
 * Description:
 *
 !**/

(function () {
    "use strict";

    $.fn.modalAjax = function (/*options*/) {
        var $modal = $(this);
        var options = arguments[0] || $modal.data('modalOptions');
        var settings = $.extend({
            'request': null,
            'method': 'post',
            'args': [],
            'format': 'json'
        }, options);

        $modal.data('modalOptions', settings);

        $modal.on({
            'shown.bs.modal': function (e) {
                var $this = $(this);
                var $button = $(e.relatedTarget);
                var settings = $.extend({}, $this.data('modalOptions'),
                    $button.data('modalOptions'));

                if (settings.request == null) {
                    return;
                }

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

$(document).ready(function () {

    $("#carousel").owlCarousel({

        autoPlay: 3000,
        items: 1,
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [768, 1], //2 items between 600 and 0
        itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
        navigation: true,
        navText: ['<span class="glyphicon glyphicon-chevron-left">', '<span class="glyphicon glyphicon-chevron-left">']

    });

    $(".modal[data-modal-type='ajax-modal']").each(function () {
        $(this).modalAjax();
    });
});