$(document).ready(function () {

    loadCart();
    loadWish();

    $(".addToCart").click(function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product_data")
            .find(".prod_id")
            .val();
        var product_qty = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/cart",
            data: {
               'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                loadCart();
                swal(response.status);
            },
        });
    });

    $(".addToWishlist").click(function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product_data")
            .find(".prod_id")
            .val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/add-to-wishlist",
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                loadWish();
                swal(response.status);
            },
        });
    });

        $(document).on('click','.increment-btn', function (e) {
        e.preventDefault();
        var inc_value = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? "" : value;
        if (value < 10) {
            value++;
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });

        $(document).on('click','.decrement-btn', function (e) {
        e.preventDefault();
        var dec_value = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });

        $(document).on('click','.delete-cart-item', function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        e.preventDefault();
        var prod_id = $(this).closest(".product_data").find(".prod_id").val();
        $.ajax({
            method: "POST",
            // url: "/cart/".$prod_id,
            url: "/delete-cart-item",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                // window.location.reload();
                loadCart();
                $('.cartitems').load(location.href + ' .cartitems')
            },
        });
    });

        $(document).on('click','.remove-wishlist-item', function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        e.preventDefault();
        var prod_id = $(this).closest(".product_data").find(".prod_id").val();
        $.ajax({
            method: "POST",
            url: "/delete-wishlist-item",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                // window.location.reload();
                loadWish();
                $('.wishlistitems').load(location.href + ' .wishlistitems')
            },
        });
    });

        $(document).on('click','.changeQuantity', function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        e.preventDefault();
        var prod_id = $(this).closest(".product_data").find(".prod_id").val();
        var quantity = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        data = {
            'prod_id': prod_id,
            'quantity': quantity,
        };
        $.ajax({
            method: "POST",
            url: "/update-cart",
            data: data,
            success: function (response) {
                $('.cartitems').load(location.href + ' .cartitems')
                // window.location.reload();
            },
        });
    });

    function loadCart(){
        $.ajax({
            method:"GET",
            url: "/load-cart",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);

            }
        });
    }

    function loadWish(){
        $.ajax({
            method:"GET",
            url: "/load-wish",
            success: function (response) {
                $('.wish-count').html('');
                $('.wish-count').html(response.count);

            }
        });
    }

});
