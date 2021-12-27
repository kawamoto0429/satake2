@extends('layouts.app')

@section('content')


<div class="orders-container w-600px m-auto ">
    <div class="orders-top mb-2 ">
        <a class="btn btn-secondary btn-lg w-100 h-80px p-auto" href="/">
            メーカーを選んでください
        </a>
    </div>

    @foreach($makers as $maker)
        <div class="maker mb-2">
            <a class="btn btn-primary btn-lg w-100 h-80px p-auto" href="/orders/{{$maker->id}}/home">
                {{$maker->name}}
            </a>
        </div>
    @endforeach

</div>

@endsection