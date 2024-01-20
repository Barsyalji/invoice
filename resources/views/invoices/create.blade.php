<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
</head>
<body>
    <div class="first_div">
        <form action="{{route('invoices.store')}}" method="post" id="form_data" enctype="multipart/form-data">
            @csrf
            <div class="invoice">
                <div class="invoice_bill">
                    <div>
                        <input type="file" name="image" id="image">
                        @if ($errors->has('image'))
                        <div class="error">{{ $errors->first('image') }}</div>
                        @endif
                    </div>
                    <div>
                        <span>Bill From </span><br>
                        <textarea name="blii_from" id="bill_from" cols="30" rows="4" placeholder="Bill From ?">{{old('bill_from')}}</textarea>
                        @if ($errors->has('bill_from'))
                        <div class="error">{{ $errors->first('bill_from') }}</div>
                        @endif
                    </div>
                    <div>
                        <span>Bill To </span><br>
                        <textarea name="bill_to" id="bill_to" cols="30" rows="4" placeholder="Bill to ?">{{old('bill_to')}}</textarea>
                        @if ($errors->has('bill_to'))
                        <div class="error">{{ $errors->first('bill_to') }}</div>
                        @endif
                    </div>
                    <div>
                        <span>Ship To </span><br>
                        <textarea name="ship_to" id="ship_to" cols="30" rows="4" placeholder="Ship TP ?">{{old('ship_to')}}</textarea>
                        @if ($errors->has('ship_to'))
                        <div class="error">{{ $errors->first('ship_to') }}</div>
                        @endif
                    </div>
                </div>
                <div class="invoice_date invoice_bill">
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
                        @if ($errors->has('date'))
                        <div class="error">{{ $errors->first('date') }}</div>
                        @endif
                    </div>
                    <div>
                        <span>Payment Type</span>
                        <input type="text" name="payment_type" id="payment_type" placeholder="Payment Type" value="{{old('payment_type')}}">
                        @if ($errors->has('payment_type'))
                        <div class="error">{{ $errors->first('payment_type') }}</div>
                        @endif
                    </div>
                    <div>
                        <span>Due Date</span>
                        <input type="date" name="due_date" id="due_date" value="{{old('due_date')}}">
                        @if ($errors->has('due_date'))
                        <div class="error">{{ $errors->first('due_date') }}</div>
                        @endif
                    </div>
                    <div>
                        <span>PO Number</span>
                        <input type="number" name="po_number" id="po_number" value="{{old('po_number')}}">
                        @if ($errors->has('po_number'))
                        <div class="error">{{ $errors->first('po_number') }}</div>
                        @endif
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
                        <td><input type="text" name="items[0][item_name]" class="item_name" value="{{old('items.1.item_name')}}" placeholder="Item">
                            @if ($errors->has('items.0.item_name'))
                            <div class="error">{{ $errors->first('items.0.item_name') }}</div>
                            @endif
                        </td>
                        <td><input type="number" name="items[0][quantity]" class="quantity" value="{{old('items.1.quantity')}}" placeholder="Quantity">
                            @if ($errors->has('items.0.quantity'))
                            <div class="error">{{ $errors->first('items.0.quantity') }}</div>
                            @endif
                        </td>
                        <td><input type="number" name="items[0][rate]" class="rate" value="{{old('items.1.rate')}}" placeholder="Rate">
                            @if ($errors->has('items.0.rate'))
                            <div class="error">{{ $errors->first('items.0.rate') }}</div>
                            @endif
                        </td>
                        <td><input type="number" name="items[0][amount]" class="amount" value="{{old('items.1.amount')}}" placeholder="Amount">
                            @if ($errors->has('items.0.amount'))
                            <div class="error">{{ $errors->first('items.0.Amount') }}</div>
                            @endif
                        </td>
                    </tr>
                </table><br>
                <span class="span" id="span">Click Me</span>
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
                <div class="invoice_bill invoice_date">
                    <div>
                        <span>Sub Total</span>
                        <input type="number" name="sub_total" id="sub_total" placeholder="Sub Total" value="{{old('sub_total')}}" readonly>
                        @if ($errors->has('sub_total'))
                        <div class="error">{{ $errors->first('sub_total') }}</div>
                        @endif
                    </div>
                    <div class="">
                        <span class="discount"> + Discount</span>
                        <span class="discount_field "></span>
                        <span class="tax"> + Tax</span>
                        <span class="tax_field"></span>
                        <span class="shiping"> + Shiping</span>
                        <span class="shiping_field"></span>
                    </div>

                    <div>
                        <span>Total</span>
                        <input type="number" name="total" id="total" value="{{old('total')}}">
                        @if ($errors->has('total'))
                        <div class="error">{{ $errors->first('total') }}</div>
                        @endif
                    </div>
                    <div>
                        <span>Paid Amount</span>
                        <input type="number" name="paid_amount" id="paid_amount" value="{{old('paid_amount')}}">
                        @if ($errors->has('paid_amount'))
                        <div class="error">{{ $errors->first('paid_amount') }}</div>
                        @endif
                    </div>
                    <div>
                        <span>Due Amount</span>
                        <input type="number" name="due_amount" id="due_amount" value="{{old('due_amount')}}">
                        @if ($errors->has('due_amount'))
                        <div class="error">{{ $errors->first('due_amount') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <input type="submit" value="Submit" id="submit">
                </div>
            </div>
    </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            var index = 0;

            $(".span").click(function() {
                ++index;
                var rowdata = '<tr>' +
                    '<td><input type="text" name="items[' + index + '][item_name]" class="item_name"  placeholder="Item"></td>' +
                    '<td><input type="number" name="items[' + index + '][quantity]" class="quantity"  placeholder="Quantity"></td>' +
                    '<td><input type="number" name="items[' + index + '][rate]" class="rate"  placeholder="Rate"></td>' +
                    '<td><input type="number" name="items[' + index + '][amount]" class="amount" placeholder="Amount"></td>' +
                    '<td><span class="x"><b>x</b></span></td>' +
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
                $('.discount_field').append('<div><input type="number" id="discount" name="discount" placeholder="Discount"></div>');
                $(this).hide();
            });

            $('.tax').click(function() {
                $('.tax_field').append('<div><input type="number" id="tax" name="tax" placeholder="Tax"></div>');
                $(this).hide();
            });

            $('.shiping').click(function() {
                $('.shiping_field').append('<div><input type="number" id="shiping" name="shiping" placeholder="Shipping"></div>');
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