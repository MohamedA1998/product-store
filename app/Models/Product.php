<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the user's oldest image.
     */
    public function oldestImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->oldestOfMany();
    }
}
