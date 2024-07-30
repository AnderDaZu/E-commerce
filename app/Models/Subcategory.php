<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id',
    ];

    protected function name(): Attribute
    {
        return new Attribute(
            set: fn( $value ) => strtolower($value),
            get: fn( $value ) => ucfirst($value),
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
