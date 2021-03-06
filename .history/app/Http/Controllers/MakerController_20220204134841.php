<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use App\Models\Maintenance;
use Log;
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
        if($request->imgpath){
            $filename = $request->imgpath->getClientOriginalName();
            $img = $request->imgpath->storeAs('',$filename,'public');
            $maker->imgpath = $img;
        }
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
        // dd($request->imgpath);
        if($request->imgpath){
            // $filename = $request->imgpath->getClientOriginalName();
            // $img = $request->imgpath->storeAs('',$filename,'public');
            // $maker->imgpath = $img;
            $file = $request->imgpath->getClientOriginalName();
            //???????????????????????????????????????????????????(????????????)
            // $path = Storage::disk('s3')->put('/',$file, 'public');
            //??????????????????test???????????????????????????????????????
            $path = Storage::disk('s3')->put('/satake3',$file, 'public');
            $maker->imgpath = $path;
        }else{
            $maker->imgpath = null;
        }
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
        $maker_id = $maker->id;

        $target_items = Maintenance::where('maker_id', $maker_id)->get('id');

        Log::debug($target_items);

        for($i=0; $i < count($target_items); $i++){
            $target_items[$i]->delete();
        }

        $maker->delete();

        return redirect('/products/makers');
    }
}
