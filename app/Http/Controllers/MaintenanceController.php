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
        // $maker = $request['maker_id'];
        // $callback = $request['callback'];
        
        // return $maker;
        
        $genres = Genre::where('maker_id', $maker)->get();
        
        // // return response()->json($genres);
        return $genres;
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
        
        // // return response()->json($genres);
        return $genres;
    }
    
    public function csv()
    {
        return view('products.maintenances.csv');
    }
    
    public function csv_storetCsv(Request $request)
    {
        // CSV ファイル保存
        $tmpName = mt_rand().".".$request->file('csv')->guessExtension(); //TMPファイル名
        $request->file('csv')->move(public_path()."/csv/tmp",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;
     
        //Goodby CSVのconfig設定
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $lexer = new Lexer($config);
     
        //CharsetをUTF-8に変換、CSVのヘッダー行を無視
        $config->setToCharset("UTF-8");
        $config->setFromCharset("sjis-win");
        $config->setIgnoreHeaderLine(true);
     
        $dataList = [];
         
        // 新規Observerとして、$dataList配列に値を代入
        $interpreter->addObserver(function (array $row) use (&$dataList){
            // 各列のデータを取得
            $dataList[] = $row;
        });
     
        // CSVデータをパース
        $lexer->parse($tmpPath, $interpreter);
     
        // TMPファイル削除
        unlink($tmpPath);
     
        // 登録処理
        $count = 0;
        foreach($dataList as $row){
            Maintenance::insert(['name' => $row[0],
                                    'price_1pc' => $row[1],
                                    'price_10pcs' => $row[2],
                                    'price_30pcs' => $row[3],
                                    'jan' => $row[4],
                                    'maker_id' => $row[5],
                                    'category_id' => $row[6],
                                    'genre_id' => $row[7],
                                    'lot' => $row[8],
                                    ]);
            $count++;
        }
     
        return redirect()->action('ItemsController@book')->with('flash_message', $count . '品登録しました');
    }

}
