<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Maker;
use App\Models\Category;
use Log;
use App\Models\Purchase;
use App\Models\Memo;
use App\Models\Maintenance;

class NoteController extends Controller
{
    // 日付選択関数
    public function order($y, $m, $d)
    {
        $makers = Maker::all();
        $categories = Category::all();
        $user_id = Auth::user()->id;
        $counting = [];
        $date = new Carbon();
        $da = new Carbon();
        $da->year = $y;
        $da->month = $m - 1;
        $date->year = $y;
        $date->day = $d;
        $date->month = $m;
        $last_day = date("d", strtotime("last day of". $date));
        $l_d = date("d", strtotime("last day of". $da));
        $memos = Memo::whereDate('calendar', $date)->get();
        $purchases = Purchase::whereDate('arrived_at', $date)
                                ->where('user_id', $user_id)
                                ->get();
        foreach ($categories as $category)
        {
            $counting[$category->name] = count(Purchase::where('category_name', $category->name)
                                                        ->whereDate('arrived_at', $date)
                                                        ->where('user_id', $user_id)
                                                        ->get());
        }
        return view('notes.new', compact('y', "m", 'd','da', 'last_day', 'l_d', 'purchases', 'makers', "counting", "memos"));
    }

    // メーカー別商品の表示
    public function maker(Request $request)
    {
        $date = new Carbon();
        $user_id = Auth::user()->id;
        $maker_id = $request['id'];
        $month = $request['month'];
        $day = $request['day'];
        $date->month = $month;
        $date->day = $day;
        if($maker_id == 0) {
            $purchases = Purchase::whereDate('arrived_at', $date)
                                    ->where('user_id', $user_id)
                                    ->get();
            return $purchases;
        } else {
            $purchases = Purchase::where('maker_id', $maker_id)
                                    ->whereDate('arrived_at', $date)
                                    ->where('user_id', $user_id)
                                    ->get();
            return $purchases;
        }
    }

    // 粗利のパーセント計算関数
    public function gain(Request $request)
    {
        $id = $request['id'];
        $percent = 1 - $request['percent'];
        $purchase = Purchase::find($id);
        $purchase->gain_price = floor(round($purchase->price_change / $percent) / 10);
        $purchase->update();
        $data = ['purchase' => $purchase, 'percent' => $percent];
        return $data;
    }

}
