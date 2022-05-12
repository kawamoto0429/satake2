<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use Carbon\Carbon;
use App\Http\Requests\MemoRequest;
use Log;

class MemoController extends Controller
{

    // 備考作成関数
    public function store(MemoRequest $request, $y, $m, $d)
    {
        $memo = new Memo();
        $date = new Carbon();
        $memo->text = $request->input('text');
        $date->day = $d;
        $date->month = $m;
        $date->year = $y;
        $memo->calendar = $date->format('Y-m-d');
        $memo->save();
        return redirect()->route('home_order', [$y, $m, $d]);
    }

    // 備考削除関数
    public function delete($id, $y, $m, $d)
    {
        $memo = Memo::find($id);
        $memo->delete();
        return redirect()->route('home_order', [$y, $m, $d]);
    }
}
