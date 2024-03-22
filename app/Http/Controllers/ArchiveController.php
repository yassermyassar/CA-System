<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $archive = invoices::onlyTrashed()->get();
        return view('Invoices.invoice_archieve', [
            'invoices' => $archive,
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $flight = Invoices::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $invoice = invoices::withTrashed('id', $id);
        $invoice->forceDelete();
        return view('Invoices.invoice_archieve');
    }
}
