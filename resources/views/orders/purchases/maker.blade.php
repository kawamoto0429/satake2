
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
            <a href="/">今日ノート</a>
        </div>
        <div class="orders-1">
            <a href="{{route('orders_purchase')}}">今日の発注</a>
        </div>
    </div>
</div>

@foreach($purchases as $purchase)
    <div>
        <div>{{$purchase->maintenance->name}}</div>
        <div>{{$purchase->purchase_qty}}<label>個</label></div>
            @if($purchase->purchase_qty < 10)
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_1pc}}">円</input>-->
            <div>{{$purchase->maintenance->price_1pc}}円</div>
            @elseif($purchase->purchase_qty < 30)
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_10pcs}}">円</input>-->
            <div>{{$purchase->maintenance->price_10pcs}}円</div>
            @elseif($purchase->purchase_qty >= 30)
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_30pcs}}">円</input>-->
            <div>{{$purchase->maintenance->price_30pcs}}円</div>
            @endif
    </div>
@endforeach
    <div>
        <a href="/pdf/{{$maker->id}}">確定</a>
    </div>


@endsection