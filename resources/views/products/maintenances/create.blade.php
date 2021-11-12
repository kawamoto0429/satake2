@extends('layouts.app')

@section('content')
<a href="/products">home</a>
<div class="maker-home">
    <label>
        商品追加
    </label>
</div>
<div>
    <form method="POST" action="{{ route('maintenance.store')}}">
        {{ csrf_field() }}
        <label>商品名</label>
        <input type="text" name="name">
        <div>
        <div>
            <label>１個の納価</label>
            <input type="text" name="price_1pc">
            <label>円</label>
        </div>
        <div>
            <label>１０個の納価</label>
            <input type="text" name="price_10pcs">
            <label>円</label>
        </div>
        <div>
            <label>３０個の納価</label>
            <input type="text" name="price_30pcs">
            <label>円</label>
        </div>
        <div>
            <label>JANコード</label>
            <input type="text" name="jan">
        </div>
        <label>メーカー</label>
        <select name="maker_id">
        @foreach($makers as $maker)
            <option  value="{{$maker->id}}">{{$maker->name}}</option>
        @endforeach
        </select>
        </div>
        <div>
        <label>カテゴリー</label>
        <select name="category_id">
        @foreach($categories as $category)
            <option  value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
        </select>
        </div>
        <div>
        <label>ジャンル</label>
        <select name="genre_id">
        @foreach($genres as $genre)
            <option  value="{{$genre->id}}">{{$genre->name}}</option>
        @endforeach
        </select>
        </div>
        <div>
            <label>入数</label>
            <input type="text" name="lot">
            <label>個</label>
        </div>
        <button type="submit">Create</button>

    </form>
</div>
@endsection