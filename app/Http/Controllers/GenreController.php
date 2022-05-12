<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Maker;
use App\Models\Category;
use App\Models\Maintenance;
use Log;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
{
    private function createGenre($request, $genre)
    {
        $genre->name = $request->input('name');
        $genre->category_id = $request->input('category_id');
        $genre->category_name = Category::find($request->input('category_id'))->name;
        $genre->maker_id = $request->input('maker_id');
        $genre->maker_name = maker::find($request->input('maker_id'))->name;
    }

    //ジャンル一覧関数
    public function index()
    {
        $makers = Maker::all();
        $categories = Category::all();
        $genres = Genre::orderBy('created_at', 'asc')->orderBy('maker_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('products.genres.index', compact('makers', 'categories', 'genres'));
    }

    //新規のジャンル作成関数
    public function store(GenreRequest $request)
    {
        $genre = new Genre();
        GenreController::createGenre($request, $genre);
        $genre->save();
        return redirect('/products/genres');
    }

    //ジャンル編集関数
    public function update(GenreRequest $request, Genre $genre)
    {
        GenreController::createGenre($request, $genre);
        $genre->update();
        return redirect('/products/genres');
    }

    //ジャンル削除関数
    public function destroy(Genre $genre)
    {
        $genre_id = $genre->id;
        $target_items = Maintenance::where('genre_id', $genre_id)->get('id');
        for($i=0; $i < count($target_items); $i++){
            $target_items[$i]->delete();
        }
        $genre->delete();
        return redirect('/products/genres');
    }

    //メーカーで絞り込まれたカテゴリーを取得する関数
    public function category(Request $request)
    {
        $maker = $request['maker_id'];
        $genre_id = Genre::where('maker_id', $maker)->get();
        $categories = Category::where('maker_id', $maker)->get();
        $data = ['categories' => $categories];
        return $data;
    }
}
