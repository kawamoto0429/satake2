@extends('layouts.app')
@section('content')
<div class="container">
   
    
    <div class="d-flex">
        @foreach($makers as $maker)
        <div class="ml-3">
            <a href="/purchase/{{$maker->id}}/specify">{{$maker->name}}</a>
        </div>
        @endforeach
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($purchases as $purchase)
                <tr>
                <td>{{$purchase->maintenance->name}}</td>
                    <form method="POST" action="{{route('orders_update', $purchase)}}">
                    <td>
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="number" min="1" name="purchase_qty" value="{{$purchase->purchase_qty}}">個</input>
                    </td>
                        <!--@if($purchase->price_change != null)-->
                            <td><input type="number" min="1" name="price_change" value="{{$purchase->price_change}}"><label>円</label></td>
                        <!--@else-->
                        <!--    @if($purchase->purchase_qty < 10)-->
                            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_1pc}}">円</input>-->
                        <!--    <td><input type="number" min="1" name="price_change" value="{{$purchase->maintenance->price_1pc}}"><label>円</label></td>-->
                        <!--    @elseif($purchase->purchase_qty < 30)-->
                            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_10pcs}}">円</input>-->
                        <!--    <td><input type="number" min="1" name="price_change" value="{{$purchase->maintenance->price_10pcs}}"円><label>円</label></td>-->
                        <!--    @elseif($purchase->purchase_qty >= 30)-->
                            <!--<input type="tel" name="maintenance_pc" value="{{$purchase->maintenance->price_30pcs}}">円</input>-->
                        <!--    <td><input type="number" min="1" name="price_change" value="{{$purchase->maintenance->price_30pcs}}"円><label>円</label></td>-->
                        <!--    @endif-->
                        <!--@endif-->
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
    </div>
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