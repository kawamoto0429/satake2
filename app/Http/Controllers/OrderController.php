<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Models\Maker;
use App\Models\Genre;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Auth;
use Log;
use App\Models\Purchase;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class OrderController extends Controller
{
    //weekのグローバル関数
    private function week($n)
    {
        $week_names = ['日', '月', '火', '水', '木', '金', '土'];
        $num = $week_names[$n];
        return $num;
    }

    //メーカーごとの新商品の一覧関数
    private function getMaintenance($id)
    {
        $ms = Maintenance::where('maker_id', $id)
                            ->where('nodisplay_flg', 0)
                            ->where('new_flg', 1)
                            ->paginate(16);
        return $ms;
    }

    //新しく発注する商品のインデックスを作成関数
    private function createPurchase($maintenance_id, $request)
    {
        $purchase = new Purchase();
        $purchase->user_id = $request->input('user_id');
        $purchase->purchase_qty = $request->input('purchase_qty');
        $purchase->maintenance_id = $maintenance_id;
        $purchase->maker_id = $request->input('maker_id');
        $purchase->category_id = $request->input('category_id');
        $purchase->maker_name = Maker::find($request->input('maker_id'))->name;
        $purchase->category_name = category::find($request->input('category_id'))->name;
        $purchase->maintenance_name = Maintenance::find($request->input('maintenance_id'))->name;
        $purchase->arrived_at = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"));
        $purchase->price_change = OrderController::price_qty($request, $purchase);
        $week = date('w', strtotime($purchase->arrived_at));
        $purchase->week_name = OrderController::week($week);
        $purchase->gain_price = floor(round($purchase->price_change / 0.8) / 10);
        $purchase->save();
    }

    //発注個数別値段関数
    private function price_qty($request, $purchase)
    {
        if($request->input('purchase_qty') < 10) {
            return Maintenance::find($purchase->maintenance_id)->price_1pc;
        }elseif($request->input('purchase_qty') < 30){
            return Maintenance::find($purchase->maintenance_id)->price_10pcs;
        }elseif($request->input('purchase_qty') >= 30){
            return Maintenance::find($purchase->maintenance_id)->price_30pcs;
        }
    }

    //既に発注されている商品の取得関数
    private function existWhere($maintenance_id, $request, $date)
    {
        $exist_purchases = Purchase::where("maintenance_id", $maintenance_id)
                            ->whereDate('arrived_at', date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day")))
                            ->where('user_id', $request->input('user_id'))
                            ->whereDate('created_at', $date)
                            ->get();
        return $exist_purchases;
    }

    //既に発注されている商品の編集関数
    private function exist($request, $exist_purchase)
    {
        $exist_purchase->price_change = OrderController::price_qty($request, $exist_purchase);
        log::debug($exist_purchase->price_change);
        $exist_purchase->gain_price = floor(round($exist_purchase->price_change / 0.8) / 10);
        return $exist_purchase;
    }

    //ログイン後の関数
    public function home(Maker $maker)
    {
        if(collect($maker)->isEmpty()){
            $date = new Carbon();
            $maker = Maker::all()->first();
            $id = $maker->id;
            $categories = Category::where('maker_id', $id)->get();
            $maintenances = OrderController::getMaintenance($id);
            return view('orders.home', compact('maker','maintenances', 'date', 'categories'));
        }
        $date = new Carbon();
        $id = $maker->id;
        $categories = Category::where('maker_id', $id)->get();
        $maintenances = OrderController::getMaintenance($id);
        return view('orders.home', compact('maker','maintenances', 'date', 'categories'));
    }

    //ジャンルごと関数
    public function genre_home(Maker $maker, Genre $genre)
    {
        $date = new Carbon();
        $id = $maker->id;
        $genre_id = $genre->id;
        $categories = Category::where('maker_id', $id)->get();
        $maintenances = Maintenance::where('maker_id', $id)
                                    ->where('genre_id', $genre_id)
                                    ->where('nodisplay_flg', 0)
                                    ->get();
        return view('orders.genre', compact('maker','maintenances', 'date', 'categories', 'genre_id'));
    }

    //商品詳細の関数
    public function show(Maintenance $maintenance)
    {
        $date = new Carbon();
        return view('orders.show', compact('maintenance', 'date'));
    }

    //個々の商品発注の関数
    public function store(PurchaseRequest $request)
    {
        $date = new Carbon();
        $user_id = Auth::user()->id;
        $exist_purchases = OrderController::existWhere($request->input('maintenance_id'), $request, $date);
        if(count($exist_purchases) <= 0){
            OrderController::createPurchase($request);
            return redirect()->route('orders_purchase');
        }else{
            foreach($exist_purchases as $exist_purchase) {
                $exist_purchase->purchase_qty = $exist_purchase->purchase_qty + $request->input('purchase_qty');
                OrderController::exist($request, $exist_purchase);
                $exist_purchase->update();
            }
            return redirect()->route('orders_purchase');
        }
    }

    //当日の発注一覧関数
    public function purchase()
    {
        $today = Carbon::today();
        $makers = Maker::all();
        $categories = Category::all();
        $user_id = Auth::user()->id;
        $purchases = Purchase::whereDate('created_at', $today)
                                ->where('user_id', $user_id)
                                ->orderBy('arrived_at', 'asc')
                                ->orderBy('maker_id', "asc")
                                ->paginate(20);
        $counting = [];
        foreach ($categories as $category)
        {
            $counting[$category->name] = count(Purchase::where('category_name', $category->name )
                                        ->whereDate('created_at', $today)
                                        ->where('user_id', $user_id)
                                        ->get());
        }
        return view('orders.purchases.index', compact('purchases','makers', 'categories', 'today', "counting"));
    }

    //一覧画面での編集関数
    public function update(Request $request, Purchase $purchase)
    {
        if($request->input('purchase_qty') != null)
        {
            if($request->input('price_change') == null){
                OrderController::exist($request, $purchase);
                log::debug($purchase);
                $purchase->update();
                return redirect()->route('orders_purchase');
            }
            $purchase->purchase_qty = $request->input('purchase_qty');
            $purchase->price_change = $request->input('price_change');
            $purchase->gain_price = floor(round($purchase->price_change / 0.8) / 10);
            $purchase->update();
            return redirect()->route('orders_purchase');
        }
        return redirect()->route('orders_purchase');
    }

    //商品削除の関数
    public function delete(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('orders_purchase');
    }

    //メーカーごとの発注された商品の関数
    public function specify(Maker $maker)
    {
        $today = new Carbon('today');
        $maker_id = $maker->id;
        $user_id = Auth::user()->id;
        $purchases = purchase::where('maker_id', $maker_id)
                                ->whereDate('created_at', $today)
                                ->where('user_id', $user_id)
                                ->orderBy('arrived_at', 'asc')
                                ->paginate(15);
        $categories = Category::all();
        $counting = [];
        foreach ($categories as $category)
        {
            $counting[$category->name] = count(Purchase::where('category_name', $category->name)
                                                        ->whereDate('created_at', $today)
                                                        ->where('user_id', $user_id)
                                                        ->where('maker_id', $maker_id)
                                                        ->get());
        }
        return view('orders.purchases.maker', compact('purchases', 'maker', 'today', 'counting'));
    }

    //検索関数
    public function search(Request $request)
    {
        $keywords = $request['keywords'];
        $maker_id = $request['maker'];
        $genre_id = $request['genre'];
        if(!empty($keywords)) {
            $maintenances = Maintenance::where('name', 'like', '%'.$keywords.'%')
                                        ->where('maker_id', $maker_id)
                                        ->where('genre_id', $genre_id)
                                        ->where('nodisplay_flg', false)
                                        ->get();
            return $maintenances;
        }else{

            $maintenances = Maintenance::where('maker_id', $maker_id)
                                        ->where('genre_id', $genre_id)
                                        ->where('nodisplay_flg', false)
                                        ->get();
            return $maintenances;
        }
    }

    //複数選択で発注する関数
    public function conclude(PurchaseRequest $request)
    {
        $date = new Carbon();
        $concludes = $request->input('conclude');
        $user_id = $request->input('user_id');
        foreach($concludes as $index => $conclude)
        {
            $exist_purchases = OrderController::existWhere($conclude, $request, $date);
            if(count($exist_purchases) > 0)
            {
                foreach($exist_purchases as $exist_purchase) {
                    $exist_purchase->purchase_qty = $exist_purchase->purchase_qty + $request->input('purchase_qty');
                    OrderController::exist($request, $exist_purchase);
                    $exist_purchase->update();
                }
            } else {
                $maintenance = Maintenance::find($conclude);
                OrderController::createPurchase($maintenance->id, $request);
            }
        }
        return redirect()->route('orders_purchase');
    }
}
