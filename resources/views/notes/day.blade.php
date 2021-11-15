@extends('layouts.app')

@section('content')
<div>
    <div>
        {{$id}}
    </div>
    <div>
        
        <div>
            @foreach($days as $day)
            <a href="/notes/home/{{$id}}/{{$day}}">{{$day}}</a>
            @endforeach
        </div>
        
    </div>
</div>