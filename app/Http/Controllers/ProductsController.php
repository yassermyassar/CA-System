<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = sections::all();
        $products = products::all();
        return view('products.products', [
            'sections' => $sections,
            'products' => $products,
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
        $validatedData = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'section_id' => 'required|max:255',
            'description' => 'required',
        ], [
            'product_name.required' => 'يرجى ادخال اسم المنتج',
            'section_id.required' => 'يرجى ادخا القسم',
            'product_name.unique' => 'اسم القسم موجود مسبقا',
            'description.required' => ' يرجى ادخال الوصف  '
        ]);


        products::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('add', 'تم اضافة المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products)
    {
        $id = sections::where('section_name', '=', $request->section_name)->first()->id;


        $product = products::findOrFail($request->id);
        $product->update([
            'product_name' => $request->product_name,
            'section_name' => $request->section_name,
            'description' => $request->description,
            'section_id' => $id,
        ]);
        session()->flash('edit', 'تم تعديل المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = products::findOrFail($request->id);
        $product->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return redirect('/products');
    }
}
