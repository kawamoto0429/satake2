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
    <form>
        <input tyoe="text">
        <button type="submit">検索</button>
    </form>
</div>

<div class="orders-maker">
    <div class="genres-sort">
        <ul>
            @foreach($maker->genres as $genre)
                <li class="genre-select" value="{{$genre->id}}">{{$genre->name}}</li>
            @endforeach
        </ul>
        
    </div>
    <div class="products-list">
        
        
        @foreach($maintenances as $maintenance)
        <div>
            <input type="checkbox" name="" value="{{$maintenance}}"><a href="{{route('home_show', $maintenance)}}">{{$maintenance->name}}</a>
            <input type="text" name="" value="{{$maintenance->price_1pc}}">円
            <input type="text" name="">個
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
    
        $('.genre-select').on('click', () => {
            let genre = $('.genre-select').val();
            console.log(genre);
            $.ajax({
            <!--headers: {-->
            <!--    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
            <!--}, -->
                type: "get",
                url: "/orders/genre/ajax",
                data: {'genre': genre},
                dataType: 'json',
            }).done(function(data){
                console.log(data['genres'])
                console.log(data['categories'])
                $('#category').children().remove();
                $.each(data['categories'], function (index, value) {
                console.log(value)
                 html = `
                        <option value= ${value.id}>選択肢</option> 
                       <option value = ${value.id}>${value.name}</option>
                  `;
                  $('#category').append(html);
                })
                
                $('#genres_select').children().remove();
                
                $.each(data['genres'], function (index, value) {
                console.log(value.id)
                
                 html = `
                       
                       <option value = ${value.id}>${value.name}</option>
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