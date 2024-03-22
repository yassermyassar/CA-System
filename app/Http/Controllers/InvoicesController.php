<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\invoices;
use App\Models\sections;
use App\Models\User;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AddInvoice;
use App\Exports\UsersExport;
use App\Notifications\notAddInvoice;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoice = invoices::all();
        return view('Invoices.Invoices', compact('invoice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $section = sections::all();
        return view('Invoices.add_invoices', [
            'section' => $section,
        ]);
    }


    public function Print_invoice($id)
    {

        $invoices = invoices::where('id', $id)->first();
        return view('Invoices.Print_invoice', compact('invoices'));
    }
    /**
     * 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'invoice_number' => 'required',
            'invoice_Date' =>  'required',
            'Due_date' =>  'required',
            'Amount_collection' =>  'required',
            'Amount_Commission' =>  'required',
            'Discount' =>  'required',
            'Value_VAT' =>  'required',
            'Rate_VAT' =>  'required',
        ], [
            'invoice_number.required' => 'رقم الفاتورة مطلوب',
            'invoice_Date.required' => 'تاريخ الفاتورة مطلوب',
            'Due_date.required' => 'تاريخ الاستحقاق مطلوب',
            'Amount_collection.required' => 'مبلغ التحصيل مطلوب  ',
            'Amount_Commission.required' => 'اسم العمولة مطلوب',
            'Discount.required' => 'الخصم مطلوب',
            'Value_VAT.required' => 'قيمة الضريبة المضافة  ',
            'Rate_VAT.required' => '  نسبة الضريبة المضافة',

        ]);
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);

            // $user = User::first();
            // Notification::send($user, new AddInvoice($invoice_id));


        }

        // $userSchema = User::find(Auth::user()->id);
        // الاشعار بيتعمل للشخص اللي عامل الفاتورة بس و ليس لكل الاشخاص
        $invoices = Invoices::latest()->first();

        $userSchema = User::get();

        Notification::send($userSchema, new notAddInvoice($invoices));
        session()->flash('donee', ' تم انشاء الفاتورة بنجاح');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $invoice = invoices::where('id', $id)->first();
        return view('Invoices.status_update', [

            'invoices' => $invoice,
        ]);
    }


    public function status_update($id, Request $request)
    {
        $invoices = invoices::findOrFail($id);
        if ($request->Status === 'مدفوعة') {

            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            invoices_Details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        } else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            invoices_Details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('updateState', 'تم  تعديل الحالة بنجاح ');

        return redirect('/invoices');
    }
    public function invoice_paid()
    {
        $invoice = invoices::where('Value_Status', 1)->get();
        return view('Invoices.invoice_paid', [
            'invoices' => $invoice,
        ]);
    }
    public function invoice_unpaid()
    {
        $invoice = invoices::where('Value_Status', 2)->get();
        return view('Invoices.invoice_unpaid', [
            'invoices' => $invoice,
        ]);
    }
    public function invoice_partial_paid()
    {
        $invoice = invoices::where('Value_Status', 3)->get();
        return view('Invoices.invoice_partial_paid', [
            'invoices' => $invoice,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoices = invoices::where('id', $id)->first();

        $sections = sections::all();

        return view('Invoices.edit_invoice', [
            'invoices' => $invoices,
            'sections' => $sections,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $invoices = invoices::findOrFail($request->invoice_id);
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoice = invoices::where('id', $id)->first();

        $Details = invoices_attachments::where('invoice_id', $id)->first();

        if (!$request->id_page == 2) {
            if (!empty($Details->invoice_number)) {

                Storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
            }
            $invoice->forceDelete();
            // $invoice->delete(); //soft deletes
            session()->flash('delete', 'تم حذف الفاتورة بنجاح');
            return redirect('Invoices.Invoices');
        } else {
            $invoice->delete();
            // $invoice->delete(); //soft deletes
            session()->flash('archive', 'تم أرشفة الفاتورة بنجاح');
            return redirect('/Archive');
        }
    }
    public function getproduct($id)
    {
        $product = DB::table('products')->where('section_id', '=', $id)->pluck('Product_name', 'id');
        return json_encode($product);
    }
    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }


    public function markAsRead(Request $request)
    {

        $userUnreadNotification = auth()->user()->unreadNotifications;

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }
}
