<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Maker;
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
        
        $date->month = $id;
        
        $date->day = $day;
        
        Log::debug($date);
        
        $purchases = Purchase::whereDate('arrived_at', $date)->get();
        
        Log::debug($purchases);
        
        return view('notes.orders', compact('id', 'day', 'purchases', 'makers'));
    }
    
    public function orders_sub ($id, $day) 
    {
        // Log::debug($id);
        
        // Log::debug($day);
        
        $date = new Carbon();
        
        $date->month = $id;
        
        $date->day = $day;
        
        $sub_date = $date->subDay();
        
        $id = $sub_date->month;
        
        $day = $sub_date->day;
        
        return redirect()->route('home_orders', ['id'=>$id, 'day'=>$day]);
    }
}
