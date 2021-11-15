
@extends('layouts.app')

@section('content')
<div>
    <div>
        {{$year}}
    </div>
    <div>
        
        <div>
            @foreach($months as $month)
            <a href="/notes/home/{{$month}}">{{$month}}</a>
            @endforeach
        </div>
        
    </div>
</div>
@endsection