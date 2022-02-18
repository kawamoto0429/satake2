@extends('layouts.app')

@section('content')
<div class="container">

    <div class="maker-home">
        <label>
            商品追加
        </label>
    </div>
    <div class="mb-5 mt-2">
        <form method="POST" action="{{route('csv_store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input class="file" type="file" name="csv_input">
            <button class="fileBtn" disabled>CSVで登録</button>
        </form>
    </div>

    <div>
        <form method="POST" action="{{ route('maintenance.store')}}" enctype="multipart/form-data">
             {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-sm-2" >商品名</label>
                <div class="col-sm-8">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control a" maxlength="40" onKeyUp="limit(15)">
                    @error('name')
                        <div class="error">{{$message}}</div>
                    @enderror
                </div>

            </div>
            <div class="form-group row">
                <label class="col-sm-2" >１個の納価</label>
                <div class="col-sm-8">
                    <input type="number" name="price_1pc" value="{{old('price_1pc')}}" class="form-control " maxlength="40" min=1 >

                    @error('price_1pc')
                    <div class="error">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    円
                </div>

            </div>

            <div class="form-group row">
                <label class="col-sm-2" >１０個の納価</label>
                <div class="col-sm-8">
                    <input type="number" name="price_10pcs" value="{{old('price_10pcs')}}" class="form-control" maxlength="40" min=1 >

                    @error('price_10pcs')
                    <div class="error">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    円
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >３０個の納価</label>
                <div class="col-sm-8">
                    <input type="number" name="price_30pcs" value="{{old('price_30pcs')}}" class="form-control" maxlength="40" min=1 >


                    @error('price_30pcs')
                    <div class="error">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    円
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >JANコード</label>
                <div class="col-sm-8">
                    <input type="text" name="jan" value="{{old("jan")}}" class="form-control" maxlength="40">

                    @error('jan')
                    <div class="error">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">メーカー</label>
                <div class="col-sm-8">
                    <select name="maker_id" id="maker" value="{{old("maker_id")}}" class="form-control">
                    @foreach($makers as $maker)
                        <option  value="{{$maker->id}}">{{$maker->name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">カテゴリー</label>
                <div class="col-sm-8">
                    <select name="category_id" id="category"  value="{{old("category_id")}}" class="form-control">
                    @foreach($categories as $category)
                    @if($category->maker_id == 1)
                        <option  value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">ジャンル</label>
                <div class="col-sm-8">
                    <select name="genre_id" id="genres_select" value="{{old("genre_id")}}" class="form-control">
                    @foreach($genres as $genre)
                    @if($genre->maker_id == 1 && $genre->category_id == 1) //カテゴリーも絞られるように
                        <option id="genre_option" value="{{$genre->id}}">{{$genre->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">入数</label>
                <div class="col-sm-8">
                    <input type="text" name="lot" value="{{old("lot")}}" class="form-control" maxlength="40">
                    @error('lot')
                    <div class="error">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    個
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">2便可</label>
                <div class="col-sm-8">
                    <input type="checkbox" name="tomorrow_flg" class="mr-2"><label>2便ですか？</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">表示しない</label>
                <div class="col-sm-8">
                    <input type="checkbox" name="nodisplay_flg" class="mr-2"><label>表示しないですか？</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">新商品</label>
                <div class="col-sm-8">
                    <input type="checkbox" name="new_flg" class="mr-2"><label>新商品</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">画像アップロード</label>
                <div class="col-sm-8">
                    <input type="file" name="imgpath">
                </div>
            </div>
            <button type="submit">作成</button>

        </form>
    </div>
</div>
<script src="{{ asset('js/maintenance.js') }}" defer></script>
<script src="{{ asset('js/limit.js') }}" defer></script>
@endsection
