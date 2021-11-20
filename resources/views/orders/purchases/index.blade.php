@extends('layouts.app')
@section('content')
<div class="orders-header">
    <div class="orders-1">
        <a href="{{ route("orders")}}">
            発注
        </a>
    </div>
    <div class="orders-note">
        <div class="orders-1">
            <a href="{{route("note_sub")}}">昨日ノート</a>
        </div>
        <div class="orders-1">
            <a href="{{route("note_today")}}">今日ノート</a>
        </div>
    </div>
</div>

<div>
    <a href="{{route('orders')}}">メーカー</a>
</div>

<div class="purchase_category">
    @foreach($categories as $category)
    <div>
        <input type="checkbox"  class="category_id" name="category" value="{{$category->id}}">
        {{$category->name}}
    </div>
    @endforeach
    @foreach($makers as $maker)
    <div>
        <!--<a href="/purchase/{{$maker->id}}/specify">{{$maker->name}}</a>-->
        {{$maker->name}}
    </div>
    @endforeach
</div>
<div>
    @foreach($purchases as $purchase)
    <div class="purchase_maintenance">
        <div>{{$purchase->maintenance->name}}</div>
        <form method="POST" action="{{route('orders_update', $purchase)}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="tel" name="purchase_qty" value="{{$purchase->purchase_qty}}">個</input>
            @if($purchase->purchase_qty < 10)
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_1pc}}">円</input>-->
            <div>{{$purchase->maintenance->price_1pc}}円</div>
            @elseif($purchase->purchase_qty < 30)
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_10pcs}}">円</input>-->
            <div>{{$purchase->maintenance->price_10pcs}}円</div>
            @elseif($purchase->purchase_qty >= 30)
            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_30pcs}}">円</input>-->
            <div>{{$purchase->maintenance->price_30pcs}}円</div>
            @endif
            <div>{{$purchase->arrived_at}}日後</div>
            <button type="submit">編集</button>
        </form>
        <form method="POST" action="{{route('orders_delete', $purchase)}}" onsubmit="return confirm('本気ですか？')">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit">削除</button>
        </form>
    </div>    
    @endforeach
</div>
<div>
    <a href="/pdf">確定</a>
</div>

<script>
    $(function(){
    
        $('.category_id').on('click', () => {
            let category = $('[name="category"]:checked').val();
            console.log(category);
            $.ajax({
            <!--headers: {-->
            <!--    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
            <!--}, -->
                type: "get",
                url: "/purchase/category/ajax",
                data: {'category_id': category},
                dataType: 'json',
            }).done(function(data){
                console.log(data)
               $('#genres_select').children().remove();
               $.each(data, function (index, value) {
                html = `
                      <option>${value.name}</option>
                 `;
                 $('#genres_select').append(html);
               })
               
               
              
            }).fail(function() {
              console.log('失敗');
            }); 
                 
        });
        
    });
  </script>
 @endsection