<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Maker;
use App\Models\Category;
use Log;
use App\Models\Purchase;
use App\Models\Maintenance;

class NoteController extends Controller
{
    
    
    public function note_home() 
    {
        
        $date = new Carbon();
        
        $year = $date->year;
        
        $months = [];
        
        $first = $date->firstOfYear();
        
        $firstMonth = $first->month;
        
        $last = $date->lastOfYear();
        
        $lastMonth = $last->month;
        
        $i = 1;
        
        for($i = 1; $i <= $lastMonth ; $i++) {
            $months[] = $i;
        }
        
        return view('notes.home', compact('year', 'months'));
    }
    
    public function day($id)
    {
        // Log::debug($id);
        
        $date = new Carbon();
        
        // $year = $date->year;
        
        $date->month = $id;
        
        $days = [];
        
        $last = $date->endOfMonth();
        
        $lastday = $last->day;
        
        for($i = 1; $i <= $lastday ; $i++) {
            $days[] = $i;
        }
        return view('notes.day',  compact( 'id', 'days'));
    }
    
    public function orders($id, $day) 
    {
        $date = new Carbon();
        
        $makers = Maker::all();
        
        $categories = Category::all();
        
        $counting = [];
        
        
        
        $date->month = $id;
        $last_day = date("d", strtotime("last day of". $date));
        
        if($day == $last_day+1){
            
            $date->month = $id + 1;
            $dates = $date->year . "-" . $date->month;
            $date = date("Y-m-d", strtotime("first day of". $dates));
            $month = date("m", strtotime("first day of". $dates));
            $first_day = date("d", strtotime("first day of". $dates));
            $id = abs($month);
            $day = abs($first_day);
            $purchases = Purchase::whereDate('arrived_at', $date)->get();
            foreach ($categories as $category)
            {
                $counting[$category->name] = count(Purchase::where('category_name', $category->name )->whereDate('arrived_at', $date)->get());
            }
            
            
            return view('notes.orders', compact('id', 'day', 'purchases', 'makers',"counting"));
        }elseif($day == 0){
            $date->month = $id - 1;
            $dates = $date->year . "-" . $date->month;
            // log::debug($dates);
            $date = date("Y-m-d", strtotime("last day of". $dates));
            $month = date("m", strtotime("last day of". $dates));
            $last_day = date("d", strtotime("last day of". $dates));
            // $dates = $date->year . "-" . $date->month-1;
            // log::debug($last_day);
            $id = abs($month);
            $day = $last_day;
            $purchases = Purchase::whereDate('arrived_at', $date)->get();
            
            foreach ($categories as $category)
            {
                $counting[$category->name] = count(Purchase::where('category_name', $category->name )->whereDate('arrived_at', $date)->get());
            }
            
            return view('notes.orders', compact('id', 'day', 'purchases', 'makers',"counting" ));
        
        }else{
            
            
            $date->month = $id;
        
            $date->day = $day;
            
            // Log::debug($date);
            
            $purchases = Purchase::whereDate('arrived_at', $date)->get();
            
            // Log::debug($purchases);
            
            foreach ($categories as $category)
            {
                $counting[$category->name] = count(Purchase::where('category_name', $category->name )->whereDate('arrived_at', $date)->get());
            }
            
            return view('notes.orders', compact('id', 'day', 'purchases', 'makers', "counting"));
        }
        
    }
    
    public function order($y, $m, $d) {
        log::debug($m);
        $makers = Maker::all();
        $categories = Category::all();
        $counting = [];
        $date = new Carbon();
        $da = new Carbon();
        log::debug($da);

        $da->year = $y;
        $da->month = $m - 1;
        log::debug($da);
        
        $date->year = $y;
        $date->day = $d;
        $date->month = $m;
        log::debug($date);
        
        log::debug($date->month);
        
        $last_day = date("d", strtotime("last day of". $date));
        $l_d = date("d", strtotime("last day of". $da));
        
        log::debug($date);
        
        $purchases = Purchase::whereDate('arrived_at', $date)->get();
        
        log::debug($purchases);
        
        $purchases = Purchase::whereDate('arrived_at', $date)->get();
        foreach ($categories as $category)
        {
            $counting[$category->name] = count(Purchase::where('category_name', $category->name )->whereDate('arrived_at', $date)->get());
        }
        return view('notes.new', compact('y', "m", 'd','da', 'last_day', 'l_d', 'purchases', 'makers', "counting"));
            
        
    }
    
    public function maker(Request $request)
    {
        $date = new Carbon();
        log::debug($request);
        
        $maker_id = $request['id'];
        $month = $request['month'];
        $day = $request['day'];
        
        // log::debug($maker_id);
        // log::debug($month);
        // log::debug($day);
        
        $date->month = $month;
        
        $date->day = $day;
        
        // log::debug($date);
        
        if($maker_id == 0) {
            $purchases = Purchase::whereDate('arrived_at', $date)->get();
            return $purchases;
        } else {
            $purchases = Purchase::where('maker_id', $maker_id)->whereDate('arrived_at', $date)->get();
            return $purchases;
        }
    }
    
    public function gain(Request $request)
    {
        log::debug($request);
        
        $id = $request['id'];
        $percent = 1 - $request['percent'];
        
        
        $purchase = Purchase::find($id);
        log::debug($percent);
        
        $purchase->gain_price = floor(round($purchase->price_change / $percent) / 10);
        log::debug($purchase->gain_price);
        $purchase->update();
        
        $data = ['purchase' => $purchase, 'percent' => $percent];
        
        return $data;
    }
    
}
