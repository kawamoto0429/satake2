<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use App\Models\Maintenance;
use Log;
use Illuminate\Http\Request;
use App\Http\Requests\MakerRequest;
use Illuminate\Support\Facades\Storage;

class MakerController extends Controller
{
    //ホーム画面関数
    public function index()
    {
        $makers = Maker::all();
        return view('products.makers.index', compact('makers'));
    }

    //新規のメーカー作成関数
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

    //メーカー編集関数
    public function update(MakerRequest $request, Maker $maker)
    {
        $maker->name = $request->name;
        if($request->imgpath){
            $file1 = $request->file('imgpath');
            $path = Storage::disk('s3')->putfile('/', $file1);
            $maker->imgpath = Storage::disk('s3')->url($path);
        }else{
            $maker->imgpath = null;
        }
        $maker->update();
        return redirect('/products/makers');
    }

    //メーカー削除関数
    public function destroy(Maker $maker)
    {
        $maker_id = $maker->id;
        $target_items = Maintenance::where('maker_id', $maker_id)->get('id');
        for($i=0; $i < count($target_items); $i++){
            $target_items[$i]->delete();
        }
        $maker->delete();
        return redirect('/products/makers');
    }
}
