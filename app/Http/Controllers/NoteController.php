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
        
        log::debug($date);
        
        // log::debug($date->month);
        log::debug($day);
        // $dates = $date->year . "-" . $date->month-1;
        
        
        // if($day == 0){
        //     $date->month = $id - 1;
        //     $dates = $date->year . "-" . $date->month;
        //     log::debug($dates);
        //     $date = date("Y-m-d", strtotime("last day of". $dates));
        //     $month = date("m", strtotime("last day of". $dates));
        //     $last_day = date("d", strtotime("last day of". $dates));
        //     // $dates = $date->year . "-" . $date->month-1;
        //     log::debug($last_day);
            
        //     $id = abs($month);
        //     $day = $last_day;
        //     $purchases = Purchase::whereDate('arrived_at', $date)->get();
            
        //     return view('notes.orders', compact('id', 'day', 'purchases', 'makers'));
        
        // }elseif($day == $last_day){
        //     $date->month = $id;
        //     $last_day = date("d", strtotime("last day of". $date));
        //     $date->month = $id + 1;
        //     $dates = $date->year . "-" . $date->month;
        //     $date = date("Y-m-d", strtotime("first day of". $dates));
        //     $month = date("m", strtotime("first day of". $dates));
        //     $first_day = date("d", strtotime("first day of". $dates));
        //     $id = abs($month);
        //     $day = $first_day;
        //     $purchases = Purchase::whereDate('arrived_at', $date)->get();
            
        //     return view('notes.orders', compact('id', 'day', 'purchases', 'makers'));
        // }else{
        //     $date->month = $id;
        
        //     $date->day = $day;
            
        //     Log::debug($date);
            
        //     $purchases = Purchase::whereDate('arrived_at', $date)->get();
            
        //     Log::debug($purchases);
            
        //     return view('notes.orders', compact('id', 'day', 'purchases', 'makers'));
        // }
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
            
            return view('notes.orders', compact('id', 'day', 'purchases', 'makers'));
        }elseif($day == 0){
            $date->month = $id - 1;
            $dates = $date->year . "-" . $date->month;
            log::debug($dates);
            $date = date("Y-m-d", strtotime("last day of". $dates));
            $month = date("m", strtotime("last day of". $dates));
            $last_day = date("d", strtotime("last day of". $dates));
            // $dates = $date->year . "-" . $date->month-1;
            // log::debug($last_day);
            $id = abs($month);
            $day = $last_day;
            $purchases = Purchase::whereDate('arrived_at', $date)->get();
            
            return view('notes.orders', compact('id', 'day', 'purchases', 'makers' ));
        
        }else{
            
            // $date->month = $id - 1;
            // $dates = $date->year . "-" . $date->month;
            // $last_day = date("d", strtotime("last day of". $dates));
            $date->month = $id;
        
            $date->day = $day;
            
            Log::debug($date);
            
            $purchases = Purchase::whereDate('arrived_at', $date)->get();
            
            Log::debug($purchases);
            
            return view('notes.orders', compact('id', 'day', 'purchases', 'makers', 'last_day'));
        }
        
        // $date->month = $id;
        
        // $date->day = $day;
        
        // Log::debug($date);
        
        // $purchases = Purchase::whereDate('arrived_at', $date)->get();
        
        // Log::debug($purchases);
        
        // return view('notes.orders', compact('id', 'day', 'purchases', 'makers'));
    }
    
    
}
