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
    width: 48%;
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
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
  }
  .invoice-total p {
    font-weight: bold;
  }
  .download-btn {
    display: block;
    width: 100%;
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
</style>
</head>
<body>

<div class="invoice-container">
  <div class="invoice-header">
    <h1>Invoice</h1>
  </div>
  <div class="invoice-details">
    <div class="left">
      <p><strong>Invoice Number:</strong> INV-001</p>
      <p><strong>Invoice Date:</strong> January 1, 2024</p>
    </div>
    <div class="right">
      <p><strong>Billed To:</strong> John Doe</p>
      <p><strong>Email:</strong> john.doe@example.com</p>
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
        <tr>
          <td>Item 1</td>
          <td>2</td>
          <td>$10.00</td>
          <td>$20.00</td>
        </tr>
        <tr>
          <td>Item 2</td>
          <td>1</td>
          <td>$15.00</td>
          <td>$15.00</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="invoice-total">
    <p><strong>Total:</strong> $35.00</p>
  </div>
  <button class="download-btn" onclick="downloadPDF()">Download PDF</button>
  <button class="download-btn" onclick="printInvoice()">Print Invoice</button>

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
