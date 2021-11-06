@extends('layouts.app')

@section('content')
<form method="POST" action="/products/makers/{{$maker->id}}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="name" value="{{$maker->name}}">
    <button type="submit">update</button>
</form>

@endsection