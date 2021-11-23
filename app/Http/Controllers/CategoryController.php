<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Maker;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Maintenance;
use Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makers = Maker::all();
        $categories = Category::all();
        return view('products.categories.index', compact('categories', 'makers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->maker_id = $request->input('maker_id');
         $category->save();
        
        return redirect('/products/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $makers = Maker::all();
        
        return view('products.categories.edit', compact('category', 'makers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->maker_id = $request->input('maker_id');
        $category->update();
        
        return redirect('/products/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category_id = $category->id;
        
        $target_items = Maintenance::where('category_id', $category_id)->get('id');
        
        Log::debug($target_items);
        
        for($i=0; $i < count($target_items); $i++){
            $target_items[$i]->delete();
        }
        
        $category->delete();
        
        return redirect('/products/categories');
    }
}
