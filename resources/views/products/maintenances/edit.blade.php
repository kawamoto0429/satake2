@extends('layouts.app')

@section('content')
<a href="/products">home</a>
<div class="maker-home">
    <label>
        商品追加
    </label>
</div>
<div>
    <form method="POST" action="{{ route('maintenance.update', $maintenance)}}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <label>商品名</label>
        <input type="text" name="name" value="{{ $maintenance->name }}">
        <div>
        <div>
            <label>１個の納価</label>
            <input type="text" name="price_1pc" value="{{$maintenance->price_1pc}}">
            <label>円</label>
        </div>
        <div>
            <label>１０個の納価</label>
            <input type="text" name="price_10pcs" value="{{$maintenance->price_10pcs}}">
            <label>円</label>
        </div>
        <div>
            <label>３０個の納価</label>
            <input type="text" name="price_30pcs" value="{{$maintenance->price_30pcs}}">
            <label>円</label>
        </div>
        <div>
            <label>JANコード</label>
            <input type="text" name="jan" value="{{$maintenance->jan}}">
        </div>
        <div>
        <label>メーカー</label>
        <select name="maker_id">
            @foreach($makers as $maker)
            @if($maker->id == $maintenance->maker_id)
                <option value="{{$maker->id}}" selected>{{$maker->name}}</option>
            @else
                <option  value="{{$maker->id}}">{{$maker->name}}</option>
            @endif
            @endforeach
        </select>
        </div>
        <div>
        <label>カテゴリー</label>
        <select name="category_id">
            @foreach($categories as $category)
            @if($category->id == $maintenance->category_id)
                <option  value="{{$category->id}}" selected>{{$category->name}}</option>
            @else
                <option  value="{{$category->id}}">{{$category->name}}</option>
            @endif
            @endforeach
        </select>
        </div>
        <div>
        <label>ジャンル</label>
        <select name="genre_id">
            @foreach($genres as $genre)
            @if($genre->id == $maintenance->genre_id)
                <option  value="{{$genre->id}}" selected>{{$genre->name}}</option>
            @else
                <option  value="{{$genre->id}}">{{$genre->name}}</option>
            @endif
            @endforeach
        </select>
        </div>
        <div>
            <label>入数</label>
            <input type="text" name="lot" value="{{$maintenance->lot}}">
            <label>個</label>
        </div>
        <button type="submit">Create</button>

    </form>
</div>
@endsection