$('#btncart').click(function(e) {
    e.preventDefault();
    var product_id = $(this).closest('.product_data').find('.prod_id').val();
    var product_qty = $(this).closest('.product_data').find('.qty').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/cart",
        data: {
            'product_id': product_id,
            'product_qty': product_qty,
        },

        success: function(response) {
            swal("", response.status, "success")
            if (response.minicart) {
                jQuery('.mini-contentCart').html(response.minicart);
            }

        }
    });
});