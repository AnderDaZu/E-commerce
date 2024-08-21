<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku', 'image_path', 'product_id',
    ];

    protected function image(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($this->image_path) {
                    return Storage::url($this->image_path);
                }
                return asset('app/imgs/default-image-min.webp');
            },
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }
}
