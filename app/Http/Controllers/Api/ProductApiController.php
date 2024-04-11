<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    private string $uploadIn = 'upload/product';


    public function __construct()
    {
        $this->middleware('auth:sanctum');

        $this->authorizeResource(Product::class);
    }


    public function index()
    {
        $products = request()->user()->products();

        if (request()->user()->role === User::LEADER) {
            $products = Product::query();
        }

        $products = cache()->remember(
            'user-' . request()->user()->id,
            60 * 60 * 3,
            fn () => $products->with('oldestImage')->latest()->get()
        );

        return ProductResource::collection(
            $products
        );
    }


    public function store(ProductRequest $request)
    {
        $request->validate(['image' => 'required']);

        $product = Product::create([
            ...$request->safe()->only('name', 'description', 'quantity', 'price'),
            'user_id'   => $request->user()->id
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

        return new ProductResource($product->load('images'));
    }


    public function show(Product $product)
    {
        return new ProductResource(
            $product->load('oldestImage', 'images')
        );
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

        return new ProductResource($product->load('images'));
    }


    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::delete($image->path);

            $image->delete();
        }

        $product->delete();

        return response(status: 204);
    }
}
