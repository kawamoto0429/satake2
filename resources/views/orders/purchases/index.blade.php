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
        <input type="checkbox"  id="category_id" name="category" value="{{$category->id}}">
        {{$category->name}}
    </div>
    @endforeach
</div>
<div>
    @foreach($purchases as $purchase)
    <div class="purchase_maintenance">
        <div>{{$purchase->maintenance->name}}</div>
        <div>{{$purchase->purchase_qty}}個</div>
        @if($purchase->purchase_qty < 10)
        <div>{{$purchase->maintenance->price_1pc}}円</div>
        @elseif($purchase->maintenance->purchase_qty < 30)
        <div>{{$purchase->maintenance->price_10pcs}}円</div>
        @elseif($purchase->maintenance->purchase_qty >= 30)
        <div>{{$purchase->maintenance->price_30pcs}}円</div>
        @endif
    </div>    
    @endforeach
</div>

// <script>
  <!--  $(function(){-->
    
  <!--      $('#category_id').on('click', () => {-->
  <!--          let category = $('[name="category"]:checked').val();-->
  <!--          console.log(category);-->
  <!--          $.ajax({-->
            <!--headers: {-->
            <!--    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
            <!--}, -->
  <!--              type: "get",-->
  <!--              url: "/purchase/category/ajax",-->
  <!--              data: {'category_id': category},-->
  <!--              dataType: 'json',-->
  <!--          }).done(function(data){-->
  <!--              console.log(data)-->
  <!--             $('#genres_select').children().remove();-->
  <!--             $.each(data, function (index, value) {-->
  <!--              html = `-->
  <!--                    <option>${value.name}</option>-->
  <!--               `;-->
  <!--               $('#genres_select').append(html);-->
  <!--             })-->
               
               
              
  <!--          }).fail(function() {-->
  <!--            console.log('失敗');-->
  <!--          }); -->
                 
  <!--      });-->
        
  <!--  });-->
  <!--</script>-->
 @endsection