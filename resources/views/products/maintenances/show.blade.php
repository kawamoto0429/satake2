@extends('layouts.app')

@section('content')
<div>
    <a href="{{route('maintenance.index')}}">戻る</a>
</div>
<div>
    <a href="{{ route('maintenance.edit', $maintenance)}}">編集</a>
</div>
<div>
    <div>{{$maintenance->name}}</div>
    <div>{{$maintenance->price_1pc}}</div>
    <div>{{$maintenance->price_10pcs}}</div>
    <div>{{$maintenance->price_30pcs}}</div>
    <div>{{$maintenance->jan}}</div>
    <div>{{$maintenance->maker_name}}</div>
    <div>{{$maintenance->category_name}}</div>
    <div>{{$maintenance->genre_name}}</div>
    <div>{{$maintenance->lot}}</div>
</div>
@endsection