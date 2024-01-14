<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            // $invoice = Invoice::all();
            $invoice = 'atul';
            return view('invoices.index',['invoices'=>$invoice]);
        }catch(\Exception $e){
            return "Error : ".$e->getmessage()."<br> Line No : " .$e->getline();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            // $invoice = Invoice::all();
            $invoice = 'atul';
            return view('invoices.create',['invoices'=>$invoice]);
        }catch(\Exception $e){
            return "Error : ".$e->getmessage()."<br> Line No : " .$e->getline();
        } 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
