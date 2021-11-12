@extends('layouts.app')

@section('content')
<div class="products-container">
    <div class="products-home">
        <a href="/">
            商品管理
        </a>
    </div>
    <div class="maintenance">
        <a href="{{route('maintenance.index')}}">
            商品メンテナンス
        </a>
    </div>
    <div class="maker">
        <a href="/products/makers">
            メーカー
        </a>
    </div>
    <div class="category">
        <a href="/products/categories">
            カテゴリー
        </a>
    </div>
    <div class="genre">
        <a href="/products/genres">
            ジャンル
        </a>
    </div>
    
</div>
@endsection