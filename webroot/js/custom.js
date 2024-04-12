$(function () {
    $.ajaxSetup({ // Imposta il token CSRF per ogni richiesta AJAX
        cache: false, // Disabilita la cache AJAX per far si che il token CSRF venga aggiornato
        headers: { // Imposta l'header X-CSRF-TOKEN con il token CSRF
            'X-CSRF-TOKEN': window.csrfToken
        }
    });
})

$(".remove-from-cart").click(function (e) { // Rimuove un prodotto dal carrello
    e.preventDefault(); // Impedisce il comportamento predefinito del link

    var url = $(this).attr('href'); // Ottiene l'URL del link
    const trigger = $(e.currentTarget); // Ottiene l'elemento che ha scatenato l'evento

    $.get(url, function (response) { // Esegue una richiesta GET all'URL
        if (response.success) {
            $(trigger).parent().parent().remove(); // Rimuove la riga del prodotto dal carrello
            if (response.atLeastOneProduct) { // Se ci sono ancora prodotti nel carrello
                $('[data-cart-total] > [data-original-total]').text((parseFloat(response.cartTotal).toFixed(2) + '€')); // Aggiorna il totale del carrello
                $('[data-cart-total] > [data-del-total]').text((parseFloat(response.originalTotal).toFixed(2) + '€')); // Aggiorna il totale del carrello barrato senza sconto applicato
                $('[data-cart-total] > [data-session-del-total]').text((parseFloat(response.originalTotal).toFixed(2) + '€')); // Aggiorna il totale del carrello barrato senza sconto applicato recuperato dalla sessione
            } else {
                $('[data-cart-total] > [data-original-total]').text((parseFloat(response.cartTotal).toFixed(2) + '€'));
                $('[data-cart-total] > [data-del-total]').text('');
                $('[data-cart-total] > [data-session-del-total]').text('');
                $('[data-coupon-code]').text('');
            }

            if(response.emptyCart){ // Se il carrello è vuoto
                $('[data-cart-proceed]').attr('href', 'javascript:void(0);'); // Disabilita il link per procedere all'acquisto
                $('[data-cart-proceed]').addClass('disabled');
            }
        }
    });
});



$(document).ready(function () {
    $('select[id^="quantity-"]').on('change', function () { // Aggiorna la quantità di un prodotto nel carrello
        var productId = $(this).attr('id').split('-')[1]; // Ottiene l'ID del prodotto
        var quantity = $(this).val(); // Ottiene la quantità selezionata
        $.ajax({
            url: '/cart/updateQuantity',
            type: 'post',
            data: { id: productId, quantity: quantity }, 
            success: function (response) {
                if (response.success) {
                    $('[data-row-total="' + productId + '"]').text((parseFloat(response.rowTotal).toFixed(2)) + '€'); // Aggiorna il totale della riga del prodotto
                    $('[data-cart-total] > [data-original-total]').text((parseFloat(response.cartTotal).toFixed(2) + '€')); // Aggiorna il totale del carrello
                    $('[data-cart-total] > [data-del-total]').text((parseFloat(response.cartTotal).toFixed(2) + '€')); // Aggiorna il totale del carrello barrato da mostrare se viene applicato uno sconto

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
                if (response.hasOwnProperty(productId) && productId !== 'success' && productId !== 'cartTotal' && productId !== 'message' && productId !== 'couponCode') { // Se risposta contiene un prodotto e non è un campo di controllo
                    $('[data-row-total="' + productId + '"]').text(parseFloat(response[productId].rowTotal).toFixed(2)); // Aggiorna il totale della riga del prodotto
                    $('[data-product-price="' + productId + '"] > [data-original-price]').text(parseFloat(response[productId].price).toFixed(2)); // Aggiorna il prezzo del prodotto
                    $('[data-product-price="' + productId + '"] > [data-del-price]').attr('data-del-price', 'visible'); // Mostra il prezzo barrato del prodotto
                    $('.coupon-alert').text(response.message); // Mostra il messaggio di successo
                }

                $('.select-product-quantity').each(function () { // Disabilita i select della quantità dei prodotti
                    $(this).prop('disabled', true);
                });

            }

            $('[data-cart-total] > [data-original-total]').text(parseFloat(response.cartTotal.cartTotal).toFixed(2)); // Aggiorna il totale del carrello
            $('[data-cart-total] > [data-del-total]').attr('data-del-total', 'visible'); // Mostra il totale del carrello barrato

            $('[data-coupon-code]').text(response.couponCode); // Mostra il codice del coupon
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
            window.location.href = response.redirectUrl; // Reindirizza l'utente alla pagina di conferma dell'ordine
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


    if (checkPrivacy.prop('checked') == false) {
        e.preventDefault();
        privacyError.text("Accetta la privacy");
    } else {
        privacyError.text("");
    }

    if (checkStripe.prop('checked') == false) {
        e.preventDefault();
        paymentError.text("Seleziona almeno un metodo di pagamento");
    } else {
        paymentError.text("");
    }
});