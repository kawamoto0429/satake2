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

    //カテゴリ一覧ページ関数
    public function index()
    {
        $makers = Maker::all();
        $categories = Category::all();
        return view('products.categories.index', compact('categories', 'makers'));
    }

    //新規のカテゴリー作成関数
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->maker_id = $request->input('maker_id');
        $category->maker_name = Maker::find($request->input('maker_id'))->name;
        $category->save();
        return redirect('products.categories');
    }

    //カテゴリー編集関数
    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->maker_id = $request->input('maker_id');
        $category->update();
        return redirect('products.categories');
    }

    //カテゴリー削除関数
    public function destroy(Category $category)
    {
        $category_id = $category->id;
        $target_items = Maintenance::where('category_id', $category_id)->get('id');
        for($i=0; $i < count($target_items); $i++){
            $target_items[$i]->delete();
        }
        $category->delete();
        return redirect('products.categories');
    }
}
