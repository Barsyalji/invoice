$(document).ready(function() {
    var index = 0;
    $(".button").click(function() {
        ++index;
        var rowdata = '<tr>' +

            '<td>'+
           '<input type="hidden" name="items[' + index + '][id]"" class="item_name" value="" placeholder="Item">'+
            '<input type="text" name="items[' + index + '][item_name]" class="item_name"  placeholder="Item"></td>' +
            '<td><input type="number" name="items[' + index + '][quantity]" class="quantity"  placeholder="Quantity"></td>' +
            '<td><input type="number" name="items[' + index + '][rate]" class="rate"  placeholder="Rate"></td>' +
            '<td><input type="number" name="items[' + index + '][amount]" class="amount" placeholder="Amount" readonly></td>' +
            '<td><span class="x"><b>x</b></span></td>' +
            '</tr>';
            $('#table_data').append(rowdata);

    });
    $('.x').on('click', function() {
        var row = $(this).closest('tr');
        var count = document.querySelectorAll(".x").length;
        if(count > 1){
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
    $('.invoice_bill').on('input', 'input[name="discount"], input[name="tax"], input[name="shiping"], input[name="paid_amount"]', function() {
        console.log("Input changed!");
        totalSum();
    });

    $('.discount').click(function() {
        $('.discount_field').append('<br><input type="number" id="discount" name="discount" placeholder="Discount"><button class="x1"><b>x</b></button><br>');
        $(this).hide();
    });

    $('.tax').click(function() {
        $('.tax_field').append('<br><input type="number" class="tax" name="tax" placeholder="Tax"><button class="x1"><b>x</b></button><br>');
        $(this).hide();
    });

    $('.shiping').click(function() {
        $('.shiping_field').append('<br><input type="number" class="shiping" name="shiping" placeholder="Shipping"><button class="x1"><b>x</b></button><br>');
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
        var shiping = parseFloat($("input[name=shiping]").val()) || 0;
        total = total + tax + shiping;
        $('#total').val(total.toFixed(2))
        var paid_amount = parseFloat($("input[name=paid_amount]").val()) || 0;
        paid_amount = total - paid_amount;
        $('#due_amount').val(paid_amount.toFixed(2));
    }

});
