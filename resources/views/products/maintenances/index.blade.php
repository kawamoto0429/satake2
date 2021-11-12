@extends('layouts.app')

@section('content')
<a href="/products">home</a>
<div class="maker-home">
    <label>
        商品一覧
    </label>
</div>
<div>
    <a href="{{route('maintenance.create')}}">商品追加</a>
</div>
<div >
    @foreach($maintenances as $maintenance)
    <div class="maintenances-list">
        <div>{{$maintenance->maker_name}}</div>
        <div>{{$maintenance->name}}</div>
        <div>{{$maintenance->price_1pc}}</div>
        <div>
            <a href="{{ route('maintenance.show', $maintenance)}}">詳細</a>
        </div>
        <div>
            <a href="{{ route('maintenance.edit', $maintenance)}}">編集</a>
        </div>
        <div>
            <form method="POST" action="{{route('maintenance.delete', $maintenance)}}" onsubmit="return confirm('本気ですか？')">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit">delete</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection