<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Models\Maker;
use App\Models\Genre;
use App\Models\Maintenance;
use Log;
use App\Models\Purchase;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;


class OrderController extends Controller
{

    public function index() {

        $makers = Maker::all();


        return view('orders.index', compact('makers'));
    }

    public function home(Maker $maker) {
        log::debug($maker);

        if(collect($maker)->isEmpty()){
            $date = new Carbon();

            $maker = Maker::all()->first();
            $id = $maker->id;
            Log::debug($id);
            $categories = Category::where('maker_id', $id)->get();
            $maintenances = Maintenance::where('maker_id', $id)->where('nodisplay_flg', 0)->where('new_flg', 1)->paginate(16);

            return view('orders.home', compact('maker','maintenances', 'date', 'categories'));
        }

            $date = new Carbon();

            $id = $maker->id;

            // Log::debug($id);

            $categories = Category::where('maker_id', $id)->get();


            $maintenances = Maintenance::where('maker_id', $id)->where('nodisplay_flg', 0)->where('new_flg', 1)->paginate(16);

            return view('orders.home', compact('maker','maintenances', 'date', 'categories'));

    }

    public function genre_home(Maker $maker, Genre $genre)
    {
        $date = new Carbon();

        $id = $maker->id;

        $genre_id = $genre->id;

        $categories = Category::where('maker_id', $id)->get();

        $maintenances = Maintenance::where('maker_id', $id)->where('genre_id', $genre_id)->where('nodisplay_flg', 0)->get();

        return view('orders.genre', compact('maker','maintenances', 'date', 'categories', 'genre_id'));
    }

    public function show(Maintenance $maintenance)
    {
        $date = new Carbon();

        return view('orders.show', compact('maintenance', 'date'));
    }

