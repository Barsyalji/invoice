<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // $invoice = Invoice::all();
            $invoice = 'atul';
            return view('invoices.index', ['invoices' => $invoice]);
        } catch (\Exception $e) {
            return "Error : " . $e->getmessage() . "<br> Line No : " . $e->getline();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $invoice = Invoice::latest()->first('id');
            return view('invoices.create', ['id' => $invoice->id]);
        } catch (\Exception $e) {
            return "Error : " . $e->getmessage() . "<br> Line No : " . $e->getline();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'image'         => 'required',
                'bill_from'     => 'required|string',
                'bill_to'       => 'required|string',
                'date'          => 'required|date',
                'payment_type'  => 'required|string',
                'due_date'      => 'required|date',
                'po_number'     => 'nullable|numeric',
                'notes'         => 'nullable|string',
                'terms'         => 'nullable|string',
                'sub_total'     => 'required|numeric',
                'discount'      => 'nullable|numeric',
                'tax'           => 'nullable|numeric',
                'shiping'       => 'nullable|numeric',
                'total'         => 'required|numeric',
                'paid_amount'   => 'nullable|numeric',
                'due_amount'    => 'nullable|numeric',
                'items.*.item_name'  => 'required',
                'items.*.quantity'   => 'required|numeric',
                'items.*.rate'       => 'required|numeric',
                'items.*.amount'     => 'required|numeric',
            ],
            [
                'items.*.item_name.required' => 'The item name field is required',
                'items.*.quantity.required'  => 'The quantity field is required',
                'items.*.rate.required'      => 'The rate field is required',
                'items.*.amount.required'    => 'The amount field is required',
            ]
        );
        try {
            $data = $request->except(['_token', 'items',]);
            $model = Invoice::create($data);
            foreach ($request->items as $item) {
                $id = $model->id;
                $item = array_merge(['invoice_id' => $id], $item);
                $model->items()->create($item);
            }
            return view('invoices.index');
        } catch (\Exception $e) {
            report($e);
            Log::error('Error occurred while storing invoice: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
