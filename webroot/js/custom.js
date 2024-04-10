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
            $('[data-cart-total]').text(parseFloat(response.cartTotal).toFixed(2));
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
                    $('[data-row-total="' + productId + '"]').text((parseFloat(response.rowTotal).toFixed(2)) + '€');
                    $('[data-cart-total] > [data-original-total]').text((parseFloat(response.cartTotal).toFixed(2) + '€'));
                    $('[data-cart-total] > [data-del-total]').text((parseFloat(response.cartTotal).toFixed(2) + '€'));
                    
                }
            }
        });
    });
});


$('.coupon-form').on('submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize(); // Serializza i dati del form
    $.post(url, data, function (response) {
        if (response.success) {

            for (var productId in response) {
                if (response.hasOwnProperty(productId) && productId !== 'success' && productId !== 'cartTotal' && productId !== 'message' && productId !== 'couponCode') {
                    $('[data-row-total="' + productId + '"]').text(parseFloat(response[productId].rowTotal).toFixed(2));
                    $('[data-product-price="' + productId + '"] > [data-original-price]').text(parseFloat(response[productId].price).toFixed(2));
                    $('[data-product-price="' + productId + '"] > [data-del-price]').attr('data-del-price', 'visible');
                    $('.coupon-alert').text(response.message);
                }

                $('.select-product-quantity').each(function () {
                    $(this).prop('disabled', true);
                });

            }

            $('[data-cart-total] > [data-original-total]').text(parseFloat(response.cartTotal.cartTotal).toFixed(2));
            $('[data-cart-total] > [data-del-total]').attr('data-del-total', 'visible');

            $('[data-coupon-code]').text(response.couponCode);
        } else {
            $('.coupon-alert').text(response.message);
        }
    });
});

$('.client-form').on('submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize(); // Serializza i dati del form
    $.post(url, data, function (response) {
        if (response.success) {
            window.location.href = response.redirectUrl;
        } else {
            $('.client-alert').text(response.message);
        }
    });
});

const payButton = $("[data-pay-button]");
const checkPrivacy = $("[data-privacy-check]");
const privacyError = $("[data-privacy-error]");
const checkStripe = $("[data-stripe-payment]");
const paymentError = $("[data-payment-error]");

payButton.on('click', function (e) {
    if (!(checkPrivacy.prop('checked'))) {
        e.preventDefault();
        privacyError.text("Accetta la privacy");
    } else {
        privacyError.text("");
    }

    if (!(checkStripe.prop('checked'))) {
        e.preventDefault();
        paymentError.text("Seleziona almeno un metodo di pagamento");
    } else {
        privacyError.text("");
    }
});