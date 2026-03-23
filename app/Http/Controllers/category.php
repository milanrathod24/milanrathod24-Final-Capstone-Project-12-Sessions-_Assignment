<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use \App\Models\category;

class category extends Controller
{
    public function index()
    {
        $categories = \App\Models\category::get();
        $editdata = '';
        return view('category',[
        'editdata'=>$editdata,    
        'catdata'=> $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'catname'=>'required|min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ],[
            'catname.required'=>'Please enter category',
            'catname.min'=>'Atleast 3 character should be enter'
        ]);
       //img name generate
        $imgName = "img".time().".".$request->image->extension();
        $request->image->move(public_path("catimages"), $imgName);
        $data = \App\Models\category::create(['catname'=>$request->catname,
            'image'=>$imgName    
        ]);
        return redirect('/category')->with('success','Category save successfully');
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
        $categories = \App\Models\category::get();
        $data = \App\Models\category::find($id);
        return view('category',[
            'editdata'=> $data,
            'catdata'=> $categories
            ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = \App\Models\category::findOrFail($id);
        $data->update(['catname'=>$request->catname]);
        return redirect('/category')->with('success',value: 'Category update successfully');
    }
    public function destroy(string $id)
    {
        $data = \App\Models\category::findOrFail($id);
        if(file_exists(public_path('catimages/'. $data->image))){
            unlink(public_path('catimages/'. $data->image));
        }
        $data->delete();
        return redirect('/category')->with('success',value: 'Category delete successfully');
    }
}