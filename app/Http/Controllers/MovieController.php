<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('director')) {
            $query->where('director', 'like', '%' . $request->director . '%');
        }

        return response()->json($query->paginate(10));
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return response()->json($movie);
    }
}
