<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        $invoices = invoices::where('id', $id)->first();

        $details  = invoices_Details::where('id_invoice', $id)->get();
        $attachments  = invoices_attachments::where('invoice_id', $id)->get();


        return view('Invoices.invoicesDetails', [
            'invoices' => $invoices,
            'details' => $details,
            'attachments' => $attachments,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function download(Request $request, $invoice_number, $file_name)
    {
        return response()->download(public_path('Attachments/' . $invoice_number . '/' . $file_name));
    }


    public function View_file($invoice_number, $file_name)
    {
        return response()->file(public_path('Attachments/' . $invoice_number . '/' . $file_name));
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $invoices = invoices_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::delete('Attachments/' . $request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}
