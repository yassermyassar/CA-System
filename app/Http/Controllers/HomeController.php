<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $all = invoices::count();
        $unPaid = invoices::where('Value_status', 2)->count();
        $percunpaid = $unPaid / $all * 100;
        $Paid = invoices::where('Value_status', 1)->count();
        $percpaid = $Paid / $all * 100;

        $partPaid = invoices::where('Value_status', 3)->count();
        $percpartpaid = $partPaid / $all * 100;


        $data = [
            'labels' => ['الفواتير الغير مدفوعة', 'الفواتير المدفوعة جزئيا', 'الفواتير المدفوعة'],
            'data' => [$percunpaid, $percpartpaid, $percpaid],
        ];


        // Replace this with your actual data retrieval logic

        return view('home', compact('data'));
    }
}
