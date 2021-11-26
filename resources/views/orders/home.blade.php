@extends('layouts.app')

@section('content')
<div class="orders-header">
    <div class="orders-1">
        <a href="{{ route("orders")}}">
            発注
        </a>
    </div>
    <div class="orders-note">
        <div class="orders-1">昨日ノート</div>
        <div class="orders-1">今日ノート</div>
        <div class="orders-1">
            <a href="{{route('orders_purchase')}}">今日の発注</a>
        </div>
    </div>
</div>

<h1>{{$maker->name}}</h1>

<div class="search">
    <form >
        <input tyoe="text" value="" id="search">
    </form>
</div>

<div class="orders-maker">
    <div class="genres-sort">
        
            @foreach($maker->genres as $genre)
            <div>
                <input type="checkbox" value="{{$genre->id}}">{{$genre->name}}
            </div>
            @endforeach
        
        
    </div>
    <div class="products-list">
        
        
        @foreach($maintenances as $maintenance)
        <div>
            <input type="checkbox" name="" value="{{$maintenance}}"><a href="{{route('home_show', $maintenance)}}">{{$maintenance->name}}</a>
            <input type="text" name="" value="{{$maintenance->price_1pc}}"><label>円</label>
            <input type="text" name=""><label>個</label>
        </div>
        @endforeach
        <!--<form method="POST" action="{{ route('orders_select') }}">-->
        <form method="POST" action="/">
        <button type="submit">確定</button>
        </form>
        {{ $maintenances->links() }}
    
    <!--<div>-->
    <!---->
    <!--</div>-->
    </div>
    
</div>
<script>
    $(function(){
    
        $('#search').on('input', () => {
            let keywords = $('#search').val();
            console.log(keywords);
            $.ajax({
            <!--headers: {-->
            <!--    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
            <!--}, -->
                type: "get",
                url: "/orders/search/ajax",
                data: {'keywords': keywords},
                dataType: 'json',
            }).done(function(data){
                console.log(data);
                $('.products-list').children().remove();
                $.each(data, function (index, value) {
                console.log(value)
                 html = `
                        <input type="checkbox" name=""><a href="/orders/${value.id}/show">${value.name}</a>
                        <input type="text" name="" value=${value.price_1pc}><label>円</label>
                        <input type="text" name=""><label>個</label>
                  `;
                  $('.products-list').append(html);
                })
                
               
               
              
            }).fail(function() {
              console.log('失敗');
            }); 
                 
        });
        
        

    });
</script>
@endsection