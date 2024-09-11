<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cover extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'title',
        'start_at',
        'end_at',
        'is_active',
        // 'order', // campo se pobla a traves de los observers
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_path)
        );
    }
}
