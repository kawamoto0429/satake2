@extends('layouts.app')


@section('content')
<div class="container">
    <nav class="navbar navbar-default mb-4">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand"  href="{{ route("orders")}}">
                    発注
                </a>
            </div>
            <div class="orders-note">
                <div class="navbar-brand" ><a href="/notes/home/{{$date->month}}/{{$date->day-1}}">昨日の納品</a></div>
                <div class="navbar-brand" ><a href="/notes/home/{{$date->month}}/{{$date->day}}">今日の納品</a></div>
                <div class="navbar-brand" ><a href="/notes/home/{{$date->month}}/{{$date->day+1}}">明日の納品</a></div>
                <div class="navbar-brand" >
                    <a href="{{route('orders_purchase')}}">今日の発注</a>
                </div>
            </div>
        </div>
    </nav>
    
    <h1><a href="{{route('index_home', $maker)}}">{{$maker->name}}</a></h1>
    <div class="container-fluid mt-4">
    <div class="row">
    <div class="clearfix"></div>
    <div class="col sidebar">
        <ul class="navbar-nav " id="genre">
            <li class="nav-item" value="-1"><a href="#">1便</a></li>
            <li class="nav-item" value="-2"><a href="#">2便</a></li>
        @foreach($categories as $category)
            <li class="nav-item dropdown " value="{{$genre_id}}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{$category->name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach($category->genres as $genre)
                      <a class="dropdown-item" href="/orders/{{$maker->id}}/{{$genre->id}}/home">{{$genre->name}}</a>
                    @endforeach  
                </div>
            </li>
        @endforeach
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="search">
        <form>
            <div class="col-xs-2">
                <label>検索</label>
                <input type="text" id="search" class="form-control w20"  placeholder="キーワードを入力してくだい">
            </div>
        </form>
        </div>
         <div class="col">
             <form method="POST" action="/orders/purchase/conclude">
                 {{ csrf_field() }}
                <table class="table text-center table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="w10px"></th>
                            <th scope="col" class="">商品名</th>
                            <th scope="col" class="w150px">納品/１個</th>
                        </tr>
                    </thead>
                    <tbody  class="products-list">
                        @foreach($maintenances as $maintenance)
                        <tr>
                            <th scope="row"><input type="checkbox" name="conclude[]" value="{{$maintenance->id}}"></th>
                            <td><a href="{{route('home_show', $maintenance)}}">{{$maintenance->name}}</a></td>
                            <td>{{$maintenance->price_1pc}}<label>円</label></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
            <input type="text" name="purchase_qty">個
            <input type="number" min="1" name="arrived_at"> 日後
            <button type="submit">確定</button>
            </form>
            {{ $maintenances->links() }}
        
        </div>
    </div>
</div>
<script>
    $(function(){
    
        $('#search').on('input', () => {
            let keywords = $('#search').val();
            console.log(keywords);
            <!--console.log();-->
            $.ajax({
            <!--headers: {-->
            <!--    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
            <!--}, -->
                type: "get",
                url: "/orders/search/ajax",
                data: {
                        'keywords' : keywords,
                        'maker': {{$maker->id}},
                      },
                dataType: 'json',
            }).done(function(data){
                console.log(data);
                $('.products-list').children().remove();
                $.each(data, function (index, value) {
                console.log(value)
                 html = `
                    <tr>
                        <th scope="row"><input type="checkbox" name="conclude[]" value=${value.id}></th>
                        <td><a href="/orders/${value.id}/show">${value.name}</a></td>
                        <td>${value.price_1pc}<label>円</label></td>
                    </tr>    
                  `;
                  $('.products-list').append(html);
                })
            }).fail(function() {
              console.log('失敗');
            }); 
        });
        
        $('#genre li').click(function(){
        let name = $(this).val();
        console.log(name);
        
            $.ajax({
            
                type: "get",
                url: "/orders/genre/ajax",
                data: {
                        'name': name,
                        'maker': {{$maker->id}},
                        'genre': {{$genre_id}},
                      },
                dataType: 'json',
            }).done(function(data){
                console.log(data);
                $('.products-list').children().remove();
                $.each(data, function (index, value) {
                console.log(value)
                 html = `
                    <tr>
                        <th scope="row"><input type="checkbox" name="conclude[]" value=${value.id}></th>
                        <td><a href="/orders/${value.id}/show">${value.name}</a></td>
                        <td>${value.price_1pc}<label>円</label></td>
                    </tr>  
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