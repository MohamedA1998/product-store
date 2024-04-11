<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{

    public function created(Product $product): void
    {
<<<<<<< HEAD
        Cache::forget('user-' . request()->user()->id);
=======
        Cache::forget('user-' . request()->user()->id);
>>>>>>> e5cf325569f6dc2361a4c448df5b461d6e690fd8
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
