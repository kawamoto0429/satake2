@extends('layouts.app')

@section('content')
<div class="container  w-600px ">
    <div class="products-home mb-2">
        <a class="btn btn-secondary btn-lg w-100 h-80px p-auto" href="/">
            商品管理
        </a>
    </div>
    <div class="maintenance mb-2">
        <a class="btn btn-primary btn-lg w-100 h-80px p-auto" href="{{route('maintenance.index')}}">
            商品メンテナンス
        </a>
    </div>
    <div class="maker mb-2">
        <a class="btn btn-primary btn-lg w-100 h-80px p-auto"  href="/products/makers">
            メーカー
        </a>
    </div>
    <div class="category mb-2">
        <a class="btn btn-primary btn-lg w-100 h-80px p-auto" href="/products/categories">
            カテゴリー
        </a>
    </div>
    <div class="genre mb-2">
        <a class="btn btn-primary btn-lg w-100 h-80px p-auto" href="/products/genres">
            ジャンル
        </a>
    </div>
    
</div>
@endsection