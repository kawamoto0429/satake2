@extends('layouts.app')

@section('content')
<form method="POST" action="/products/categories/{{$category->id}}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="name" value="{{$category->name}}">
    <select name="maker_id">
        @foreach($makers as $maker)
        @if($maker->id == $category->maker_id)
            <option value="{{$maker->id}}" selected>{{$maker->name}}</option>
        @else
            <option  value="{{$maker->id}}">{{$maker->name}}</option>
        @endif
        @endforeach
    </select>
    <button type="submit">update</button>
    @error('name')
            <div class="error">{{$message}}</div>
    @enderror
</form>

@endsection