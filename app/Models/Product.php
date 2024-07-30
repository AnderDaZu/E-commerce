<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku', 'name', 'description', 'image_path', 'price', 'subcategory_id',
    ];

    // protected $casts = [];

    protected function name(): Attribute
    {
        return new Attribute(
            set: fn( $value ) => strtolower($value),
            get: fn( $value ) => ucfirst($value),
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
            ->withPivot('value') // para que me recupere este valor de la tabla pivote
            ->withTimestamps(); // para indicar que se debe guardar los valores de created_at y updated_at
    }
}
