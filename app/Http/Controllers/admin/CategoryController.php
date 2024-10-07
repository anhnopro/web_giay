<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function listCategory(){
        $categories=CategoryModel::all();
        return view('admin.category.listCate',compact('categories'));
    }
    // public function addCategory(request $request){
    //       $data=$request->except('image','_token');

    //       if($request->hasFile('image')){
    //         $path_image=$request->file('image')->store('images');
    //         $data['image']=$path_image;
    //       }
    //       CategoryModel::insert($data);
    //       return redirect()->back();
    // }
    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $category = new CategoryModel();
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $category->image = $path;
        }

        $category->save();

        return redirect()->back()->with('success', 'Thêm mới thành công!');
    }
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $category = CategoryModel::findOrFail($id);
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($category->image) {
                \Storage::disk('public')->delete($category->image);
            }

            $path = $request->file('image')->store('categories', 'public');
            $category->image = $path;
        }

        $category->save();

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
}
