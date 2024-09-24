<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cover;
use Illuminate\Http\Request;

class SortController extends Controller
{
    public function covers(Request $request)
    {
        $order = 1;
        $sorts = $request->get('sorts');

        foreach ($sorts as $sort) {
            $cover = Cover::find($sort);
            $cover->order = $order;
            $cover->save();
            $order++;
        }
    }
}
