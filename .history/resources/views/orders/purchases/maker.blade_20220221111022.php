
@extends('layouts.app')
@section('content')
<div class="container">

    <div class="d-flex">
        <div class="ml-3">
            <a href="{{route('orders_purchase')}}">発注一覧</a>
        </div>
        <div class="d-flex  ml-4">
            @foreach($counting as $category => $c)
            <div class="ml-4">
                <label>{{$category}}</label>
                <label>{{$c}}</label>
                <label>個</label>
            </div>
            @endforeach
        </div>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th scope="col">商品名</th>
                    <th scope="col" class="w120px">数量</th>
                    <th scope="col" class="w120px">納価</th>
                    <th scope="col">納品日</th>
                    <th scope="col" class="w80px"></th>
                    <th scope="col" class="w80px"></th>
                </tr>
            </thead>
            <tbody class="text-center">
            @foreach($purchases as $purchase)
                <tr>
                <td>{{$purchase->maintenance->name}}</td>
                    <form method="POST" action="{{route('orders_update', $purchase)}}">
                    <td>
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="number" min="1" name="purchase_qty" value="{{$purchase->purchase_qty}}" class="w60px">個
                    </td>
                    <td>
                        <input type="number" min="1" name="price_change" value="{{$purchase->price_change}}" class="w60px"><label>円</label>
                    </td>
                    <td>
                        <div><label>納品日</label>{{date('m月d日', strtotime($purchase->arrived_at))}}</div>
                    </td>
                    <td>
                        <button type="submit">編集</button>
                    </td>
                    </form>
                    <form method="POST" action="{{route('orders_delete', $purchase)}}" onsubmit="return confirm('本気ですか？')">
                        @csrf
                    <td>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">削除</button>
                    </td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-1 mb-1 row justify-content-center">
            {{ $purchases->links() }}
        </div>
    </div>
    <div class="btn btn-outline-dark">
        <a class="block-btn" href="/pdf/{{$maker->id}}">確定</a>
    </button>
    @endsection

</div>
