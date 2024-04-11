<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{

    public function created(Product $product): void
    {
        Cache::forget('user-' . request()->user()?->id);
    }


    public function updated(Product $product): void
    {
        Cache::forget('user-' . request()->user()->id);
    }


    public function deleted(Product $product): void
    {
        Cache::forget('user-' . request()->user()->id);
    }
}
