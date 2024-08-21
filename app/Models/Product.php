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
}
