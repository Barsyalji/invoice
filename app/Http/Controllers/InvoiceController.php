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
            return view('invoices.index', ['invoices' => $invoice])->with('messege','Invoices Featched Successfully');
        } catch (\Exception $e) {
            throw($e);
            Log::error('Error occurred while storing invoice: ',['erroe' => $e->getMessage()]);
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
            $id =!empty($invoice->id)? ++$invoice->id : 1;
            return view('invoices.create', ['id' => $id]);
        } catch (\Exception $e) {
            throw($e);
            Log::error('Error occurred while storing invoice: ' ,['erroe' => $e->getMessage()]);
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
                'shipping'       => 'nullable|numeric',
                'total'         => 'required|numeric',
                'paid_amount'   => 'nullable|numeric',
                'due_amount'    => 'required|numeric',
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
            $requestData = $request->except(['_token', 'items']);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = Storage::disk('public')->put('images', $image);
                $requestData['image'] = $path;
            }
            if (empty($requestData['paid_amount'])) {
                $requestData['paid_amount'] = 0;
            }
            $model = Invoice::create($requestData);
            foreach ($request->items as $item) {
                $id = $model->id;
                $item = array_merge(['invoice_id' => $id], $item);
                $model->items()->create($item);
            }
            DB::commit();
            return redirect('invoices')->with('message', 'Invoices Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            throw($e);
            Log::error('Error occurred while storing invoice: ',['erroe' => $e->getMessage()]);
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
            return view('invoices.show', ['invoices' => $invoice])->with('messege','Invoices Show Successfully');;
        } catch (\Exception $e) {
            throw($e);
            Log::error('Error occurred while storing invoice: ' ,['erroe' => $e->getMessage()]);
            return redirect()->back()->with('messege', 'Something Went Wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        try {
        $invoice = $invoice->with('items')->where('id', $invoice->id)->get();
        return view("invoices.edit", ['invoice' => $invoice]);
    } catch (\Exception $e) {
        throw($e);
        Log::error('Error occurred while storing invoice: ' ,['erroe' => $e->getMessage()]);
        return redirect()->back()->with('messege', 'Something Went Wrong');
    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate(
            [
                'image'         => 'nullable|image|max:2048',
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
                'shipping'       => 'nullable|numeric',
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
            $requestData = $request->except(['_token', 'items']);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = Storage::disk('public')->put('images', $image);
                $requestData['image'] = $path;
            }
            if (empty($requestData['paid_amount'])) {
                $requestData['paid_amount'] = 0;
            }
            $invoice->update($requestData);
            if($request->uid){
            foreach ($request->uid as $value) {
                $invoice->items()->where('id',$value)->delete();
            }
        }
            foreach ($request->items as $item) {
                $invoice->items()->updateOrCreate(['id' => $item['id']], $item);
            }
            DB::commit();
            return redirect('invoices')->with('message', 'Invoices Fetched Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            throw($e);
            Log::error('invoice_update_exception',['erroe' => $e->getMessage()]);
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
            return redirect('invoices')->with('message', 'Invoices Deleted Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            throw($e);
            Log::error('Delete_invoice_error',['erroe' => $e->getMessage()]);
            return redirect()->back();
        }
    }
}
