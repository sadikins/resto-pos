<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::when(request()->q, function($categories){
            $categories = $categories->where('name','like','%'.request()->q . '%');
        })->paginate(5);

     

        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'       => 'required|image|mimes:jpeg,jgp,png|max:2000',
            'name'        => 'required|unique:categories',
            'description' => 'required'
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/categories', $image->hashName());

        // create category
        Category::create([
            'image'       => $image->hashName(),
            'name'        => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name'        => 'required|unique:categories,name,' .$category->id,
            'description' => 'required'
        ]);

        // check image update
        if($request->file('image')) {
            // remove old image
            Storage::disk('local')->delete('public/categories/'.basename($category->image));

            // upload new image
            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            // update category with new image
            $category->update([
                'image'       => $image->hashName(),
                'name'        => $request->name,
                'description' => $request->description
            ]);
        }

        // update category without image
        $category->update([
            'name'        => $request->name,
            'description' => $request->description
        ]);

        // redirect
        return redirect()->route('categories.index');
    }


    public function destroy($id)
    {
        $category = Category::findorFail($id);

        // remove image
        Storage::disk('local')->delete('public/categories/'.basename($category->image));

        // delete
        $category->delete();

        //redirect
        return redirect()->route('categories.index');
    }

    
}
