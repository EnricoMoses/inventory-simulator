<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->get();
        return view('index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string'
        ]);

        Item::create($request->all());

        return redirect()->route('inventory.index')
            ->with('success', 'Item added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $items = Item::all();
        $editItem = Item::findOrFail($id);

        return view('index', compact('items', 'editItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string'
        ]);

        Item::findOrFail($id)->update($request->all());

        return redirect()->route('inventory.index')
            ->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Item::findOrFail($id)->delete();
            return redirect()->route('inventory.index')
                ->with('success', 'Item deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('inventory.index')
                ->with('error', 'Failed to delete item.');
        }
    }
}
