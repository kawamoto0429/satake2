@extends('layouts.app')

@section('content')
<div class="orders-container">
    <div class="orders-top">メーカーを選んでください</div>

    @foreach($makers as $maker)
        <div class="maker">
            <a href="/orders/{{$maker->id}}/home">
                {{$maker->name}}
            </a>
        </div>
    @endforeach

</div>

@endsection