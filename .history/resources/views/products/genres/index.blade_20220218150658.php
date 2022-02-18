@extends('layouts.app')

@section('content')
<div class="container">
    <div class="maker-home">
        <label class="label_title">
            ジャンル
        </label>
    </div>

    <div class="maker-container">
        <div class="maker-form">
        <form method="POST" action="/products/genres">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="name" class="w-300px a" value="{{old('name')}}" maxlength="15"onKeyUp="limit(15)">
                <select name="maker_id" id="maker">
                @foreach($makers as $maker)

                    <option  value="{{$maker->id}}">{{$maker->name}}</option>
                @endforeach
                </select>
                <select name="category_id" id="category_select">
                @foreach($categories as $category)
                @if($category->maker_id == 1)
                    <option  value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                @endforeach
                </select>
                <button type="submit" class="c_btn">Create</button>
                @error('name')
                    <div class="error">{{$message}}</div>
                @enderror
            </div>
        </form>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col" class="w100px">#</th>
                <th scope="col">メーカー</th>
                <th scope="col">カテゴリー</th>
                <th scope="col">ジャンル</th>
                <th scope="col" class="w80px"></th>
                <th scope="col" class="w80px"></th>
            </tr>
        </thead>
        <tbody>
                @foreach($genres as $genre)
                <tr>
                    <form method="POST" action="/products/genres/{{$genre->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <th>{{$genre->id}}</th>
                    <td><select name="maker_id" class="maker_name">
                    @foreach($makers as $maker)
                    @if($maker->id == $genre->maker_id)
                    <option value="{{$genre->maker_id}}" selected>{{$genre->maker_name}}</option>
                    @else
                    <option value="{{$maker->id}}">{{$maker->name}}</option>
                    @endif
                    @endforeach
                    </select></td>
                    <td><select name="category_id" class="category_name">
                    @foreach($makers as $maker)
                    @foreach($maker->categories as $category)
                    @if($category->id == $genre->category_id)
                    <option value="{{$genre->category_id}}"selected>{{$genre->category_name}}</option>
                    @elseif($category->maker_id == $genre->maker_id)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach
                    @endforeach
                    </select></td>
                    <td><input name="name" class="w-300px" value="{{ $genre->name }}" maxlength="15"></td>
                    <td>
                        <button type="submit">編集</button>
                    </td>
                    </form>
                    <td>
                        <form method="POST" action="/products/genres/{{$genre->id}}" onsubmit="return confirm('本気ですか？')">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit">delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
</div>


</div>
<script src="{{ asset('js/genre.js') }}" defer></script>
<script src="{{ asset('js/limit.js') }}" defer></script>
@endsection
