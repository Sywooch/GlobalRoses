$(document).ready(function () {

    // Modal prdouct quantity
    // This button will increment the value
    $('.qtyplus').click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name=' + fieldName + ']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name=' + fieldName + ']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name=' + fieldName + ']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name=' + fieldName + ']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name=' + fieldName + ']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name=' + fieldName + ']').val(0);
        }
    });

    // Remove item  from cart
    $("#cart .actions .btn-danger").on("click", function (e) {
        $(this).closest("tr").remove();
        e.preventDefault();
    });

    // Products image popover trigger on hover
    $('[rel="popover"]').popover({
        trigger: "hover",
        placement: 'bottom',
        content: '',
        html: true
    });

    // Selectpicker
    //$('select').select2();
    /*    $("#sidebarCat").select2({
        placeholder: "Επιλέξτε Κατηγορία",
        allowClear: true
     });*/
    // Modal nagiation between products

    // $('li img').on('click', function() {
    // var src = $(this).attr('src');
    // var img = '<img src="' + src + '" class="img-responsive"/>';
//
    // //start of new code new code
    // var index = $(this).parent('li').index();
//
    // var html = '';
    // html += img;
    // html += '<div style="height:25px;clear:both;display:block;">';
    // html += '<a class="controls next" href="' + (index + 2) + '">next &raquo;</a>';
    // html += '<a class="controls previous" href="' + (index) + '">&laquo; prev</a>';
    // html += '</div>';
//
    // $('#myModal').modal();
    // $('#myModal').on('shown.bs.modal', function() {
    // $('#myModal .modal-body').html(html);
    // $('a.controls').trigger('click');
    // })
    // $('#myModal').on('hidden.bs.modal', function() {
    // $('#myModal .modal-body').html('');
    // });
//
    // });

});

// When modal is open  prev/next navgiation
// $(document).on('click', 'a.controls', function() {
// var index = $(this).attr('href');
// var src = $('ul li:nth-child(' + index + ') img').attr('src');
//
// $('.modal-body img').attr('src', src);
//
// var newPrevIndex = parseInt(index) - 1;
// var newNextIndex = parseInt(newPrevIndex) + 2;
//
// if ($(this).hasClass('previous')) {
// $(this).attr('href', newPrevIndex);
// $('a.next').attr('href', newNextIndex);
// } else {
// $(this).attr('href', newNextIndex);
// $('a.previous').attr('href', newPrevIndex);
// }
//
// var total = $('ul li').length + 1;
// //hide next button
// if (total === newNextIndex) {
// $('a.next').hide();
// } else {
// $('a.next').show();
// }
// //hide previous button
// if (newPrevIndex === 0) {
// $('a.previous').hide();
// } else {
// $('a.previous').show();
// }
//
// return false;
//
//
//
// });

