@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <a href="/notes/home/{{$id}}">
            {{$id}}
        </a>
    </div>
    <div>
        <a href="/notes/home/{{$id}}/{{$day-1}}">&lt;</a>
            {{$day}}
        <a href="/notes/home/{{$id}}/{{$day+1}}">&gt;</a>
    </div>
    <div>
        <div class="navbar-header">
            <a class="navbar-brand" href="/">すべて</a>
            @foreach($makers as $maker)
            <a class="navbar-brand" href="/">
                {{$maker->name}}
            </a>
            @endforeach
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">メーカー</th>
                    <th scope="col">商品名</th>
                    <th scope="col">個数</th>
                    <th scope="col">値段</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                <tr>
                    <td>{{$purchase->maintenance->maker_name}}</td>
                    <td>{{$purchase->maintenance->name}}</td>
                    <td>{{$purchase->purchase_qty}}</td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>
@endsection