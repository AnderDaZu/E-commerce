<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Option;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function show(Family $family)
    {
        return view('families.show', compact('family'));
    }
}
