@extends('layouts.app')

@section('content')
<div class="container">
    <div class="note">
        <p>ノート確認</p>
    </div>
    <div class="orders">
        <a href="{{ route('orders')}}">
            <p>発注</p>
        </a>
    </div>
    <div class="products">
        <a href="{{ route('products')}}">
            <p>商品管理</p>
        </a>
    </div>
    <div class="pop">
        <a href="/pops">
            <p>POP印刷</p>
        </a>
    </div>
</div>
@endsection