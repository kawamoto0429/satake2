<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Models\Maker;
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
        
        // $maintenances = Maintenance::where('maker_id', $id)->paginate(10);
        
        $maintenances = Maintenance::where('maker_id', $id)->paginate(10);
        
        return view('orders.home', compact('maker','maintenances', 'date'));
    }
    
    public function show(Maintenance $maintenance)
    {
        $date = new Carbon();
        
        return view('orders.show', compact('maintenance', 'date'));
    }
    
    public function store(Request $request)
    {
        $date = new Carbon();
        
        // $id = $request->input('maintenance_id');
        // $day = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"));
        
        // log::debug($day);
        
        
        // log::debug(Purchase::find(['arrived_at'=>$day]));
        
        // if(Purchase::find(['maintenance_id'=>$id, 'arrived_at'=>$day]) == [])
        // {
        //     $purchase = new Purchase();
        //     $purchase->purchase_qty = $request->input('purchase_qty');
        //     $purchase->maintenance_id = $request->input('maintenance_id');
        //     $purchase->maker_id = $request->input('maker_id');
        //     // mb_convert_kana();
        //     // $purchase->arrived_at = date("YYYY/mm/dd",$request->input('arrived_at'));
        //     $purchase->arrived_at = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"));
        //     // log::debug($arrived_at);
        //     // $purchase->arrived_at = $date->addDay($arrived_at);
        //     log::debug($purchase->arrived_at);
        //     // log::debug($purchase->arrived_at->format('d'));
        //     $purchase->save();
        //     return redirect()->route('orders_purchase');
        // }
        //     $purchase1 = Purchase::find(['maintenance_id'=>$id, 'arrived_at'=>$day]);
        //     log::debug( $purchase1);
        //     return redirect()->route('orders_purchase');
            // $purchase1->purchase_qty = $purchase1->purchase_qty + $request->input('purchase_qty');
            // log::debug( $purchase->purchase_qty);
        
        
        // if(empty($purchase))
        // {
        // //     log::debug($arrived_at);
        // //     $purchase = Purchase::where('maintenance_id', $id)->whereDate('arrived_at', $arrived_at)->get();
        // //     log::debug($purchase);
        // //     $add = $request->input('purchase_qty');
        // //     // $purchase->purchase_qty = $purchase->purchase_qty + $add;
        // //     // log::debug($purchase->purchase_qty);
        //      return redirect()->route('orders_purchase');
        // } 
        
        $purchase = new Purchase();
        $purchase->purchase_qty = $request->input('purchase_qty');
        $purchase->maintenance_id = $request->input('maintenance_id');
        $purchase->maker_id = $request->input('maker_id');
        // log::debug($purchase->maker_id);
        $purchase->maker_name = Maker::find($request->input('maker_id'))->name;
        $purchase->maintenance_name = Maintenance::find($request->input('maintenance_id'))->name;
        $purchase->arrived_at = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"));
        // log::debug($arrived_at);
        // $purchase->arrived_at = $date->addDay($arrived_at);
        // log::debug($purchase->arrived_at);
        // log::debug($purchase->arrived_at->format('d'));
        $purchase->save();
        
        return redirect()->route('orders_purchase');
        
    }
    
    public function purchase()
    {
        
        $today = Carbon::today();
        
        // Log::debug($today);
        $makers = Maker::all();
        $categories = Category::all();
        
        $purchases = Purchase::whereDate('created_at', $today)->get();
        
        // Log::debug($purchases);
        
        return view('orders.purchases.index', compact('purchases','makers', 'categories', 'today'));
    }
    
    public function update(Request $request, Purchase $purchase) 
    {
        $purchase->purchase_qty = $request->input('purchase_qty');
        // $purchase->
        $purchase->update();
        
        return redirect()->route('orders_purchase');
    }
    
    public function delete(Purchase $purchase)
    {
        $purchase->delete();
        
        return redirect()->route('orders_purchase');
    }
    
    
    
    public function note_today() 
    {
        $today = Carbon::today();
        
        $purchases = Purchase::whereDate('created_at', $today)->get();
        
        return view('notes.index', compact('today', "purchases"));
    }
    
    public function specify(Maker $maker)
    {
        $today = new Carbon('today');
        $maker_id = $maker->id;
        $purchases = purchase::where('maker_id', $maker_id)->whereDate('created_at', $today)->get();
        
        
        // foreach($maintenances as $maintenance) {
        //     $purchases[] = $maintenace->purchases::where('maintenance_id', $maintenace)
        // }
        
        // for($i = 0; $i < count($maintenances); $i++){
        //     if($maintenances[$i]->id == $i+1){
        //          $purchases[$i] = $maintenances[$i]->purchases::find('maintenance_id', $i);
        //     }
        // }
        
        
        
        // $purchases = Purchase::wherehas('maintenance_id', function($query){
        //         $query->where('maker_id', $maker_id);
        //     } )->get();
            
        log::debug($purchases);
        
        // return redirect()->route('orders_purchase', $purchases);
        return view('orders.purchases.maker', compact('purchases', 'maker'));
    }
    
    public function genre(Request $request)
    {
        // Log::debug($request);
        
        $maker_id= $request['maker'];
        log::debug($request['id']);
        
        if($request['id'] == -1){
            $maintenances = Maintenance::where('maker_id', $maker_id)->get();
            return $maintenances;
        }elseif($request['id'] == -2){
            $maintenances = Maintenance::where('maker_id', $maker_id)->where('tomorrow_flg', 1)->get();
            return $maintenances;
        }else{
            $genre_id= $request['id'];
            log::debug($genre_id);
            
            $maintenances = Maintenance::where('genre_id', $genre_id)->where('maker_id', $maker_id)->get();
            
            return $maintenances;
        }
        
    }
    
    public function category(Request $request) {
        Log::debug($request);
        
        $category = $request['category_id'];
        
        Log::debug($category);
         
        $maintenance_id = Maintenance::where('category_id', $category)->get('id');
         
        Log::debug($maintenance_id);
        
        for($i = 1; $i <= $maintenance_id.count(); $i++) {
            $maintenance = $maintenance_id[$i].value();
        }
        
        log::debug($maintenance);
        
        // Log::debug($purchases);
         
         $purchases = Purchase::where('maintenance_id', $maintenance_id)->get();
         
         return $purchases;
    }
    
    public function search(Request $request)
    {
        Log::debug($request);
        
        $keywords = $request['keywords'];
        $maker_id = $request['maker'];
        
        Log::debug($keywords);
        Log::debug($maker_id);
        
        if(!empty($keywords)) {
            $maintenances = Maintenance::where('name', 'like', '%'.$keywords.'%')->where('maker_id', $maker_id)->get();
            return $maintenances;
        }else{
           
            $maintenances = Maintenance::where('maker_id', $maker_id)->get();
            // $maintenances = Maintenance::all();
            return $maintenances;
        }
    }
    
    public function conclude(PurchaseRequest $request)
    {
        // log::debug($request->input('conclude'));
        // log::debug($request->input('qty'));
        
        $concludes = $request->input('conclude');
        log::debug($concludes);
        
        foreach($concludes as $index => $conclude)
        {
            $maintenance = Maintenance::find($conclude);
            log::debug($maintenance);
            $purchase = new Purchase();
            $purchase->maker_id = $maintenance->maker_id;
            $purchase->maker_name = Maker::find($maintenance->maker_id)->name;
            $purchase->maintenance_id = $maintenance->id;
            $purchase->maintenance_name = Maintenance::find($maintenance->id)->name;
            $purchase->purchase_qty = $request->input('purchase_qty');
            $purchase->arrived_at = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . "day"));
            $purchase->save();
        }
        
        return redirect()->route('orders_purchase');
    }
}
