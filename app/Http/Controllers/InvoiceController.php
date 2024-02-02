<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $invoice = Invoice::withCount('items')->get();
            return view('invoices.index', ['invoices' => $invoice]);
        } catch (\Exception $e) {
            report($e);
            Log::error('Error occurred while storing invoice: ' . $e->getMessage());
            return redirect()->back()->with('messege', 'Something Went Wrong');
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
            report($e);
            Log::error('Error occurred while storing invoice: ' . $e->getMessage());
            return redirect()->back()->with('messege', 'Something Went Wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'image'         => 'required|image|max:2048',
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
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $request['image'] = Storage::disk('public')->put('images', $image);
            }
            $data = $request->except(['_token', 'items',]);
            $model = Invoice::create($data);
            foreach ($request->items as $item) {
                $id = $model->id;
                $item = array_merge(['invoice_id' => $id], $item);
                $model->items()->create($item);
            }
            DB::commit();
            return redirect('invoices');
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            Log::error('Error occurred while storing invoice: ' . $e->getMessage());
            return redirect()->back()->with('messege', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        try {
            $invoice = $invoice->with('items')->where('id', $invoice->id)->get();
            return view('invoices.show', ['invoices' => $invoice]);
        } catch (\Exception $e) {
            report($e);
            Log::error('Error occurred while storing invoice: ' . $e->getMessage());
            return redirect()->back()->with('messege', 'Something Went Wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $invoice = $invoice->with('items')->where('id', $invoice->id)->get();
        return view("invoices.edit", ['invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate(
            [
                'image'         => 'required|image|max:2048',
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
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $request['image'] = Storage::disk('public')->put('images', $image);
            }
            $invoiceData = $request->all();
            $invoice->update($invoiceData);
            foreach ($request->items as $item) {
                $invoice->items()->updateOrCreate(['id' => $item['id']], $item);
            }
            DB::commit();
            return redirect('invoices')->with('messege', 'update sucess');
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            Log::error('invoice_update_exception', $e->getMessage());
            return redirect()->back()->with('messege', 'Something Went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        try {
            DB::beginTransaction();
            $invoice->items()->delete();
            $invoice->delete();
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            Log::error('Delete_invoice_error', $e->getMessage());
            return redirect()->back();
        }
    }
}
