
<script type="text/javascript">
    $(function(){
        $('.js-show-details').on('click', function (e) {
            e.preventDefault();

            // first empty anything that could be there already
            $('#js-modal-order-summary').empty();

            var orderId = $(this).data('order-id');

            // get order data and show modal
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "orderDetail.php",
                data: { "orderId": orderId },
                success: function(data) {
                    var tr;

                    $.each(data, function(key, value){
                        if (typeof value == 'object' && 'date' in value) {
                            value = value.date;
                        }

                        tr = "<tr><th>" + key + "</th><td>" + value + "</td></tr>";
                        $('#js-modal-order-summary').append(tr);
                    })

                    $('#js-order-modal').modal();
                }
            });
        });
    });
</script>

</body>
</html>
