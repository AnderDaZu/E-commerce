<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type',
    ];

    protected function name(): Attribute 
    {
        return new Attribute(
            set: fn($value) => strtolower($value),
            get: fn($value) => ucfirst($value),
        );
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->using(OptionProduct::class) // para incluir módelo de tabla pivote
            ->withPivot('features')
            ->withTimestamps();
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
