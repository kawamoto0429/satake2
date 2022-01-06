@extends('layouts.app')

@section('content')
<form method="POST" action="/products/makers/{{$maker->id}}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="name" value="{{$maker->name}}">
    <input type="file" name="imgpath" value="{{$maker->imgpath}}">
    <button type="submit">update</button>
    @error('name')
            <div class="error">{{$message}}</div>
    @enderror
</form>

@endsection