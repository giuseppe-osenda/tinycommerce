// Please see documentation at https://learn.microsoft.com/aspnet/core/client-side/bundling-and-minification
// for details on configuring this project to bundle and minify static web assets.

// Write your JavaScript code.
const myQuantitySelector = $('.cartQuantitySelector');
const submitCouponButton = $('.submitCouponButton');

myQuantitySelector.each(function () {
    console.log($(this));

    $(this).on("change", function () {
        var quantity = parseInt($(this).val());
        var cartProductId = $(this).attr('cart-product-id');
        var maxQuantity = parseInt($(this).attr('max'));
      

        if (quantity <= maxQuantity) {
            $.post({
                url: "/Cart/UpdateQuantity?quantity=" + quantity + "&cartProductId=" + cartProductId,
                success: function (data) {
                    window.location.href = "/Cart/Index";
                },
                error: function (error) {
                    console.log(error);
                }
            });
        } else {
            $("#stockQtyError").css("display", "table-cell");
            $("#notificationsTableHeader").css("display", "table-cell");
        }
    });

});

submitCouponButton.on("click", function () {
    const couponCode = $("#couponCodeInput").val();
    const cartId = $("#couponCodeInput").attr("cart-id");
    
    $.post({
        url: "/Cart/ApplyCoupon?couponCode=" + couponCode + "&cartId=" + cartId,
        dataType: 'json',
        success: function (response) {
           
            if (response.success) {
                window.location.href = "/Cart/Index";
      
            } else {
     
                $(".coupon-invalid-feedback").css("display", "block");
                $(".coupon-valid-feedback").css("display", "none");
            }
        },
        error: function (error) {
           
        }
    });


})

