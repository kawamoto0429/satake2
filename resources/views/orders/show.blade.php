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
        <div class="orders-1">
            <a href="{{route("note_today")}}">今日ノート</a>
        </div>
        <div class="orders-1">
            <a href="{{route('orders_purchase')}}">今日の発注</a>
        </div>
    </div>
</div>

<div>
    <a href="/orders/{{$maintenance->maker_id}}/home">戻る</a>
</div>

<div>
    <div>{{$maintenance->name}}</div>
    <div>{{$maintenance->price_1pc}}</div>
    <div>{{$maintenance->price_10pcs}}</div>
    <div>{{$maintenance->price_30pcs}}</div>
    <div>{{$maintenance->jan}}</div>
    <div>{{$maintenance->maker_name}}</div>
    <div>{{$maintenance->category_name}}</div>
    <div>{{$maintenance->genre_name}}</div>
    <div>{{$maintenance->lot}}</div>
</div>
<div>
    <form method="POST" action="{{route('orders_store')}}">
        {{ csrf_field() }}
    <input type="text" name="purchase_qty">個
    <input type="tel" name="arrived_at"> 日後
    <input type="hidden" name="maintenance_id" value="{{$maintenance->id}}">
    <button type="submit">発注</button>
    </form>
</div>

@endsection