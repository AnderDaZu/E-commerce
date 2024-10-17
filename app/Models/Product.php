<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'subcategory_id',
        'stock',
    ];

    // protected $casts = [];

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value),
        );
    }

    protected function image(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->image_path) {
                    if (substr($this->image_path, 0, 8) == 'https://') {
                        return $this->image_path;
                    }
                    return Storage::url($this->image_path);
                } else {
                    return asset('app/imgs/default-image-min.webp');
                }
            },
        );
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class)
            ->using(OptionProduct::class) // para incluir módelo de tabla pivote
            ->withPivot('features') // para que me recupere este valor de la tabla pivote
            ->withTimestamps(); // para indicar que se debe guardar los valores de created_at y updated_at
    }

    public function scopeCustomOrder($query, $orderBy)
    {
        $query->when($orderBy == 1, function ($query) {
            $query->orderBy('created_at', 'desc');
        })
        ->when($orderBy == 2, function ($query) {
            $query->orderBy('price', 'desc');
        })
        ->when($orderBy == 3, function ($query) {
            $query->orderBy('price', 'asc');
        });
    }

    public function scopeVerifyFamily($query, $family_id)
    {
        $query->when($family_id, function ($query, $family_id) {
            $query->whereHas('subcategory.category', function ($query) use ($family_id) {
                $query->where('family_id', $family_id);
            });
        });
    }

    public function scopeVerifyCategory($query, $category_id)
    {
        $query->when($category_id, function ($query, $category_id) {
            $query->whereHas('subcategory', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            });
        });
    }

    public function scopeVerifySubcategory($query, $subcategory_id)
    {
        $query->when($subcategory_id, function ($query, $subcategory_id) {
            $query->where('subcategory_id', $subcategory_id);
        });
    }

    public function scopeSelectFeatures($query, $selected_features)
    {
        $query->when($selected_features, function ($query, $selected_features) {
            $query->whereHas('variants.features', function ($query) use ($selected_features) {
                $query->whereIn('features.id', $selected_features);
            });
        });
    }
}
