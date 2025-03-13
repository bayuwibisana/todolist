<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Checklist $checklist)
    {
        
        if ($checklist->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $items = $checklist->items()->where('user_id', auth()->id())->get();
        return response()->json($items);
    }

    public function store(Request $request, Checklist $checklist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
       
        if ($checklist->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $item = $checklist->items()->create([
            'name' => $request->name,
            'user_id' => auth()->id(), 
        ]);
    
        return response()->json($item, 201);
    }

    public function show(Item $item)
    {
        
        if ($item->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($item);
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'status_checked' => 'sometimes|boolean',
        ]);

        $item->update($request->only('name', 'status_checked'));

        return response()->json($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }
}
