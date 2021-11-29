@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/products">home</a>
    <div class="maker-home">
        <label>
            商品一覧
        </label>
    </div>
    <div>
        <a href="{{route('maintenance.create')}}">商品追加</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">メーカー</th>
                <th scope="col">商品名</th>
                <th scope="col">納価/1個</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
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