<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\Todo;

class ChecklistController extends Controller
{

    public function index(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $checklists = $todo->checklists()->where('user_id', auth()->id())->get();
        return response()->json($checklists);
    }

    public function store(Request $request, Todo $todo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
       
        if ($todo->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $checklist = $todo->checklists()->create([
            'name' => $request->name,
            'user_id' => auth()->id(), 
        ]);
    
        return response()->json($checklist, 201);
    }

    public function destroy(Checklist $checklist)
    {
        $checklist->delete();

        return response()->json(['message' => 'Checklist deleted successfully']);
    }

}