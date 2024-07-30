<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'family_id',
    ];

    protected function name(): Attribute
    {
        return new Attribute(
            set: fn( $value ) => strtolower($value),
            get: fn( $value ) => ucfirst($value),
        );
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
