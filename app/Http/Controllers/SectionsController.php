<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.sections',[
            'sections'=> $sections,
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
        'section_name' => 'required|unique:sections|max:255',
        'description' => 'required',
    ],[
      'section_name.required' => 'يرجى ادخال اسم القسم'  ,
      'section_name.unique' => 'اسم القسم موجود مسبقا'  ,
      'description.required' => ' يرجى ادخال الوصف  '  
    ]);
sections::create([
    'section_name' =>$request->section_name,
    'description' =>$request->description,
    'created_by' =>(Auth::user()->name),
]);
session()->flash('add','تم اضافة القسم بنجاح');
return redirect('/sections');
        }

        
    

    /**
     * Display the specified resource.
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        
         $validatedData = $request->validate([
        'section_name' => 'required|unique:sections|max:255'.$id,
        //هنا بقوله لو كان الأي دي اللي مبعوت بالفورم هة هواه اللي موجود ف الداتا بيز ف يعدله عادي
        'description' => 'required',
    ],[
      'section_name.required' => 'يرجى ادخال اسم القسم'  ,
      'section_name.unique' => 'اسم القسم موجود مسبقا'  ,
      'description.required' => ' يرجى ادخال الوصف  '  
    ]);
    $section = sections::find($id);
$section->update([
    'section_name' =>$request->section_name,
    'description' =>$request->description,
    
]);
session()->flash('edit','تم تعديل القسم بنجاح');

return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id =  $request->id;
        sections::find($id)->delete();
        session()->flash('delete', 'تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}
