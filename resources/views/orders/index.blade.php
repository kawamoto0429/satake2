@extends('layouts.app')

@section('content')


<div class="orders-container">
    <div class="orders-top">
        <a href="/">
            メーカーを選んでください
        </a>
    </div>

    @foreach($makers as $maker)
        <div class="maker">
            <a href="/orders/{{$maker->id}}/home">
                {{$maker->name}}
            </a>
        </div>
    @endforeach

</div>

@endsection