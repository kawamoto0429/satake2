@extends('layouts.app')

@section('content')
    <a href="/products">home</a>
<div class="maker-home">
    <label>
        ジャンル
    </label>
</div>

<div class="maker-container">
    <div class="maker-form">
    <form method="POST" action="/products/genres">
        {{ csrf_field() }}
        <input type="text" name="name">
        <select name="maker_id">
        @foreach($makers as $maker)
            <option  value="{{$maker->id}}">{{$maker->name}}</option>
        @endforeach
        </select>
        <select name="category_id">
        @foreach($categories as $category)
            <option  value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
        </select>
       
        <button type="submit">Create</button>
    </form>
</div>

 <table class="maker-table">
        <tbody>
            @foreach($genres as $genre)
            <tr>
                <td>{{$genre->category_name}}</td>
                <td>{{$genre->maker_name}}</td>
                <td
                <td class="maker-name">{{ $genre->name }}</td>
                <td>
                    <a href="/products/genres/{{$genre->id}}/edit">編集</a>
                </td>
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
@endsection