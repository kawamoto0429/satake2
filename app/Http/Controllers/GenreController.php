<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Maker;
use App\Models\Category;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
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
        $genres = Genre::all();
        return view('products.genres.index', compact('makers', 'categories', 'genres'));
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
    public function store(GenreRequest $request)
    {
        $genre = new Genre();
        $genre->name = $request->input('name');
        $genre->category_id = $request->input('category_id');
        $genre->category_name = Category::find($request->input('category_id'))->name;
        $genre->maker_id = $request->input('maker_id');
        $genre->maker_name = maker::find($request->input('maker_id'))->name;
        $genre->save();
        
        return redirect('/products/genres');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        $makers = Maker::all();
        $categories = Category::all();
        return view('products.genres.edit', compact('genre','makers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        $genre->name = $request->input('name');
        $genre->category_id = $request->input('category_id');
        $genre->category_name = Category::find($request->input('category_id'))->name;
        $genre->maker_id = $request->input('maker_id');
        $genre->maker_name = maker::find($request->input('maker_id'))->name;
        $genre->update();
        
        return redirect('/products/genres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        
        return redirect('/products/genres');
    }
}
