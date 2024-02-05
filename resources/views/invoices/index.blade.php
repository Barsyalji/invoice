<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        @if (session('message'))
        <div id="alertMessage" class="alert alert-danger">{{ session('message') }}</div>
        @endif
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h1 class="mb-0">INVOICES</h1>
            <a href="{{ route('invoices.create') }}" class="btn btn-primary">Create New Invoice</a>
        </div>
        <br>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
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
                        <th>Shipping</th>
                        <th>Total</th>
                        <th>Pay Amount</th>
                        <th>Due Amount</th>
                        <th>Total Items</th>
                        <th>Action</th>
                    </tr>
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
                        <td>{{ $invoice->items_count }}</td>
                        <td>
                            <form action="{{ route('invoices.destroy',$invoice->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('invoices.show',$invoice->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('invoices.edit',$invoice->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS (Optional - if you need any Bootstrap JavaScript components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 5000);
        }
    });
</script>
</body>
</html>
