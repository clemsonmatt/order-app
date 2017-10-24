
<script type="text/javascript">
    $(function(){
        $('.js-show-details').on('click', function (e) {
            e.preventDefault();

            // first empty anything that could be there already
            $('#js-modal-order-summary').empty();
            $('#js-modal-order-details').empty()

            var orderId = $(this).data('order-id');

            // get order data and show modal
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "orderDetail.php",
                data: { "orderId": orderId },
                success: function(data) {
                    var tr;

                    $.each(data.order, function(key, value){
                        if (typeof value == 'object' && 'date' in value) {
                            value = value.date;
                        }

                        tr = "<tr><th>" + key + "</th><td>" + value + "</td></tr>";
                        $('#js-modal-order-summary').append(tr);
                    });

                    if (data.orderDetails == null) {
                        $('#js-modal-order-details').append('No details.');
                    } else {
                        $('#js-modal-order-details').append(data.orderDetails.orderDetails);
                    }

                    $('#js-order-modal').modal();
                }
            });
        });
    });
</script>

</body>
</html>
