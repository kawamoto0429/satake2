@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/products/maintenances">商品一覧</a>
    <div class="maker-home">
        <label>
            商品編集
        </label>
    </div>
    <div>
        
        <form method="POST" action="{{ route('maintenance.update', $maintenance)}}">
            <input type="hidden" name="_method" value="PUT">
             {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-sm-2" >商品名</label>
                <div class="col-sm-8">
                    <input type="text" name="name" value={{ $maintenance->name }} class="form-control">
                    @error('name')
                        <div class="error">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >１個の納価</label>
                <div class="col-sm-8">
                    <input type="text" name="price_1pc" value="{{$maintenance->price_1pc}}" class="form-control">
                </div>
                    <label class="col-sm-1" >円</label>
                    @error('price_1pc')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2" >１０個の納価</label>
                <div class="col-sm-8">
                    <input type="text" name="price_10pcs" value={{$maintenance->price_10pcs}} class="form-control">
                </div>
                    <label class="col-sm-1" >円</label>
                    @error('price_10pcs')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >３０個の納価</label>
                <div class="col-sm-8">
                    <input type="text" name="price_30pcs" value={{$maintenance->price_30pcs}} class="form-control">
                </div>
                    <label class="col-sm-1" >円</label>
                    @error('price_30pcs')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >JANコード</label>
                <div class="col-sm-8">
                    <input type="text" name="jan" value={{$maintenance->jan}} class="form-control">
                </div>
                    @error('jan')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-2">メーカー</label>
                <div class="col-sm-8">
                    <select name="maker_id" id="maker" value="{{old("maker_id")}}" class="form-control">
                    @foreach($makers as $maker)
                    @if($maker->id == $maintenance->maker_id)
                        <option value="{{$maker->id}}" selected>{{$maker->name}}</option>
                    @else
                        <option  value="{{$maker->id}}">{{$maker->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">カテゴリー</label>
                <div class="col-sm-8">
                    <select name="category_id" id="category"  value="{{old("category_id")}}" class="form-control">
                    @foreach($categories as $category)
                    @if($category->id == $maintenance->category_id)
                        <option  value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
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
                    @if($genre->id == $maintenance->genre_id)
                        <option  value="{{$genre->id}}" selected>{{$genre->name}}</option>
                    @else
                        <option  value="{{$genre->id}}">{{$genre->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">入数</label>
                <div class="col-sm-8">
                    <input type="text" name="lot" value="{{$maintenance->lot}}" class="form-control">
                </div>
                <label>個</label>
                    @error('lot')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-2">2便可</label>
                <div class="col-sm-8">
                    @if($maintenance->tomorrow_flg == 1)
                        <input type="checkbox" name="tomorrow_flg" class="mr-2" checked><label>2便ですか？</label>
                    @else
                        <input type="checkbox" name="tomorrow_flg" class="mr-2"><label>2便ですか？</label>
                    @endif
                </div>
            </div>
            <button type="submit">編集</button>
        
        </form>
    </div>
</div>
@endsection