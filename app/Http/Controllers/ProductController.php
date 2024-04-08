<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private string $uploadIn = 'upload/product';


    public function __construct()
    {
        $this->authorizeResource(Product::class);
    }



    public function index()
    {
        $products = request()->user()->products;

        if (request()->user()->role === User::LEADER) {
            $products = Product::with('oldestImage')->latest()->get();
        }

        return view('admin.product.index', [
            'products'  => $products
        ]);
    }



    public function create()
    {
        return view('admin.product.form');
    }



    public function store(ProductRequest $request)
    {
        $request->validate(['image' => 'required']);

        $product = Product::create([
            ...$request->safe()->only('name', 'description', 'quantity', 'price'),
            'user_id'   => auth()->id()
        ]);

        if ($request->hasFile('image')) {
            $product->images()->create([
                'path'   => $request->file('image')->store($this->uploadIn)
            ]);
        }

        if (!empty($request->images)) {
            foreach ($request->images as $image) {
                $product->images()->create([
                    'path'   => $image->store($this->uploadIn)
                ]);
            }
        }

        toastr()->success('Product Was Created Successfuly');

        return redirect()->route('admin.product.index');
    }



    public function edit(Product $product)
    {
        return view('admin.product.form', [
            'product'   => $product->load('images', 'oldestImage')
        ]);
    }



    public function update(ProductRequest $request, Product $product)
    {
        $product->update(
            $request->safe()->only('name', 'description', 'quantity', 'price')
        );

        if ($request->hasFile('image')) {
            Storage::delete($product->oldestImage->path);

            $product->oldestImage()->update([
                'path'   => $request->file('image')->store($this->uploadIn)
            ]);
        }

        if ($request->hasAny('images')) {
            foreach ($product->images->except($product->oldestImage->id) as $image) {
                Storage::delete($image->path);

                $image->delete();
            }

            foreach ($request->images as $image) {
                $product->images()->create([
                    'path'  => $image->store($this->uploadIn)
                ]);
            }
        }

        toastr()->success('Product Was Updated Successfuly');

        return redirect()->back();
    }




    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::delete($image->path);

            $image->delete();
        }

        $product->delete();

        toastr()->success('Product Was Deleted Successfuly');

        return redirect()->back();
    }
}
