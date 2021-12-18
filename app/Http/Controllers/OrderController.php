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
        
        $date = new Carbon();
        
        $id = $maker->id;
        
        
        $categories = Category::where('maker_id', $id)->get();
        

        $maintenances = Maintenance::where('maker_id', $id)->where('nodisplay_flg', 0)->where('new_flg', 1)->paginate(10);
        
        return view('orders.home', compact('maker','maintenances', 'date', 'categories'));
    }
    
    public function genre_home(Maker $maker, Genre $genre)
    {
        $date = new Carbon();

        $id = $maker->id;
        
        $genre_id = $genre->id;
        
        $categories = Category::where('maker_id', $id)->get();
        
        
        $maintenances = Maintenance::where('maker_id', $id)->where('genre_id', $genre_id)->where('nodisplay_flg', 0)->paginate(10);
        
        return view('orders.genre', compact('maker','maintenances', 'date', 'categories'));
    }
    
    public function show(Maintenance $maintenance)
    {
        $date = new Carbon();
        
        // log::debug($maintenance);
        
        return view('orders.show', compact('maintenance', 'date'));
    }
    
    public function store(Request $request)
    {
        $date = new Carbon();
        
        $week_names = ['日', '月', '火', '水', '木', '金', '土'];
        
        // if($exist_purchase = Purchase::find($request->input('maintenance_id'))){
        //     log::debug($exist_purchase);
        //     if($exist_purchase->arrived_at == date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"))){
        //       $exist_purchase->purchase_qty = $exist_purchase->purchase_qty + $request->input('purchase_qty');
        //       $exist_purchase->update();
        //       return redirect()->route('orders_purchase');
        //     }
        // }
        
        
        $exist_purchases = Purchase::where("maintenance_id", $request->input('maintenance_id'))
                            ->whereDate('arrived_at', date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day")))
                            ->whereDate('created_at', $date)
                            ->get();
        log::debug($exist_purchases);
        
        if(count($exist_purchases) <= 0){
            $purchase = new Purchase();
            $purchase->purchase_qty = $request->input('purchase_qty');
            $purchase->maintenance_id = $request->input('maintenance_id');
            $purchase->maker_id = $request->input('maker_id');
            $purchase->category_id = $request->input('category_id');
            // log::debug($purchase->maker_id);
            $purchase->maker_name = Maker::find($request->input('maker_id'))->name;
            $purchase->category_name = category::find($request->input('category_id'))->name;
            $purchase->maintenance_name = Maintenance::find($request->input('maintenance_id'))->name;
            $purchase->arrived_at = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"));
            $week = date('w', strtotime($purchase->arrived_at));
            log::debug($week);
            
            $purchase->week_name = $week_names[$week];
            // log::debug($arrived_at);
            // $purchase->arrived_at = $date->addDay($arrived_at);
            // log::debug($purchase->arrived_at);
            // log::debug($purchase->arrived_at->format('d'));
            $purchase->save();
            
            return redirect()->route('orders_purchase');
        } 
        else 
        {
            // $exist_purchase->purchase_qty = $exist_purchase->purchase_qty + $request->input('purchase_qty');
            log::debug($exist_purchases);
            foreach($exist_purchases as $exist_purchase) {
                $exist_purchase->purchase_qty = $exist_purchase->purchase_qty + $request->input('purchase_qty');
                $exist_purchase->update();
            }
            // $exist_purchase->update();
            return redirect()->route('orders_purchase');
        }
       
    }
    
    public function purchase()
    {
        
        $today = Carbon::today();
        
        // Log::debug($today);
        $makers = Maker::all();
        $categories = Category::all();
        
        $purchases = Purchase::whereDate('created_at', $today)->get();
        
        $counting = [];
        
        foreach ($categories as $category)
        {
            $counting[$category->name] = count(Purchase::where('category_name', $category->name )->whereDate('created_at', $today)->get());
        }
        
        Log::debug($counting);
        
        return view('orders.purchases.index', compact('purchases','makers', 'categories', 'today', "counting"));
    }
    
    public function update(Request $request, Purchase $purchase) 
    {
        $purchase->purchase_qty = $request->input('purchase_qty');
        $purchase->price_change = $request->input('price_change');
        // $purchase->
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
                                ->orderBy('arrived_at', 'asc')
                                ->get();
        
        $categories = Category::all();
        
        $counting = [];
        
        foreach ($categories as $category)
        {
            $counting[$category->name] = count(Purchase::where('category_name', $category->name)
                                                        ->whereDate('created_at', $today)
                                                        ->where('maker_id', $maker_id)
                                                        ->get());
        }
        
            
        log::debug($purchases);
        
        // return redirect()->route('orders_purchase', $purchases);
        return view('orders.purchases.maker', compact('purchases', 'maker', 'today', 'counting'));
    }
    
    public function genre(Request $request)
    {
        // Log::debug($request);
        
        $maker_id= $request['maker'];
        log::debug($request['name']);
        
        if($request['name'] == "1便"){
            $maintenances = Maintenance::where('maker_id', $maker_id)
                                        ->where('nodisplay_flg', false)
                                        ->get();
            return $maintenances;
        }elseif($request['name'] == "2便"){
            $maintenances = Maintenance::where('maker_id', $maker_id)
                                        ->where('tomorrow_flg', true)
                                        ->where('nodisplay_flg', false)
                                        ->get();
            return $maintenances;
        }else{
            $genre_name= $request['name'];
            log::debug($genre_name);
            
            $maintenances = Maintenance::where('genre_name', $genre_name)
                                        ->where('maker_id', $maker_id)
                                        ->where('nodisplay_flg', false)
                                        ->get();
            log::debug($maintenances);
            return $maintenances;
        }
        
    }
    
    // public function category(Request $request) {
    //     Log::debug($request);
        
    //     $category = $request['category_id'];
        
    //     Log::debug($category);
         
    //     $maintenance_id = Maintenance::where('category_id', $category)
    //                                   ->where('nodisplay_flg', false)
    //                                   ->get('id');
         
    //     Log::debug($maintenance_id);
        
    //     // for($i = 1; $i <= $maintenance_id.count(); $i++) {
    //     //     $maintenance = $maintenance_id[$i].value();
    //     // }
        
    //     // log::debug($maintenance);
        
    //     // Log::debug($purchases);
         
    //      $purchases = Purchase::where('maintenance_id', $maintenance_id)->get();
         
    //      return $purchases;
    // }
    
    public function search(Request $request)
    {
        Log::debug($request);
        
        $keywords = $request['keywords'];
        $maker_id = $request['maker'];
        
        Log::debug($keywords);
        Log::debug($maker_id);
        
        if(!empty($keywords)) {
            $maintenances = Maintenance::where('name', 'like', '%'.$keywords.'%')
                                        ->where('maker_id', $maker_id)
                                        ->where('nodisplay_flg', false)
                                        ->get();
            return $maintenances;
        }else{
           
            $maintenances = Maintenance::where('maker_id', $maker_id)
                                        ->where('nodisplay_flg', false)
                                        ->get();
            // $maintenances = Maintenance::all();
            return $maintenances;
        }
    }
    
    public function conclude(PurchaseRequest $request)
    {
        // log::debug($request->input('conclude'));
        // log::debug($request->input('qty'));
        $date = new Carbon();
        
        $concludes = $request->input('conclude');
        log::debug($concludes);
        
        foreach($concludes as $index => $conclude)
        {
            $exist_purchases = Purchase::where("maintenance_id", $conclude)
                            ->whereDate('arrived_at', date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day")))
                            ->whereDate('created_at', $date)
                            ->get();
            log::debug($exist_purchases); 
            if(count($exist_purchases) > 0)
            {
                foreach($exist_purchases as $exist_purchase) {
                    $exist_purchase->purchase_qty = $exist_purchase->purchase_qty + $request->input('purchase_qty');
                    $exist_purchase->update();
                    // return redirect()->route('orders_purchase');
                }
            } else {
                $maintenance = Maintenance::find($conclude);
                log::debug($maintenance);
                $purchase = new Purchase();
                $purchase->maker_id = $maintenance->maker_id;
                $purchase->maker_name = Maker::find($maintenance->maker_id)->name;
                $purchase->category_id = $maintenance->category_id;
                $purchase->category_name = Category::find($maintenance->category_id)->name;
                $purchase->maintenance_id = $maintenance->id;
                $purchase->maintenance_name = Maintenance::find($maintenance->id)->name;
                $purchase->purchase_qty = $request->input('purchase_qty');
                $purchase->arrived_at = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"));
                $purchase->save();
            }
            
        }
        
        return redirect()->route('orders_purchase');
    }
}
