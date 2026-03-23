<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $subcategories = SubCategory::with('category')->get();
        $editdata = '';

        return view('subcategory', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'editdata' => $editdata,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcatname' => 'required|min:3',
        ], [
            'category_id.required' => 'Please select category',
            'subcatname.required' => 'Please enter sub category',
            'subcatname.min' => 'Atleast 3 character should be enter',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'subcatname' => $request->subcatname,
        ]);

        return redirect('/subcategory')->with('success', 'Sub Category save successfully');
    }

    public function edit(string $id)
    {
        $categories = Category::get();
        $subcategories = SubCategory::with('category')->get();
        $data = SubCategory::findOrFail($id);

        return view('subcategory', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'editdata' => $data,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = SubCategory::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'subcatname' => 'required|min:3',
        ]);

        $data->update([
            'category_id' => $request->category_id,
            'subcatname' => $request->subcatname,
        ]);

        return redirect('/subcategory')->with('success', 'Sub Category update successfully');
    }

    public function destroy(string $id)
    {
        $data = SubCategory::findOrFail($id);
        $data->delete();

        return redirect('/subcategory')->with('success', 'Sub Category delete successfully');
    }
}
