<?php

namespace App\Http\Controllers;

use App\Models\sections;
use App\Models\invoices;
use Illuminate\Http\Request;

class customersReportcontroller extends Controller
{
    public function index()
    {
        $sections = sections::all();
        return view('reports.customersReport', ['sections' =>  $sections]);
    }



    public function Search_customers(Request $request)
    {


        // في حالة البحث بدون التاريخ

        if ($request->Section && $request->product && $request->start_at == '' && $request->end_at == '') {


            $invoices = invoices::select('*')->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = sections::all();
            return view('reports.customersReport', compact('sections'))->with(['Details' => $invoices]);
        }


        // في حالة البحث بتاريخ

        else {

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = invoices::whereBetween('invoice_Date', [$start_at, $end_at])->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = sections::all();
            return view('reports.customersReport', compact('sections'))->with(['Details' => $invoices]);
        }
    }
}
