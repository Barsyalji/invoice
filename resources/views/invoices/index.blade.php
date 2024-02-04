<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/invoice.css') }}" rel="stylesheet" type="text/css">

</head>
<body>
    <div>
    <h1 class="invoice_h1">INVOICES</h1>
    <a href="{{ route('invoices.create') }}"><button>Create New Invoice</button></a>
    </div>
    <br>
    <div>
        <table border="2px solid black">
            <thead>
                <th>Id</th>
                <th>Bill From</th>
                <th>Bill To</th>
                <th>Ship To</th>
                <th>Date</th>
                <th>Payment Type</th>
                <th>Due Date</th>
                <th>PO Number</th>
                <th>Notes</th>
                <th>Terms</th>
                <th>Sub Total</th>
                <th>Discount</th>
                <th>Tax</th>
                <th>shipping</th>
                <th>Total</th>
                <th>Pay Amount</th>
                <th>Due Amount</th>
                <th>Total Items</th>
                <th>Action</th>
            </thead>
            <tbody>
            @foreach ($invoices as $invoice)
            <tr>
            <td>{{ $invoice->id }}</td>
            <td>{{ $invoice->bill_from }}</td>
            <td>{{ $invoice->bill_to }}</td>
            <td>{{ $invoice->ship_to }}</td>
            <td>{{ $invoice->date }}</td>
            <td>{{ $invoice->payment_type }}</td>
            <td>{{ $invoice->due_date }}</td>
            <td>{{ $invoice->po_number }}</td>
            <td>{{ $invoice->notes }}</td>
            <td>{{ $invoice->terms }}</td>
            <td>{{ $invoice->sub_total }}</td>
            <td>{{ $invoice->discount }}</td>
            <td>{{ $invoice->tax }}</td>
            <td>{{ $invoice->shipping }}</td>
            <td>{{ $invoice->total }}</td>
            <td>{{ $invoice->paid_amount }}</td>
            <td>{{ $invoice->due_amount }}</td>
            <td> {{ $invoice->items_count}}</td>
            <td>
               <form action="{{ route('invoices.destroy',$invoice->id) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete">
               </form>
            <a href="{{ route('invoices.show',$invoice->id) }}"><button class="show">Show</button></a>
            <a href="{{ route('invoices.edit',$invoice->id) }}"><button class="update">Edit</button></a>
        </td>
            </tr>

            @endforeach
            </tbody>
        </table>

    </div>

</body>
</html>
