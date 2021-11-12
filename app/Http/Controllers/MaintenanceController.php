<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Maker;
use App\Models\Category;
use App\Models\Genre;
use Log;

class MaintenanceController extends Controller
{
    public function index() 
    {
        $maintenances = Maintenance::all();
        
        return view('products.maintenances.index', compact('maintenances'));
    }
    
    public function create() 
    {
        $makers = Maker::all();
        $categories = Category::all();
        $genres = Genre::all();
        
        return view('products.maintenances.create', compact('makers', 'categories', 'genres'));
    }
    
    public function store(Request $request) 
    {
        $maintenance = new Maintenance();
        $maintenance->name = $request->input('name');
        $maintenance->price_1pc = $request->input('price_1pc');
        $maintenance->price_10pcs = $request->input('price_10pcs');
        $maintenance->price_30pcs = $request->input('price_30pcs');
        $maintenance->jan = $request->input('jan');
        $maintenance->maker_id = $request->input('maker_id');
        $maintenance->maker_name = maker::find($request->input('maker_id'))->name;
        $maintenance->category_id = $request->input('category_id');
        $maintenance->category_name = Category::find($request->input('category_id'))->name;
        $maintenance->genre_id = $request->input('genre_id');
        $maintenance->genre_name = Genre::find($request->input('genre_id'))->name;
        $maintenance->lot = $request->input('lot');
        $maintenance->save();
        
        return redirect()->route('maintenance.index');
        
    }
    
    public function show(Maintenance $maintenance) 
    {
        
        return view('products.maintenances.show', compact('maintenance'));
    }
    
    public function edit(Maintenance $maintenance)
    {
        $makers = Maker::all();
        $categories = Category::all();
        $genres = Genre::all();
        return view('products.maintenances.edit', compact('maintenance', 'makers', 'categories', 'genres'));
    }
    
    public function update(Request $request, Maintenance $maintenance)
    {
        $maintenance->name = $request->input('name');
        $maintenance->price_1pc = $request->input('price_1pc');
        $maintenance->price_10pcs = $request->input('price_10pcs');
        $maintenance->price_30pcs = $request->input('price_30pcs');
        $maintenance->jan = $request->input('jan');
        $maintenance->maker_id = $request->input('maker_id');
        $maintenance->category_id = $request->input('category_id');
        $maintenance->genre_id = $request->input('genre_id');
        $maintenance->lot = $request->input('lot');
        $maintenance->update();
        
        return redirect()->route('maintenance.show', $maintenance);
    }
    
    public function delete(Maintenance $maintenance)
    {
        $maintenance->delete();
        
        return redirect()->route('maintenance.index');
    }
    
    public function maker(Request $request) {
        Log::debug($request);
        // Log::debug($request);
        $maker = $request['maker_id'];
        
        Log::debug($maker);
        // info($maker);
        $maker = $request['maker_id'];
        // $callback = $request['callback'];
        
        // return $maker;
        
        $genres = Genre::where('maker_id', $maker)->get();
        
        // // return response()->json($genres);
        return $genres;
    }
}
