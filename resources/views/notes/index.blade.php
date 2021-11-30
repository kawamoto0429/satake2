@extends('layouts.app')

@section('content')

<div>
    <h1>{{$today}}</h1>
    @foreach($purchases as $purchase)
    <div>
        {{$purchase->maintenance->name}}
    </div>
    @endforeach
</div>
@endsection