<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DataController extends Controller
{
    function getCategories(Request $request)
    {
        $text2Search = $request->get('q');
        $results = Category::where('name', 'like', "%{$text2Search}%")->orderBy('name', 'asc')
            ->get()->take(10);
        return response()->json($results);
    }
}
