@extends('layouts.app')

@section('content')
<form method="POST" action="/products/genres/{{$genre->id}}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="name" value="{{$genre->name}}">
    
    <select name="maker_id">
        @foreach($makers as $maker)
        @if($maker->id == $genre->maker_id)
            <option value="{{$maker->id}}" selected>{{$maker->name}}</option>
        @else
            <option  value="{{$maker->id}}">{{$maker->name}}</option>
        @endif
        @endforeach
    </select>
    <select name="category_id">
        @foreach($categories as $category)
        @if($category->id == $genre->category_id)
            <option  value="{{$category->id}}" selected>{{$category->name}}</option>
        @else
            <option  value="{{$category->id}}">{{$category->name}}</option>
        @endif
        @endforeach
    </select>
    <button type="submit">update</button>
    @error('name')
            <div class="error">{{$message}}</div>
    @enderror
</form>

@endsection