    public function store(PurchaseRequest $request)
    {
        $date = new Carbon();

        $week_names = ['日', '月', '火', '水', '木', '金', '土'];

        $exist_purchases = Purchase::where("maintenance_id", $request->input('maintenance_id'))
                            ->whereDate('arrived_at', date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day")))
                            ->whereDate('created_at', $date)
                            ->get();

        log::debug($exist_purchases);

        if(count($exist_purchases) <= 0){
            $purchase = new Purchase();
            $purchase->user_id = $request->input('user_id');
            $purchase->purchase_qty = $request->input('purchase_qty');
            $purchase->maintenance_id = $request->input('maintenance_id');
            $purchase->maker_id = $request->input('maker_id');
            $purchase->category_id = $request->input('category_id');
            $purchase->maker_name = Maker::find($request->input('maker_id'))->name;
            $purchase->category_name = category::find($request->input('category_id'))->name;
            $purchase->maintenance_name = Maintenance::find($request->input('maintenance_id'))->name;
            $purchase->arrived_at = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"));
            if($request->input('purchase_qty') < 10) {
                $purchase->price_change = Maintenance::find($purchase->maintenance_id)->price_1pc;
            }elseif($request->input('purchase_qty') < 30){
                $purchase->price_change = Maintenance::find($purchase->maintenance_id)->price_10pcs;
            }elseif($request->input('purchase_qty') >= 30){
                $purchase->price_change = Maintenance::find($purchase->maintenance_id)->price_30pcs;
            }
            $week = date('w', strtotime($purchase->arrived_at));
            log::debug($week);

            $purchase->week_name = $week_names[$week];
            $purchase->gain_price = floor(round($purchase->price_change / 0.8) / 10);
            $purchase->save();

            return redirect()->route('orders_purchase');
        }
        else
        {

            log::debug($exist_purchases);
            foreach($exist_purchases as $exist_purchase) {
                $exist_purchase->purchase_qty = $exist_purchase->purchase_qty + $request->input('purchase_qty');
                if($exist_purchase->purchase_qty < 10) {
                    $exist_purchase->price_change = Maintenance::find($exist_purchase->maintenance_id)->price_1pc;
                }elseif($exist_purchase->purchase_qty < 30){
                    $exist_purchase->price_change = Maintenance::find($exist_purchase->maintenance_id)->price_10pcs;
                }elseif($exist_purchase->purchase_qty >= 30){
                    $exist_purchase->price_change = Maintenance::find($exist_purchase->maintenance_id)->price_30pcs;
                }
                $exist_purchase->gain_price = floor(round($exist_purchase->price_change / 0.8) / 10);
                $exist_purchase->update();
            }
            return redirect()->route('orders_purchase');
        }

    }

    public function purchase()
    {
        $today = Carbon::today();
        $makers = Maker::all();
        $categories = Category::all();
        $user_id = Auth::user()->id;
        $purchases = Purchase::whereDate('created_at', $today)->where('user_id', $user_id)->paginate(20);
        $counting = [];

        foreach ($categories as $category)
        {
            $counting[$category->name] = count(Purchase::where('category_name', $category->name )
                                        ->whereDate('created_at', $today)
                                        ->where('user_id', $user_id)
                                        ->get());
        }

        Log::debug($counting);

        return view('orders.purchases.index', compact('purchases','makers', 'categories', 'today', "counting"));
    }

    public function update(Request $request, Purchase $purchase)
    {
        if($request->input('price_change') == null){
            $purchase->purchase_qty = $request->input('purchase_qty');
            if($purchase->purchase_qty < 10) {
                $purchase->price_change = Maintenance::find($purchase->maintenance_id)->price_1pc;
            }elseif($purchase->purchase_qty < 30){
                $purchase->price_change = Maintenance::find($purchase->maintenance_id)->price_10pcs;
            }elseif($purchase->purchase_qty >= 30){
                $purchase->price_change = Maintenance::find($purchase->maintenance_id)->price_30pcs;
            }
            $purchase->gain_price = floor(round($purchase->price_change / 0.8) / 10);
            $purchase->update();
            return redirect()->route('orders_purchase');
        }
        $purchase->purchase_qty = $request->input('purchase_qty');
        $purchase->price_change = $request->input('price_change');
        $purchase->gain_price = floor(round($purchase->price_change / 0.8) / 10);
        $purchase->update();

        return redirect()->route('orders_purchase');
    }

    public function delete(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()->route('orders_purchase');
    }


    public function specify(Maker $maker)
    {
        $today = new Carbon('today');

        $maker_id = $maker->id;
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

    public function genre(Request $request)
    {

        $maker_id= $request['maker'];
        $genre_id= $request['genre'];
        log::debug($genre_id);
        log::debug($request['name']);

        if($request['name'] == 1){
            $maintenances = Maintenance::where('maker_id', $maker_id)
                                        ->where('genre_id', $genre_id)
                                        ->where('nodisplay_flg', false)
                                        ->get();
            log::debug($maintenances);
            return $maintenances;
        }elseif($request['name'] == 2){
            $maintenances = Maintenance::where('maker_id', $maker_id)
                                        ->where('genre_id', $genre_id)
                                        ->where('tomorrow_flg', true)
                                        ->where('nodisplay_flg', false)
                                        ->get();
            log::debug($maintenances);
            return $maintenances;
        }

    }

    public function search(Request $request)
    {
        Log::debug($request);

        $keywords = $request['keywords'];
        $maker_id = $request['maker'];
        $genre_id = $request['genre'];

        Log::debug($keywords);
        Log::debug($maker_id);
        Log::debug($genre_id);

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
            // $maintenances = Maintenance::all();
            return $maintenances;
        }
    }

    public function conclude(PurchaseRequest $request)
    {
        $week_names = ['日', '月', '火', '水', '木', '金', '土'];
        $date = new Carbon();

        $concludes = $request->input('conclude');
        
        log::debug($concludes);

        foreach($concludes as $index => $conclude)
        {
            $exist_purchases = Purchase::where("maintenance_id", $conclude)
                            ->whereDate('arrived_at', date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day")))
                            ->where('user_id', $user_id)
                            ->whereDate('created_at', $date)
                            ->get();
            log::debug($exist_purchases);
            if(count($exist_purchases) > 0)
            {
                foreach($exist_purchases as $exist_purchase) {

                    $exist_purchase->purchase_qty = $exist_purchase->purchase_qty + $request->input('purchase_qty');
                    if($exist_purchase->purchase_qty < 10) {
                        $exist_purchase->price_change = Maintenance::find($exist_purchase->maintenance_id)->price_1pc;
                    }elseif($exist_purchase->purchase_qty < 30){
                        $exist_purchase->price_change = Maintenance::find($exist_purchase->maintenance_id)->price_10pcs;
                    }elseif($exist_purchase->purchase_qty >= 30){
                        $exist_purchase->price_change = Maintenance::find($exist_purchase->maintenance_id)->price_30pcs;
                    }
                    $exist_purchase->gain_price = floor(round($exist_purchase->price_change / 0.8) / 10);
                    $exist_purchase->update();
                    // return redirect()->route('orders_purchase');
                }
            } else {
                $maintenance = Maintenance::find($conclude);
                log::debug($maintenance);
                $purchase = new Purchase();
                $purchase->user_id = $request->input('user_id');
                $purchase->maker_id = $maintenance->maker_id;
                $purchase->maker_name = Maker::find($maintenance->maker_id)->name;
                $purchase->category_id = $maintenance->category_id;
                $purchase->category_name = Category::find($maintenance->category_id)->name;
                $purchase->maintenance_id = $maintenance->id;
                $purchase->maintenance_name = Maintenance::find($maintenance->id)->name;
                $purchase->purchase_qty = $request->input('purchase_qty');
                $purchase->arrived_at = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"));
                if($request->input('purchase_qty') < 10) {
                $purchase->price_change = Maintenance::find($purchase->maintenance_id)->price_1pc;
                }elseif($request->input('purchase_qty') < 30){
                    $purchase->price_change = Maintenance::find($purchase->maintenance_id)->price_10pcs;
                }elseif($request->input('purchase_qty') >= 30){
                    $purchase->price_change = Maintenance::find($purchase->maintenance_id)->price_30pcs;
                }

                $purchase->gain_price = floor(round($purchase->price_change / 0.8) / 10);
                $week = date('w', strtotime($purchase->arrived_at));
                log::debug($week);

                $purchase->week_name = $week_names[$week];
                $purchase->save();
            }

        }

        return redirect()->route('orders_purchase');
    }
}
