<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected function name(): Attribute
    {
        return new Attribute(
            set: fn( $value ) => strtolower($value),
            get: fn( $value ) => ucfirst($value),
        );
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
