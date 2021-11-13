@extends('layouts.app')
<div class="orders-header">
    <div class="orders-1">
        <a href="{{ route("orders")}}">
            発注
        </a>
    </div>
    <div class="orders-note">
        <div class="orders-1">昨日ノート</div>
        <div class="orders-1">今日ノート</div>
    </div>
</div>
<div>
    @foreach($purchases as $purchase)
    <div class="purchase_maintenance">
        <div>{{$purchase->maintenance->name}}</div>
        <div>{{$purchase->purchase_qty}}</div>
        @if($purchase->purchase_qty < 10)
        <div>{{$purchase->price_1pc}}</div>
        @elseif($purchase->maintenance->purchase_qty < 30)
        <div>{{$purchase->maintenance->price_10pcs}}</div>
        @elseif($purchase->maintenance->purchase_qty >= 30)
        <div>{{$purchase->maintenance->price_30pcs}}</div>
        @endif
    </div>    
    @endforeach
</div>
