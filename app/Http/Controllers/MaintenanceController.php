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
use Illuminate\Support\Facades\Storage;

class MaintenanceController extends Controller
{
    private function createMaintenance($maintenance, $request)
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
            $file1 = $request->file('imgpath');
            $path = Storage::disk('s3')->putfile('/products', $file1);
            $maintenance->imgpath = Storage::disk('s3')->url($path);
        }else{
            $maintenance->imgpath = null;
        }
    }

    //商品一覧関数
    public function index()
    {
        $makers = Maker::all();
        $maintenances = Maintenance::all();
        return view('products.maintenances.index', compact('maintenances', 'makers'));
    }

    //メーカー別商品一覧関数
    public function maker_index(Maker $maker)
    {
        $maintenances = Maintenance::where('maker_id', $maker->id)->get();
        return view('products.maintenances.maker', compact('maintenances', 'maker'));
    }

    //新商品追加画面関数
    public function create()
    {
        $makers = Maker::all();
        $categories = Category::all();
        $genres = Genre::all();
        return view('products.maintenances.create', compact('makers', 'categories', 'genres'));
    }

    // 新商品作成関数
    public function store(MaintenanceRequest $request)
    {
        $maintenance = new Maintenance();
        MaintenanceController::createMaintenance($maintenance, $request);
        $maintenance->save();
        return redirect()->route('maintenance.index');
    }

    // 商品の詳細関数
    public function show(Maintenance $maintenance)
    {
        return view('products.maintenances.show', compact('maintenance'));
    }

    // 商品の編集関数
    public function edit(Maintenance $maintenance)
    {
        $makers = Maker::all();
        $categories = Category::all();
        $genres = Genre::all();
        return view('products.maintenances.edit', compact('maintenance', 'makers', 'categories', 'genres'));
    }

    //商品編集関数
    public function update(MaintenanceRequest $request, Maintenance $maintenance)
    {
        MaintenanceController::createMaintenance($maintenance, $request);
        $maintenance->update();
        return redirect()->route('maintenance.show', $maintenance);
    }

    //商品削除関数
    public function delete(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenance.index');
    }

    // メーカーからカテゴリーとジャンルの絞り込み関数
    public function maker(Request $request) {
        $maker = $request['maker_id'];
        $category = Category::where('maker_id', $maker)->first();
        $categories = Category::where('maker_id', $maker)->get();
        $genres = Genre::where('maker_id', $maker)->where('category_id', $category->id)->get();
        $data = ['genres' => $genres, 'categories' => $categories];
        return $data;
    }

    //カテゴリーからジャンルの絞り込み関数
    public function category(Request $request) {
        $category = $request['category_id'];
        $genres = Genre::where('category_id', $category)->get();
        return $genres;
    }

    //CSVで商品を作成関数
    public function csv_store(Request $request)
    {
        $tmpName = mt_rand().".".$request->file('csv_input')->guessExtension();
        $request->file('csv_input')->move(public_path()."/csv/tmp",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $lexer = new Lexer($config);
        $config->setIgnoreHeaderLine(true);
        $dataList = [];
        $interpreter->addObserver(function (array $row) use (&$dataList){
            $dataList[] = $row;
        });
        $lexer->parse($tmpPath, $interpreter);
        unlink($tmpPath);
        $count = 0;
        foreach($dataList as $row){
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

    // 商品の検索関数
    public function search(Request $request)
    {
        $keywords = $request['keywords'];
        $maker_id = $request['maker'];
        if(!empty($keywords)) {
            $maintenances = Maintenance::where('name', 'like', '%'.$keywords.'%')->get();
            return $maintenances;
        }else{
            $maintenances = Maintenance::all();
            return $maintenances;
        }
    }
}
