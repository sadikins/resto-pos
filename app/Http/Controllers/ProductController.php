<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        
        return Inertia::render('Admin/Products/Index',
        [
            'products' => Product::when(request()->q, function($products){
                $products = $products->where('title','like','%'. request()->q.'%');
            })->latest()->paginate(5),
        ]);
    }


    public function create()
    {
        return Inertia::render('Admin/Products/Create',[

            'categories' => Category::all(),
            
        ]);
    }

    public function edit(Product $product)
    {
        return Inertia::render('Admin/Products/Edit', [
            'categories' => Category::all(),
            'product' => $product,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'       => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'barcode'     => 'required|unique:products',
            'title'       => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'buy_price'   => 'required',
            'sell_price'  => 'required',
            'stock'       => 'required',
        ]);

        $image = $request->file('image');

        $image->storeAs('public/products', $image->hashName());

        Product::create([
            'image'       => $image->hashName(),
            'barcode'     => $request->barcode,
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'buy_price'   => $request->buy_price,
            'sell_price'  => $request->sell_price,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('products.index');

    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'barcode'     => 'required|unique:products,barcode,'.$product->id,
            'title'       => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'buy_price'   => 'required',
            'sell_price'  => 'required',
            'stock'       => 'required',
        ]);

        if($request->file('image')) {

            // remove old image
            Storage::disk('local')->delete('public/products/'.basename($product->image));

            // upload new image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            // upload product with new image
            $product->update([
                'image'       => $image->hashName(),
                'barcode'     => $request->barcode,
                'title'       => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'buy_price'   => $request->buy_price,
                'sell_price'  => $request->sell_price,
                'stock'       => $request->stock,
            ]);
            
        }

        // update product without image
        $product->update([
            'barcode'     => $request->barcode,
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'buy_price'   => $request->buy_price,
            'sell_price'  => $request->sell_price,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('products.index');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        Storage::disk('local')->delete('public/products/'.basename($product->image));

        $product->delete();

        return redirect()->route('products.index');
    }





}
