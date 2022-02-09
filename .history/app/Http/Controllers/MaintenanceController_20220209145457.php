<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Maker;
use App\Models\Category;
use App\Models\Genre;
use Log;
use App\Http\Requests\MaintenanceRequest;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;

class MaintenanceController extends Controller
{
    public function index()
    {
        $makers = Maker::all();
        $maintenances = Maintenance::all();

        return view('products.maintenances.index', compact('maintenances', 'makers'));
    }

    public function maker_index(Maker $maker)
    {
        $maintenances = Maintenance::where('maker_id', $maker->id)->get();

        return view('products.maintenances.maker', compact('maintenances', 'maker'));
    }


    public function create()
    {
        $makers = Maker::all();
        $categories = Category::all();
        $genres = Genre::all();

        return view('products.maintenances.create', compact('makers', 'categories', 'genres'));
    }

    public function store(MaintenanceRequest $request)
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
        if ($request->input('tomorrow_flg') == 'on') {
            $maintenance->tomorrow_flg = 1;
        } else {
            $maintenance->tomorrow_flg = 0;
        }
        if ($request->input('nodisplay_flg') == 'on') {
            $maintenance->nodisplay_flg = 1;
        } else {
            $maintenance->nodisplay_flg = 0;
        }
        if ($request->input('new_flg') == 'on') {
            $maintenance->new_flg = 1;
        } else {
            $maintenance->new_flg = false;
        }
        if ($request->imgpath) {
            // $filename = $request->imgpath->getClientOriginalName();
            // $img = $request->imgpath->storeAs('',$filename,'public');
            // $maintenance->imgpath = $img;
        }else{
            $maintenance->imgpath = null;
        }
        log::debug($maintenance);

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

    public function update(MaintenanceRequest $request, Maintenance $maintenance)
    {
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
        if ($request->input('tomorrow_flg') == 'on') {
            $maintenance->tomorrow_flg = 1;
        } else {
            $maintenance->tomorrow_flg = false;
        }
        if ($request->input('nodisplay_flg') == 'on') {
            $maintenance->nodisplay_flg = 1;
        } else {
            $maintenance->nodisplay_flg = false;
        }
        if ($request->input('new_flg') == 'on') {
            $maintenance->new_flg = 1;
        } else {
            $maintenance->new_flg = false;
        }
        // dd($request->imgpath);
        if ($request->imgpath) {
            // $filename = $request->imgpath->getClientOriginalName();
            // $img = $request->imgpath->storeAs('',$filename,'public');
            // $maintenance->imgpath = $img;
            $file1 = $request->file('imgpath');
            $path = Storage::disk('s3')->putfile('/products', $file1);
            $maintenance->imgpath = Storage::disk('s3')->url($path);
        }else{
            $maintenance->imgpath = null;
        }
        log::debug($maintenance);
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
        // $maker = $request['maker_id'];
        // $callback = $request['callback'];

        // return $maker;
        $category = Category::where('maker_id', $maker)->first();
        $categories = Category::where('maker_id', $maker)->get();

        log::debug($category);

        $genres = Genre::where('maker_id', $maker)->where('category_id', $category->id)->get();

        log::debug($genres);

        $data = ['genres' => $genres, 'categories' => $categories];
        // // return response()->json($genres);
        return $data;
    }

    public function category(Request $request) {
        Log::debug($request);
        // Log::debug($request);
        $category = $request['category_id'];

        Log::debug($category);
        // info($maker);
        // $category = $request['maker_id'];
        // $callback = $request['callback'];

        // return $maker;


        $genres = Genre::where('category_id', $category)->get();
        Log::debug($genres);


        // // return response()->json($genres);
        return $genres;
    }


    public function csv_store(Request $request)
    {
        Log::debug($request->file('csv_input'));
        // CSV ファイル保存
        $tmpName = mt_rand().".".$request->file('csv_input')->guessExtension(); //TMPファイル名
        Log::debug($tmpName);
        $request->file('csv_input')->move(public_path()."/csv/tmp",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;

        //Goodby CSVのconfig設定
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $lexer = new Lexer($config);

        //CharsetをUTF-8に変換、CSVのヘッダー行を無視
        // $config->setToCharset("UTF-8");
        // $config->setFromCharset("sjis-win");
        $config->setIgnoreHeaderLine(true);

        $dataList = [];

        // $interpreter = new Interpreter();
        // // 厳密なチェックを無効にする
        // $interpreter->unstrict();

        // 新規Observerとして、$dataList配列に値を代入
        $interpreter->addObserver(function (array $row) use (&$dataList){
            // 各列のデータを取得
            Log::debug($row);
                 $dataList[] = $row;
                 Log::debug($dataList);
            // Log::debug($dataList);

        });


        // CSVデータをパース
        $lexer->parse($tmpPath, $interpreter);

        // TMPファイル削除
        unlink($tmpPath);

        // 登録処理
        $count = 0;
        foreach($dataList as $row){

                Log::debug($row[0]);

                Maintenance::create([
                                    'name' => $row[0],
                                    'price_1pc' => $row[1],
                                    'price_10pcs' => $row[2],
                                    'price_30pcs' => $row[3],
                                    'jan' => $row[4],
                                    'maker_id' => mb_convert_kana($row[5], "KVn"),
                                    'maker_name' => $row[6],
                                    'category_id' => mb_convert_kana($row[7], "KVn"),
                                    'category_name' => $row[8],
                                    'genre_id' => mb_convert_kana($row[9], "KVn"),
                                    'genre_name' => $row[10],
                                    'lot' => $row[11],
                                    'tomorrow_flg' => mb_convert_kana($row[12], "KVn"),
                                    'nodisplay_flg' => mb_convert_kana($row[13], "KVn"),
                                    'new_flg' => mb_convert_kana($row[14], "KVn"),

                                    ]);
                $count++;

        }

        return redirect()->route('maintenance.index');
    }

    public function search(Request $request)
    {
        Log::debug($request);

        $keywords = $request['keywords'];
        $maker_id = $request['maker'];

        Log::debug($keywords);
        Log::debug($maker_id);

        if(!empty($keywords)) {
            $maintenances = Maintenance::where('name', 'like', '%'.$keywords.'%')->get();
            return $maintenances;
        }else{
            $maintenances = Maintenance::all();

            // $maintenances = Maintenance::all();
            return $maintenances;
        }
    }


}
