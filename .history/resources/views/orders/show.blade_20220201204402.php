@extends('layouts.app')
@section('content')
<div class="container">
    
    <div>
        <a href="/orders/{{$maintenance->maker_id}}/home">戻る</a>
    </div>
    
    <div class="d-flex">
        <!--<div><img src="..." alt="..." class="img-thumbnail"></div>-->
        @if($maintenance->imgpath == null)
        <div style="width: 250px; height:180px; background:blue;"><img style="width: 250px; height:180px;" src="{{ secure_asset('img/no_image.jpeg')}}"></div>
        @else
        <div style="width: 250px; height:180px; background:blue;"><img style="width: 250px; height:180px;" src="{{ secure_asset('storage/'.$maintenance->imgpath)}}"></div>
        @endif
        <div class="ml-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">商品名</th>
                        <td>{{$maintenance->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">１個の納価</th>
                        <td>{{$maintenance->price_1pc}}円</td>
                    </tr>
                    <tr>
                        <th scope="row">１０個の納価</th>
                        <td>{{$maintenance->price_10pcs}}円</td>
                    </tr>
                    <tr>
                        <th scope="row">３０個の納価</th>
                        <td>{{$maintenance->price_30pcs}}円</td>
                    </tr>
                    <tr>
                        <th scope="row">入数</th>
                        <td>{{$maintenance->lot}}個</td>
                    </tr>
                </tbody>
            </table>
            <form method="POST" action="{{route('orders_store')}}">
                {{ csrf_field() }}
            <input type="text" name="purchase_qty">個
            <input type="number" min="1" name="arrived_at"> 日後
            <input type="hidden" name="maintenance_id" value="{{$maintenance->id}}">
            <input type="hidden" name="maker_id" value="{{$maintenance->maker_id}}">
            <input type="hidden" name="category_id" value="{{$maintenance->category_id}}">
            <button type="submit">発注</button>
            </form>
        </div>
        
    </div>
</div>
@endsection