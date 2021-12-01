@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1><a href="/notes/home">{{$id}}</a></h1>
    </div>
    <div>
        <div class="">
            @foreach($days as $day)
            <div class="w-auto p-3 mb-1" style="background: aqua" >
                <a href="/notes/home/{{$id}}/{{$day}}">{{$day}}</a>
            </div>
            @endforeach
        </div>
        
    </div>
</div>