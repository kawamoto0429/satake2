<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        
        $id = $maker->id;
        
        // $maintenances = Maintenance::where('maker_id', $id)->paginate(10);
        
        $maintenances = Maintenance::where('maker_id', $id)->paginate(10);
        
        return view('orders.home', compact('maker','maintenances'));
    }
    
    public function show(Maintenance $maintenance)
    {
        
        
        return view('orders.show', compact('maintenance'));
    }
    
    public function store(Request $request)
    {
        $date = new Carbon();
        
        // $id = $request->input('maintenance_id');
        // $day = $request->input('arrived_at');
        // $arrived_at = $date->addDay($day);
        // $purchase = Purchase::where('maintenance_id', $id)->whereDate('arrived_at', $arrived_at)->get();
        // log::debug($purchase);
        
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
        // mb_convert_kana();
        $purchase->arrived_at = date("YYYY/mm/dd",$request->input('arrived_at'));
        $purchase->arrived_at = date("Y-m-d", strtotime("+" . $request->input('arrived_at') . ""));
        // log::debug($arrived_at);
        // $purchase->arrived_at = $date->addDay($arrived_at);
        log::debug($purchase->arrived_at);
        // log::debug($purchase->arrived_at->format('d'));
        $purchase->save();
        
        return redirect()->route('orders_purchase');
        
    }
    
    public function genre_specify(Request $request)
    {
        Log::debug($request);
    }
    
    public function purchase()
    {
        
        $today = Carbon::today();
        
        // Log::debug($today);
        $makers = Maker::all();
        $categories = Category::all();
        
        $purchases = Purchase::whereDate('created_at', $today)->get();
        
        // Log::debug($purchases);
        
        return view('orders.purchases.index', compact('purchases','makers', 'categories'));
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
    
    public function select(Request $request)
    {
        Log::debug($request);
    }
    
    
    public function note_today() 
    {
        $today = Carbon::today();
        
        $purchases = Purchase::whereDate('created_at', $today)->get();
        
        return view('notes.index', compact('today', "purchases"));
    }
    
    public function note_sub() 
    {
        $day_sub = Carbon::today()->subDay(1);
        
        
        
        $purchases = Purchase::whereDate('created_at', $day_sub)->get();
        
        return view('notes.sub', compact('day_sub', "purchases"));
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
        
        Log::debug($keywords);
        
        if(!empty($keywords)) {
            $maintenances = Maintenance::where('name', 'like', '%'.$keywords.'%')->get();
            return $maintenances;
        }else{
            $maintenances = Maintenance::all();
            return $maintenances;
        }
    }
}
