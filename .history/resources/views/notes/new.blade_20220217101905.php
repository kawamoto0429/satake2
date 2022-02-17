@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <input type="hidden" id="month" value="{{$m}}">
        {{$m}}
    </div>
    <div>
        <input type="hidden" id="day" value="{{$d}}">
        @if($d == $last_day)
            <a href="/notes/home/{{$y}}/{{$m}}/{{$d-1}}">&lt;</a>
            {{$d}}
            @if($m + 1 > 12)
            <a href="/notes/home/{{$y+1}}/1/1">&gt;</a>
            @else
            <a href="/notes/home/{{$y}}/{{$m+1}}/1">&gt;</a>
            @endif
        @elseif($d == 1)
            @if($m - 1 == 0)
            <a href="/notes/home/{{$y-1}}/{{$da->month}}/{{$l_d}}">&lt;</a>
            @else
            <a href="/notes/home/{{$y}}/{{$m-1}}/{{$l_d}}">&lt;</a>
            @endif
            {{$d}}
            <a href="/notes/home/{{$y}}/{{$m}}/{{$d+1}}">&gt;</a>
        @else
            <a href="/notes/home/{{$y}}/{{$m}}/{{$d-1}}">&lt;</a>
                {{$d}}
            <a href="/notes/home/{{$y}}/{{$m}}/{{$d+1}}">&gt;</a>
        @endif
    </div>
    <div>
        <a href="/pdf/{{$m}}/{{$d}}">確定</a>
    </div>
    <div>
        <div class="navbar-header d-flex">
            <ul class="navbar-brand">
                <li class="navbar-brand" value ="0"><a href="#">すべて</a></li>
                @foreach($makers as $maker)
                <li class="navbar-brand" href="/" value ="{{$maker->id}}">
                    <a href="#">{{$maker->name}}</a>
                </li>
                @endforeach
            </ul>
            <div class="d-flex  ml-4">
                @foreach($counting as $category => $c)
                <div class="ml-4">
                    <label>{{$category}}</label>
                    <label>{{$c}}</label>
                    <label>個</label>
                </div>
                @endforeach
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">メーカー</th>
                    <th scope="col">商品名</th>
                    <th scope="col">個数</th>
                    <th scope="col ">粗利割</th>
                    <th scope="col">値段</th>
                </tr>
            </thead>
            <tbody class="products-list">
                @foreach($purchases as $purchase)
                <tr>
                    <input type="hidden" value="{{$purchase->id}}" class="id">
                    <td>{{$purchase->maintenance->maker_name}}</td>
                    <td>{{$purchase->maintenance->name}}</td>
                    <td>{{$purchase->purchase_qty}}</td>
                    <td><select class="gain" name="percent">
                    @if(floor(round($purchase->price_change / (1 - 0.2)) / 10) == $purchase->gain_price)
                        <option value=0.20 selected >20%</option>
                        <option value=0.25 >25%</option>
                        <option value=0.30 >30%</option>
                    @elseif(floor(round($purchase->price_change / (1 - 0.25)) / 10) == $purchase->gain_price)
                        <option value=0.20 >20%</option>
                        <option value=0.25 selected >25%</option>
                        <option value=0.30 >30%</option>
                    @elseif(floor(round($purchase->price_change / (1 - 0.3)) / 10) == $purchase->gain_price)
                        <option value=0.20 >20%</option>
                        <option value=0.25 >25%</option>
                        <option value=0.30 selected>30%</option>
                    @endif
                    </select></td>
                    <td class="price">{{$purchase->gain_price}}8</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="border-top mt-3">
            <div class="h2 mt-2" >備考</div>
            <div>
                <form method="POST" action="{{ route('memos_store', [$y, $m, $d])}}">
                    {{ csrf_field() }}
                    <input type="text" name="text" style="width: 500px;" maxlength="">
                    <button type="submit">Create</button>
                </form>
            </div>
            <div class="mt-2">
                <ul>
                    @foreach($memos as $memo)
                    <li class="d-flex">
                        <div>{{$memo->text}}</div>
                        <div>
                        <form method="POST" action="{{ route('memos_delete', [$memo->id, $y, $m, $d])}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn ml-1" type="submit">[x]</button>
                        </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>
<script src="{{ asset('js/note.js') }}" defer></script>
@endsection
