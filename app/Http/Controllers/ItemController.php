<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
    	$items = Item::orderBy('id', 'DESC')->paginate(5);
    	return view('items.index', compact('items'))
    		->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
    	return view('items.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'description' => 'required',
    	]);

    	Item::create($request->all());

    	return redirect()->route('items.index')
    					->with('success', 'Item created successfully');
    }

    public function show($id)
    {
    	$item = Item::find($id);
    	return view('items.show', compact('item'));
    }

    public function edit($id)
    {
    	$item = Item::find($id);
    	return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'description'  => 'required',
    	]);

    	Item::find($id)->update($request->all());

    	return redirect()->route('items.index')
    					->with('success', 'Item updated successfully');
    }

    public function delete($id)
    {
    	Item::find($id)->delete();
    	return redirect()->route('items.index')
    					->with('success', 'Item deleted successfully');
    }
}
