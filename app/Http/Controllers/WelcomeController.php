<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $covers = Cover::where('is_active', true)
            ->whereDate('start_at', '<=', now())
            ->where(function ($query) {
                $query->whereDate('end_at', '>=', now())
                    ->orWhereNull('end_at');
            })
            ->get();

        $lastProducts = Product::orderBy('created_at', 'desc')
            ->take(12)
            ->get();

        return view('welcome', compact('covers', 'lastProducts'));
    }
}
