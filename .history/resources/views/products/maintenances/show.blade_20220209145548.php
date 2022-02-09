@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <a href="{{route('maintenance.index')}}">戻る</a>
    </div>
    <div>
        <a href="{{ route('maintenance.edit', $maintenance)}}">編集</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">概要</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">商品名</th>
                <td>{{$maintenance->name}}</td>
                </tr>
                <tr>
                <th scope="row">１個あたりの納価</th>
                <td>{{$maintenance->price_1pc}}</td>
                </tr>
                <tr>
                <th scope="row">１０個あたりの納価</th>
                <td>{{$maintenance->price_10pcs}}</td>
                </tr>
                <tr>
                <th scope="row">３０個あたりの納価</th>
                <td>{{$maintenance->price_30pcs}}</td>
                </tr>
                <tr>
                <th scope="row">JANコード</th>
                <td>{{$maintenance->jan}}</td>
                </tr>
                <tr>
                <th scope="row">メーカー名</th>
                <td>{{$maintenance->maker_name}}</td>
                </tr>
                <tr>
                <th scope="row">カテゴリー名</th>
                <td>{{$maintenance->category_name}}</td>
                </tr>
                <tr>
                <th scope="row">ジャンル名</th>
                <td>{{$maintenance->genre_name}}</td>
                </tr>
                <tr>
                <th scope="row">入数</th>
                <td>{{$maintenance->lot}}</td>
                </tr>
                <tr>
                <th scope="row">２便可</th>
                @if($maintenance->tomorrow_flg == 1)
                    <td>○</td>
                @else
                    <td>なし</td>
                @endif
                </tr>
                <th scope="row">表示</th>
                @if($maintenance->nodisplay_flg == 1)
                    <td>なし</td>
                @else
                    <td>あり</td>
                @endif
                </tr>
                <th scope="row">新商品</th>
                @if($maintenance->new_flg == 1)
                    <td>○</td>
                @else
                    <td>✖️</td>
                @endif
                </tr>
                <th scope="row">画像</th>
                <td><img class="maintenance-img" src="{{ a$maintenance->imgpath)}}"><label>{{$maintenance->imgpath}}</label></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
