
$(document).ready(function() {
    var index = 0;
    document.getElementById('image').addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('imageDisplay').style.display = 'block';
                document.getElementById('imageDisplay').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    $(".button").click(function() {
        ++index;
        var rowdata = '<tr>' +
            '<td>'+
            '<input type="hidden" name="items[' + index + '][id]"" class="item_name" value="" placeholder="Item">'+
            '<input type="text" name="items[' + index + '][item_name]" class="item_name"  placeholder="Item"></td>' +
            '<td><input type="number" name="items[' + index + '][quantity]" class="quantity"  placeholder="Quantity"></td>' +
            '<td><input type="number" name="items[' + index + '][rate]" class="rate"  placeholder="Rate"></td>' +
            '<td><input type="number" name="items[' + index + '][amount]" class="amount" placeholder="Amount" readonly></td>' +
            ' <td><div class=" x text-dark border-teansprant">&#x2718; </div></td>' +
            '</tr>';
            $('#table_data').append(rowdata);

    });
        var table = document.getElementById('table_data');
        var rowCount = table.getElementsByTagName('tbody')[0].rows.length;
        if(rowCount <= 2){
            $('.x').css('display', 'none');
        }

        table.addEventListener('click', function(event) {
            if ($(event.target).hasClass('x')) {
                var row = $(event.target).closest('tr');
                var id = parseFloat(row.find('.item_id').val()) || 0;
                console.log(id);
                $('#form_data').append('<input type="hidden" name="uid[]" value="' + id + '">');
                row.remove();
            }
        });
    $('#table_data').on('input', '.rate, .quantity', function() {
        var row = $(this).closest('tr');
        var rate = parseFloat(row.find('.rate').val()) || 0;
        var quantity = parseFloat(row.find('.quantity').val()) || 0;
        var amount = rate * quantity;

        row.find('.amount').val(amount.toFixed(2));
        totalSum();
    });
    $('.invoice_bill').on('input', 'input[name="discount"], input[name="tax"], input[name="shipping"], input[name="paid_amount"]', function() {
        totalSum();
    });

    $('.discount').click(function() {
        $('.discount_field').append('<input class="col" type="number" id="discount" name="discount" placeholder="Discount">');
        $(this).hide();
    });

    $('.tax').click(function() {
        $('.tax_field').append('<input type="number" class="tax" name="tax" placeholder="Tax">');
        $(this).hide();
    });

    $('.shipping').click(function() {
        $('.shipping_field').append('<input type="number" class="shipping" name="shipping" placeholder="Shipping">');
        $(this).hide();
    });

    function totalSum() {
        var totalAmount = 0;
        var total = 0;
        // Amount filed data gat and add all
        $('.amount').each(function() {
            var amount = parseFloat($(this).val()) || 0;
            totalAmount += amount;
        })
        $('#sub_total').val(totalAmount.toFixed(2));
        //get data discount filed
        var discount = parseFloat($("input[name=discount]").val()) || 0;
        discount = (discount * totalAmount) / 100;
        total = totalAmount - discount;
        //get data discount filed
        var tax = parseFloat($("input[name=tax]").val()) || 0;
        tax = (tax * total) / 100;
        //get data discount filed
        var shipping = parseFloat($("input[name=shipping]").val()) || 0;
        total = total + tax + shipping;
        $('#total').val(total.toFixed(2))
        var paid_amount = parseFloat($("input[name=paid_amount]").val()) || 0;
        paid_amount = total - paid_amount;
        $('#due_amount').val(paid_amount.toFixed(2));
    }
});
