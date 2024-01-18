<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .first_div {
        width: 90%;
        margin-left: 5%;
        border: 2px solid black;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        display: block;
        padding: 1%;

    }

    .invoice {
        padding: 1%;
        color: cadetblue;
        display: flex;
        /* text-align: center;   */
    }

    .invoice_bill {
        width: 48%;
        text-align: left;
        padding: 1%;
        display: flexbox;
    }

    .invoice_bill div {
        padding: 1%;
    }

    #id {
        margin-left: 20%;
        width: 170px;

    }

    #date {
        margin-left: 100px;
        width: 170px;
    }

    #payment_type {
        margin-left: 4%;
        width: 170px;

    }

    #due_date {
        margin-left: 10%;
        width: 170px;
    }

    #po_number {
        margin-left: 7%;
        width: 170px;
    }

    input {
        width: 180px;
        height: 2em;
        text-align: center;
    }

    textarea {
        text-align: center;
    }

    .x,
    .x1 {
        display: none;
    }

    #table_data tr:hover .x {
        display: block;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<body>
    <div class="first_div">
    <form action="" method="post" id="form_data">

        <div class="invoice">
                <div class="invoice_bill">
                    <div>
                        <input type="file" name="image" id="image">
                    </div>
                    <div>
                        <span>Bill From </span><br>
                        <textarea name="blii_from" id="bill_from" cols="30" rows="4" placeholder="Bill From ?">{{old('bill_from')}}</textarea>
                    </div>
                    <div>
                        <span>Bill To </span><br>
                        <textarea name="blii_from" id="bill_from" cols="30" rows="4" placeholder="Bill From ?">{{old('bill_from')}}</textarea>
                    </div>
                    <div>
                        <span>Ship To </span><br>
                        <textarea name="blii_from" id="bill_from" cols="30" rows="4" placeholder="Bill From ?">{{old('bill_from')}}</textarea>
                    </div>
                </div>
                <div class="invoice_bill">
                    <div style="margin-left: 40%;">
                        <p><b>INVOICE</b></p>
                    </div>
                    <div>
                        <span>#</span>
                        <input type="number" id="id" readonly>
                    </div>
                    <div>
                        <span>Date</span>
                        <input type="date" name="date" id="date">
                    </div>
                    <div>
                        <span>Payment Type</span>
                        <input type="text" name="payment_type" id="payment_type" placeholder="Payment Type" value="{{old('payment_type')}}">
                    </div>
                    <div>
                        <span>Due Date</span>
                        <input type="date" name="due_date" id="due_date" value="{{old('due_date')}}">
                    </div>
                    <div>
                        <span>PO Number</span>
                        <input type="number" name="po_number" id="po_number" value="{{old('po_number')}}">
                    </div>
                </div>
        </div>
        <div style="padding:1%">
            <table id="table_data">
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td><input type="text" name="items[0][item_name]" class="item_name" value="{{old('items.1.item_name')}}" placeholder="Item"></td>
                    <td><input type="number" name="items[0][quantity]" class="quantity" value="{{old('items.1.quantity')}}" placeholder="Quantity"></td>
                    <td><input type="number" name="items[0][rate]" class="rate" value="{{old('items.1.rate')}}" placeholder="Rate"></td>
                    <td><input type="number" name="items[0][amount]" class="amount" value="{{old('items.1.amount')}}" placeholder="Amount"></td>
                </tr>
            </table><br>
            <button class="button" id="button">Click Me</button>
        </div>
        <div class="invoice">
            <div class="invoice_bill">
                <div>
                    <span>Notes</span><br>
                    <textarea name="notes" id="notes" cols="30" rows="4" placeholder=" notes">{{old('notes')}}</textarea>
                </div>
                <div>
                    <span>Terms </span><br>
                    <textarea name="terms" id="terms" cols="30" rows="4" placeholder="terms">{{old('terms')}}</textarea>
                </div>
            </div>
            <div class="invoice_bill">
                <div>
                    <span>Sub Total</span>
                    <input type="number" name="sub_total" id="sub_total" placeholder="Sub Total" value="{{old('sub_total')}}" readonly>

                </div>
                <div>
                    <span class="discount"> + Discount</span>
                    <span class="discount_field"></span>
                    <span class="tax"> + Tax</span>
                    <span class="tax_field"></span>
                    <span class="shiping"> + Shiping</span>
                    <span class="shiping_field"></span>
                </div>

                <div>
                    <span>Total</span>
                    <input type="number" name="total" id="total" value="{{old('total')}}">
                </div>
                <div>
                    <span>Paid Amount</span>
                    <input type="number" name="paid_amount" id="paid_amount" value="{{old('paid_amount')}}">
                </div>
                <div>
                    <span>Due Amount</span>
                    <input type="number" name="due_amount" id="due_amount" value="{{old('due_amount')}}">
                </div>
            </div>
        </div>
        <div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </div>
    </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            var index = 0;

            $(".button").click(function() {
                ++index;
                var rowdata = '<tr>' +
                    '<td><input type="text" name="items[' + index + '][item_name]" class="item_name"  placeholder="Item"></td>' +
                    '<td><input type="number" name="items[' + index + '][quantity]" class="quantity"  placeholder="Quantity"></td>' +
                    '<td><input type="number" name="items[' + index + '][rate]" class="rate"  placeholder="Rate"></td>' +
                    '<td><input type="number" name="items[' + index + '][amount]" class="amount" placeholder="Amount"></td>' +
                    '<td><button class="x"><b>x</b></button></td>' +
                    '</tr>';
                $('#table_data').append(rowdata);
                $('.x').on('click', function() {
                    var row = $(this).closest('tr');
                    row.remove();
                });
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
    </script>
</body>

</html>