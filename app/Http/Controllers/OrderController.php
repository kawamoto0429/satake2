<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;
use App\Models\Maintenance;
use Log;
use App\Models\Purchase;
use App\Models\Category;
use Carbon\Carbon;


class OrderController extends Controller
{
    
    
    public function index() {
        
        $makers = Maker::all();
        
        
        return view('orders.index', compact('makers'));
    }
    
    public function home(Maker $maker) {
        
        $id = $maker->id;
        
        // $maintenances = Maintenance::where('maker_id', $id)->paginate(10);
        
        $maintenances = Maintenance::where('maker_id', $id)->get();
        
        return view('orders.home', compact('maker','maintenances'));
    }
    
    public function show(Maintenance $maintenance)
    {
        
        
        return view('orders.show', compact('maintenance'));
    }
    
    public function store(Request $request)
    {
        $date = new Carbon();
        
        $purchase = new Purchase();
        $purchase->purchase_qty = $request->input('purchase_qty');
        $purchase->maintenance_id = $request->input('maintenance_id');
        $arrived_at = $request->input('arrived_at');
        log::debug($arrived_at);
        $purchase->arrived_at = $date->addDay($arrived_at);
        $purchase->save();
        
        return redirect()->route('orders_purchase');
        
    }
    
    public function purchase() {
        
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
        // $date = new Carbon();
        $maker_id = $maker->id;
        $maintenances = Maintenance::where('maker_id', $maker_id)->get('id');
        
        Log::debug($maintenances);
        
        $purchases = [];//push 要素の追加
        // foreach($maintenances as $maintenance) {
        //     $purchases[] = $maintenace->purchases::where('maintenance_id', $maintenace)
        // }
        
        for($i = 0; $i < count($maintenances); $i++){
            if($maintenances[$i]->id == $i+1){
                 $purchases[$i] = $maintenances[$i]->purchases::find('maintenance_id', $i);
            }
        }
        
        
        
        // $purchases = Purchase::wherehas('maintenance_id', function($query){
        //         $query->where('maker_id', $maker_id);
        //     } )->get();
            
        log::debug($purchases);
        
        
        
        
        // return redirect()->route('orders_purchase', $purchases);
        return view('orders.purchases.maker', compact('purchases'));
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
}
