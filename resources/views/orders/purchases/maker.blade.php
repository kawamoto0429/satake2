
@extends('layouts.app')
@section('content')
<div class="container">
    <nav class="navbar navbar-default mb-4">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand"  href="{{ route("orders")}}">
                    発注
                </a>
            </div>
            <div class="orders-note">
                <div class="navbar-brand" ><a href="/notes/home/{{$today->month}}/{{$today->day-1}}">昨日の納品</a></div>
                <div class="navbar-brand" ><a href="/notes/home/{{$today->month}}/{{$today->day}}">今日の納品</a></div>
                <div class="navbar-brand" ><a href="/notes/home/{{$today->month}}/{{$today->day+1}}">明日の納品</a></div>
                <div class="navbar-brand" >
                    <a href="{{route('orders_purchase')}}">今日の発注</a>
                </div>
            </div>
        </div>
    </nav>


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
</div>    