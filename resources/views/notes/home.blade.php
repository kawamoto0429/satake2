
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="">
        <h1>{{$year}}</h1>
    </div>
    <div>
        
        <div class="d-flex">
            @foreach($months as $month)
            <div class="w-auto p-3 ml-1" style="background: aqua" >
                <a class="nav-link" href="/notes/home/{{$month}}">{{$month}}</a>
            </div>
            @endforeach
        </div>
        
    </div>
</div>

@endsection