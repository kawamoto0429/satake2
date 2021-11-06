@extends('layouts.app')

@section('content')
<div class="products-container">
    <div class="products-home">商品管理</div>
    <div class="maintenance">
        商品メンテナンス
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