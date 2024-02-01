<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('/css/invoice.css') }}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/invoice.js') }}"></script>
</head>
<body>
    <div class="first_div">
@foreach ($invoice as $invoice)
        <!-- <form action="{{ route('invoices.store') }}" method="post" id="form_data" enctype="multipart/form-data">
            @csrf -->

            <div class="invoice">
                <div class="invoice_bill">
                    <div>
                        <input type="file" name="image" id="image">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>Bill From</span><br>
                        <textarea name="bill_from" id="bill_from" cols="30" rows="4" placeholder="Bill From"> {{$invoice->bill_from}}</textarea>
                        @error('bill_from')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>Bill To</span><br>
                        <textarea name="bill_to" id="bill_to" cols="30" rows="4" placeholder="Bill To"> {{$invoice->bill_to}}</textarea>
                        @error('bill_to')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>Ship To</span><br>
                        <textarea name="ship_to" id="ship_to" cols="30" rows="4" placeholder="Ship To"> {{$invoice->ship_to}}</textarea>
                        @error('ship_to')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="invoice_bill">
                    <div style="margin-left: 40%;">
                        <p><b>INVOICE</b></p>
                    </div>
                    <div>
                        <span>#</span>
                        <input type="number" id="id" value="{{$invoice->id}}" readonly>
                    </div>
                    <div>
                        <span>Date</span>
                        <input type="date" name="date" id="date" value="{{ $invoice->date}}">
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>Payment Type</span>
                        <input type="text" name="payment_type" id="payment_type" placeholder="Payment Type" value="{{ $invoice->payment_type}}">
                        @error('payment_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>Due Date</span>
                        <input type="date" name="due_date" id="due_date" value="{{ $invoice->due_date}}">
                        @error('due_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>PO Number</span>
                        <input type="number" name="po_number" id="po_number" value="{{ $invoice->po_number}}">
                        @error('po_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                    @foreach ($invoice->items as $items)
                    <tr>
                        <td>
                            <input type="text" name="items[0][item_name]" class="item_name" value="{{ $items->item_name}}" placeholder="Item">
                            @error('items.*.item_name')

                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" name="items[0][quantity]" class="quantity" value="{{ $items->quantity}}" placeholder="Quantity">
                            @error('items.*.quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" name="items[0][rate]" class="rate" value="{{ $items->rate}}" placeholder="Rate">
                            @error('items.*.rate')

                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" name="items[0][amount]" class="amount" value="{{ $items->amount}}" placeholder="Amount" readonly>
                            @error('items.*.amount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td><span class="x"><b>x</b></span></td>

                    </tr>
                    @endforeach
                </table><br>
                <span class="button" id="button">Click Me</span>
            </div>
            <div class="invoice">
                <div class="invoice_bill">
                    <div>
                        <span>Notes</span><br>
                        <textarea name="notes" id="notes" cols="30" rows="4" placeholder="Notes"> {{$invoice->notes}}</textarea>
                        @error('notes')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>Terms</span><br>
                        <textarea name="terms" id="terms" cols="30" rows="4" placeholder="Terms"> {{$invoice->terms}}</textarea>
                        @error('terms')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="invoice_bill">
                    <div>
                        <span>Sub Total</span>
                        <input type="number" name="sub_total" id="sub_total" placeholder="Sub Total" value="{{ $invoice->sub_total}}" readonly>
                        @error('sub_total')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span class="discount"> + Discount</span>
                        <span class="discount_field"></span>
                        <span class="tax"> + Tax</span>
                        <span class="tax_field"></span>
                        <span class="shipping"> + Shipping</span>
                        <span class="shipping_field"></span>
                    </div>
                    <div>
                        <span>Total</span>
                        <input type="number" name="total" id="total" value="{{ $invoice->total}}" readonly>
                        @error('total')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>Paid Amount</span>
                        <input type="number" name="paid_amount" id="paid_amount" value="{{ $invoice->paid_amount}}" >
                        @error('paid_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span>Due Amount</span>
                        <input type="number" name="due_amount" id="due_amount" value="{{ $invoice->due_amount}}" readonly>
                        @error('due_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <input type="submit" value="Submit">
                </div>
            </div>
        <!-- </form> -->
        @endforeach


</body>

</html>
