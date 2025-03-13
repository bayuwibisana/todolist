<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())->get();
        return response()->json($todos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $todo = Todo::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        return response()->json($todo, 201);
    }
}