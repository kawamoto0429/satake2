@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <a href="/notes/home/{{$id}}">
            {{$id}}
        </a>
    </div>
    <div>
        <a href="/notes/home/{{$id}}/{{$day-1}}">&lt;</a>
            {{$day}}
        <a href="/notes/home/{{$id}}/{{$day+1}}">&gt;</a>
    </div>
    <div>
        <div class="navbar-header d-flex">
            <ul class="navbar-brand">
                <li class="navbar-brand" value ="0"><a href="#">すべて</a></li>
                @foreach($makers as $maker)
                <li class="navbar-brand" href="/" value ="{{$maker->id}}">
                    <a href="#">{{$maker->name}}</a>
                </li>
                @endforeach
            </ul>
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">メーカー</th>
                    <th scope="col">商品名</th>
                    <th scope="col">個数</th>
                    <th scope="col">値段</th>
                </tr>
            </thead>
            <tbody class="products-list">
                @foreach($purchases as $purchase)
                <tr>
                    <td>{{$purchase->maintenance->maker_name}}</td>
                    <td>{{$purchase->maintenance->name}}</td>
                    <td>{{$purchase->purchase_qty}}</td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
    
        $('.navbar-brand li').click(function(){
        let id = $(this).val();
        let month = {{$id}};
        let day = {{$day}}
        console.log(day);
        console.log(id);
            $.ajax({
                type: "get",
                url: "/notes/maker/ajax",
                data: {
                        'id': id,
                        'day': day,
                        'month': month,
                      },
                dataType: 'json',
            }).done(function(data){
                console.log(data);
                $('.products-list').children().remove();
                $.each(data, function (index, value) {
                console.log(value)
                 html = `
                    <tr>
                        <td>${value.maker_name}</td>
                        <td>${value.maintenance_name}</td>
                        <td>${value.purchase_qty}</td>
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