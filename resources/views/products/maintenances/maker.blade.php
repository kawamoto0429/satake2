@extends('layouts.app')

@section('content')
<div class="container">
    <div class="maker-home">
        
        <h1>
            <a href="{{route('maintenance.index')}}">{{$maker->name}}</a>
        </h1>
    </div>
    <div>
        <a href="{{route('maintenance.create')}}" class="mr-4">商品追加</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" class="w100px">#</th>
                <th scope="col" class="w150px">メーカー</th>
                <th scope="col">商品名</th>
                <th scope="col" class="w100px">納価/1個</th>
                <th scope="col" class="w80px"></th>
                <th scope="col" class="w80px"></th>
                <th scope="col" class="w80px"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($maintenances as $maintenance)
            <tr>
                <th scope="row">{{$maintenance->id}}</th>
                <td>{{$maintenance->maker_name}}</td>
                <td>{{$maintenance->name}}</td>
                <td>{{$maintenance->price_1pc}}円</td>
                <td><a href="{{ route('maintenance.show', $maintenance)}}">詳細</a></td>
                <td><a href="{{ route('maintenance.edit', $maintenance)}}">編集</a></td>
                <td>
                    <form method="POST" action="{{route('maintenance.delete', $maintenance)}}" onsubmit="return confirm('本気ですか？')">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection