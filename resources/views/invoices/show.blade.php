<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Advanced Invoice</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }
  .invoice-container {
    width: 80%;
    margin: 20px auto;
    border: 1px solid #ccc;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .invoice-header {
    text-align: center;
    margin-bottom: 20px;
  }
  .invoice-header h1 {
    margin: 0;
    color: #333;
  }
  .invoice-details {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  .invoice-details .left,
  .invoice-details .right {
    width: 35%;
  }
  .invoice-details .right2 {
    width: 25%;
  }
  .invoice-items {
    margin-bottom: 20px;
  }
  .invoice-items table {
    width: 100%;
    border-collapse: collapse;
  }
  .invoice-items th,
  .invoice-items td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
    text-align: left;
  }
  .invoice-items th {
    background-color: #f2f2f2;
  }
  .invoice-total {
    display: block;
    justify-content: flex-end;
    margin-top: 20px;
  }
  .invoice-total p {
    font-weight: bold;
  }

  .download-btn {
    display: block;

    width: 48%;
    padding: 10px;
    text-align: center;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  .download-btn:hover {
    background-color: #0056b3;
  }
  .dow-save{
    display: flex;
    gap: 2%;
    padding-left: 1%;
  }
  textarea{
    border: 0px;
    padding: 2%;
  }
</style>
</head>
<body>
@foreach ($invoices as $invoice )

@endforeach
<div class="invoice-container">
  <div class="invoice-header">
    <h1>Invoice </h1>
  </div>
  <div class="invoice-details">
    <div class="left">
    <p><strong>Billed To:</strong> {{$invoice->bill_to}}</p>
    <p><strong>Billed To:</strong> {{$invoice->bill_to}}</p>
      <p><strong>Ship To:</strong> {{$invoice->ship_to}}</p>
      <p><strong>Invoice Date:</strong> {{$invoice->date}} </p>
    </div>
    <div class="right">
    <p><strong>Invoice Number:</strong> {{$invoice->id}} </p>
    <p><strong>Payment Type:</strong> {{$invoice->payment_type}} </p>
       <p><strong>Due Date:</strong> {{$invoice->due_date}} </p>
      <p><strong>Po Number:</strong> {{$invoice->po_number}} </p>
    </div>
  </div>
  <div class="invoice-items">
    <table>
      <thead>
        <tr>
          <th>Description</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($invoice->items as $item)
        <tr>
          <td>{{ $item->item_name}}</td>
          <td>{{ $item->quantity}}</td>
          <td>{{ $item->rate}}</td>
          <td>{{ $item->amount}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="invoice-details">
    <div class="left">
    <p><strong>Notes:</strong><br>
    <textarea  cols="35" rows="6" readonly>{{$invoice->notes}}</textarea>
   </p>
   <p><strong>Terms:</strong><br>
    <textarea  cols="35" rows="6" readonly>{{$invoice->terms}}</textarea>
   </p>
    </div>
    <div class="right2" style=" margin-left: 20px;">
    <p><strong>Sum Total:</strong>{{$invoice->sub_total}}</p>
    <p><strong>Discount:</strong> {{$invoice->discount}}</p>
    <p><strong>Tax:</strong>{{$invoice->tax}}</p>
    <p><strong>Shiping:</strong>{{$invoice->shiping}}</p>
    <p><strong>Total:</strong> {{$invoice->total}}</p>
    <p><strong>Pad Amount:</strong>{{$invoice->paid_amount}}</p>
    <p><strong>Due Amount:</strong>{{$invoice->due_amount}}</p>
    </div>
  </div>
  <div class="invoice-total">

  </div>
  <div class="dow-save">
  <button class="download-btn" onclick="downloadPDF()">Download PDF</button><br>
  <button class="download-btn" onclick="printInvoice()">Print Invoice</button>
</div>
</div>
<script>
  function printInvoice() {
    window.print();
  }
</script>

<script>
  function downloadPDF() {
    var element = document.querySelector('.invoice-container');
    html2pdf()
      .from(element)
      .save('invoice.pdf');
  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

</body>
</html>
