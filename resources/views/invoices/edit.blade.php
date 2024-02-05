<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('boot/css/bootstrap.min.css')}}">
    <script src="{{ asset('boot/js/bootstrap.min.js')}}"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/invoice.js') }}"></script>
    <style>
    .x {
        display: none;
    }

    tr:hover .x {
        display: block;
    }
    </style>
</head>

<body class="bg-body-secondary lead d-flex">
    <div class="col-sm-11 border border-gray ms-5 p-5 mt-2 bg-body-tertiary d-flex row gap-3">
        @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
        @endif
        @foreach ($invoice as $invoice)
        <form action="{{ route('invoices.update',$invoice->id) }}" method="post" id="form_data"
            enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div>
                <div id="imageFile" class="col-4">
                    <img src="{{ asset('storage/' . $invoice->image) }}" id="imageDisplay" class="col-2" alt="">
                    <input type="file" name="image" id="image" hidden>
                    <label for="image" id="imageLabel"
                        class="border border-gray col-sm-3 text-center fw-bold">Image</label>
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="d-flex P-2">

                <div class="col-sm-7 ps-2 row gap-3">

                    <div>
                        <span class="col fw-bold">Bill From</span><br>
                        <textarea name="bill_from" id="bill_from" cols="30" rows="2"
                            placeholder="Bill From">{{ $invoice->bill_from }}</textarea>
                        @error('bill_from')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span class="col fw-bold">Bill To</span><br>
                        <textarea name="bill_to" id="bill_to" cols="30" rows="2"
                            placeholder="Bill To">{{ $invoice->bill_to }}</textarea>
                        @error('bill_to')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span class="col fw-bold">Ship To</span><br>
                        <textarea name="ship_to" id="ship_to" cols="30" rows="2"
                            placeholder="Ship To">{{ $invoice->ship_to }}</textarea>
                        @error('ship_to')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-5 ps-2 row gap-1">
                    <div class="col-3 offset-sm-8 ">
                        <p class="fw-bold"><b>INVOICE</b></p>
                    </div>
                    <div class="row gx-4  ">
                        <span class="col fw-bold">#</span>
                        <input class="col h-2em" type="number" id="id" value="{{ $invoice->id }}" readonly>
                    </div>
                    <div class="row gx-4">
                        <span class="col fw-bold">Date</span>
                        <input class="col" type="date" name="date" id="date" value="{{ $invoice->date }}">
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row gx-4 ">
                        <span class="col fw-bold">Payment Type</span>
                        <input class="col" type="text" name="payment_type" id="payment_type" placeholder="Payment Type"
                            value="{{ $invoice->payment_type }}">
                        @error('payment_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row gx-4 ">
                        <span class="col fw-bold">Due Date</span>
                        <input class="col" type="date" name="due_date" id="due_date" value="{{ $invoice->due_date }}">
                        @error('due_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row gx-4 ">
                        <span class="col fw-bold">PO Number</span>
                        <input class="col" type="number" name="po_number" id="po_number"
                            value="{{ $invoice->po_number }}">
                        @error('po_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class=" row gap-2 d-grid">
                <table id="table_data" class="col">
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                    @foreach ($invoice->items as $index => $item)
                    <tr class="">
                        <td>
                            <input type="hidden" name="items[{{ $index }}][id]" class="item_id" value="{{ $item->id }}"
                                placeholder="Item">
                            <input type="text" name="items[{{ $index }}][item_name]" class="item_name"
                                value="{{ $item->item_name }}" placeholder="Item">
                            @error('items.'.$index.'.item_name')
                            <br> <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" name="items[{{ $index }}][quantity]" class="quantity"
                                value="{{ $item->quantity }}" placeholder="Quantity">
                            @error('items.'.$index.'.quantity')
                            <br> <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" name="items[{{ $index }}][rate]" class="rate" value="{{ $item->rate }}"
                                placeholder="Rate">
                            @error('items.'.$index.'.rate')
                            <br> <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <input type="number" name="items[{{ $index }}][amount]" class="amount"
                                value="{{ $item->amount }}" placeholder="Amount">
                            @error('items.'.$index.'.amount')
                            <br> <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <div class="x text-dark border-transparent">&#x2718;</div>
                        </td>
                    </tr>
                    @endforeach

                </table>
                <div class="text-dark border border-gray text-body-tertiary col-1 fw-bold button " id="button">Click Me
                </div>
            </div>
            <div class="d-flex P-2 ">
                <div class="col-sm-7 ps-2 row gap-3">
                    <div>
                        <span class="col fw-bold">Notes</span><br>
                        <textarea name="notes" id="notes" cols="30" rows="2"
                            placeholder="Notes">{{ $invoice->notes }}</textarea>
                        @error('notes')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <span class="col fw-bold">Terms</span><br>
                        <textarea name="terms" id="terms" cols="30" rows="2"
                            placeholder="Terms">{{ $invoice->terms }}</textarea>
                        @error('terms')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-5 ps-2 row gap-1">
                    <div class="row gx-4 ">
                        <span class="col fw-bold">Sub Total</span>
                        <input class="col" type="number" name="sub_total" id="sub_total" placeholder="Sub Total"
                            value="{{ $invoice->sub_total }}" readonly>
                        @error('sub_total')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="ps-7 fw-bold d-grid">
                        <div class="row">
                            <div class="col-12 float-lg-end">
                                <div class="d-grid float-lg-end invoice_bill ">
                                    <span class="discount_field">
                                        <input class="col" type="number" id="discount" name="discount"
                                            value="{{$invoice->discount}}">
                                    </span>
                                    <span class="tax_field">
                                        <input type="number" class="tax" name="tax" value="{{$invoice->tax}}">
                                    </span>
                                    <span class="shipping_field">
                                        <input type="number" class="shipping" name="shipping"
                                            value="{{$invoice->shipping}}">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gx-4 ">
                        <span class="col fw-bold">Total</span>
                        <input class="col" type="number" name="total" id="total" value="{{ $invoice->total }}"
                            placeholder="Total">
                        @error('total')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row gx-4 ">
                        <span class="col fw-bold">Paid Amount</span>
                        <input class="col" type="number" name="paid_amount" id="paid_amount" placeholder="Paid Amount"
                            value="{{ $invoice->paid_amount }}">
                        @error('paid_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row gx-4 ">
                        <span class="col fw-bold">Due Amount</span>
                        <input class="col" type="number" name="due_amount" id="due_amount" placeholder="Due Amount"
                            value="{{ $invoice->due_amount }}">
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
        </form>
        @endforeach
</body>

</html>
