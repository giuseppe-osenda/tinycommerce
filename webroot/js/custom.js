$(function () {
    $.ajaxSetup({ // Imposta il token CSRF per ogni richiesta AJAX
        cache: false, // Disabilita la cache AJAX per far si che il token CSRF venga aggiornato
        headers: { // Imposta l'header X-CSRF-TOKEN con il token CSRF
            'X-CSRF-TOKEN': window.csrfToken
        }
    });
})

$(".remove-from-cart").click(function (e) {
    e.preventDefault();

    var url = $(this).attr('href');
    const trigger = $(e.currentTarget);

    $.get(url, function (response) {
        if (response.success) {
            $(trigger).parent().parent().remove();
            $('[data-cart-total]').text(response.cartTotal);
        }
    });
});



$(document).ready(function () {
    $('select[id^="quantity-"]').on('change', function () {
        var productId = $(this).attr('id').split('-')[1];
        var quantity = $(this).val();
        $.ajax({
            url: '/cart/updateQuantity',
            type: 'post',
            data: { id: productId, quantity: quantity },
            success: function (response) {
                if (response.success) {
                    $('[data-row-total="' + productId + '"]').text(response.rowTotal);
                    $('[data-cart-total]').text(response.cartTotal);
                }
            }
        });
    });
});


    $('.coupon-form').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();
        $.post(url, data, function (response) {
            if (response.success) {
            }
        });
    });
