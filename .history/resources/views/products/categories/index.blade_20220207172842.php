@extends('layouts.app')

@section('content')
<div class="container">
    <div class="maker-home">
        <label class="label_title">
            カテゴリー
        </label>
    </div>

    <div class="maker-container">
        <div class="maker-form">
        <form method="POST" action="/products/categories">
            {{ csrf_field() }}
            <input type="text" name="name" value="{{old('name')}}">
            <select name="maker_id">
            @foreach($makers as $maker)
                <option  value="{{$maker->id}}">{{$maker->name}}</option>
            @endforeach
            </select>
            <button type="submit">Create</button>
            @error('name')
                <div class="error">{{$message}}</div>
            @enderror
        </form>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col" class="w100px">#</th>
                    <th scope="col">メーカー</th>
                    <th scope="col">カテゴリー</th>
                    <th scope="col" class="w80px"></th>
                    <th scope="col" class="w80px"></th>
                </tr>
                </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <th>{{$category->id}}</th>
                    <td><input type="text" value="{{$category->name}}"></td>
                    <td class="maker-name">
                        <select>
                            @foreach($makers as $maker)
                                @if($maker->id == $category->id)
                                <option value="{{$category->id}}" selected>{{$maker->name}}</option>
                                @else
                                <option value="{{$maker->id}}">{{$maker->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    <td>
                        <a href="/products/categories/{{$category->id}}/edit">編集</a>
                    </td>
                    <td>
                        <form method="POST" action="/products/categories/{{$category->id}}" onsubmit="return confirm('本気ですか？')">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" >delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
