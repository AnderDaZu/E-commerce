<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'value', 'description', 'option_id'
    ];

    public function value(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucfirst($value),
            set: fn($value) => trim(strtolower($value)),
        );
    }
    public function description(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucfirst($value),
            set: fn($value) => trim(strtolower($value)),
        );
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class)
            ->withTimestamps();
    }
}
