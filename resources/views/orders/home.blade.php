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
            <div class="navbar-brand" >昨日ノート</div>
            <div class="navbar-brand" >今日ノート</div>
            <div class="navbar-brand" >
                <a href="{{route('orders_purchase')}}">今日の発注</a>
            </div>
        </div>
        </div>
    </nav>
    
    <h1>{{$maker->name}}</h1>
    <div class="container-fluid mt-4">
    <div class="row">
    <div class="clearfix"></div>
    <div class="col sidebar">
        <ul class="navbar-nav" id="genre">
            @foreach($maker->genres as $genre)
                <li class="nav-item" value={{$genre->id}}>{{$genre->name}}</li>
            @endforeach
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="search">
        <form>
            <dov class="col-xs-2">
                <label>検索</label>
                <input type="text" id="search" class="form-control w20"  placeholder="キーワードを入力してくだい">
            </dov>
        </form>
        </div>
         <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">チェック</th>
                        <th scope="col">商品名</th>
                        <th scope="col">納品/１個</th>
                        <th scope="col">数量</th>
                    </tr>
                </thead>
                <tbody  class="products-list">
                    @foreach($maintenances as $maintenance)
                    <tr>
                        <th scope="row"><input type="checkbox" name="" value="{{$maintenance->id}}"></th>
                        <td><a href="{{route('home_show', $maintenance)}}">{{$maintenance->name}}</a></td>
                        <td><input type="text" name="" value="{{$maintenance->price_1pc}}"><label>円</label></td>
                        <td><input type="text" name=""><label>個</label></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--<form method="POST" action="{{ route('orders_select') }}">-->
            <form method="POST" action="/">
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
                    <tr>
                        <th scope="row"><input type="checkbox" name=${value.id}></th>
                        <td><a href="/orders/${value.id}/show">${value.name}</a></td>
                        <td><input type="text" name="" value=${value.price_1pc}><label>円</label></td>
                        <td><input type="text" name=""><label>個</label></td>
                    </tr>    
                  `;
                  $('.products-list').append(html);
                })
            }).fail(function() {
              console.log('失敗');
            }); 
        });
        
        $('#genre li').click(function(){
        let id = $(this).val();
        console.log(id);
        <!--alert('テキスト:' + text);-->
        <!--$('#genre li').on('click', () => {-->
        <!--    let id = $('#genre li').text();-->
            <!--console.log(id); -->
            <!--１以外のをクリックしても１しか返ってこない-->
            $.ajax({
            <!--headers: {-->
            <!--    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
            <!--}, -->
                type: "get",
                url: "/orders/genre/ajax",
                data: {'id': id},
                dataType: 'json',
            }).done(function(data){
                console.log(data);
                $('.products-list').children().remove();
                $.each(data, function (index, value) {
                console.log(value)
                 html = `
                    <tr>
                        <th scope="row"><input type="checkbox" name=${value.id}></th>
                        <td><a href="/orders/${value.id}/show">${value.name}</a></td>
                        <td><input type="text" name="" value=${value.price_1pc}><label>円</label></td>
                        <td><input type="text" name=""><label>個</label></td>
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