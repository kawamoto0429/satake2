<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use Illuminate\Http\Request;
use App\Http\Requests\MakerRequest;

class MakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makers = Maker::all();
       
        return view('products.makers.index', compact('makers'));
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
    public function store(MakerRequest $request)
    {
        
        
        $maker = new Maker();
        $maker->name = $request->name;
        $maker->save();
        
        return redirect('/products/makers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function show(Maker $maker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function edit(Maker $maker)
    {
        return view('products.makers.edit', compact('maker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function update(MakerRequest $request, Maker $maker)
    {
        $maker->name = $request->name;
        $maker->update();
        
        return redirect('/products/makers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maker $maker)
    {
        $maker->delete();
        
        return redirect('/products/makers');
    }
}
