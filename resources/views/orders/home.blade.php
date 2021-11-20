@extends('layouts.app')

@section('content')
<div class="orders-header">
    <div class="orders-1">
        <a href="{{ route("orders")}}">
            発注
        </a>
    </div>
    <div class="orders-note">
        <div class="orders-1">昨日ノート</div>
        <div class="orders-1">今日ノート</div>
        <div class="orders-1">
            <a href="{{route('orders_purchase')}}">今日の発注</a>
        </div>
    </div>
</div>

<h1>{{$maker->name}}</h1>

<div class="search">
    <form>
        <input tyoe="text">
        <button type="submit">検索</button>
    </form>
</div>

<div class="orders-maker">
    <div class="genres-sort">
        <form>
            @foreach($maker->genres as $genre)
               <div><input type="checkbox">{{$genre->name}}</div>
            @endforeach
        <button type="submit">絞り込み</button>
        </form>
    </div>
    <div class="products-list">
        
        
        @foreach($maintenances as $maintenance)
        <div>
            <input type="checkbox" name="" value="{{$maintenance}}"><a href="{{route('home_show', $maintenance)}}">{{$maintenance->name}}</a>
            <input type="text" name="" value="{{$maintenance->price_1pc}}">円
            <input type="text" name="">個
        </div>
        @endforeach
        <!--<form method="POST" action="{{ route('orders_select') }}">-->
        <form method="POST" action="/">
        <button type="submit">確定</button>
        </form>
    
    <!--<div>-->
    <!---->
    <!--</div>-->
    </div>
    
</div>
@endsection