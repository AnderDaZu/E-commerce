<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

// modelo para tabla pivote
class OptionProduct extends Pivot
{
    use HasFactory;

    protected $casts = [
        'features' => 'array',
    ];
}
