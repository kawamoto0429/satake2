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
                    <th scope="col ">粗利割</th>
                    <th scope="col">値段</th>
                </tr>
            </thead>
            <tbody class="products-list">
                @foreach($purchases as $purchase)
                <tr>
                    <input type="hidden" value="{{$purchase->id}}" class="id">
                    <td>{{$purchase->maintenance->maker_name}}</td>
                    <td>{{$purchase->maintenance->name}}</td>
                    <td>{{$purchase->purchase_qty}}</td>
                    <td><select class="gain" name="percent">
                        <option value=0.20>20%</option>
                        <option value=0.25>25%</option>
                        <option value=0.30>30%</option>
                    </select></td>
                    <td class="price">{{$purchase->gain_price}}8</td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
    <div>
        <a href="/pdf/{{$id}}/{{$day}}">確定</a>
    </div>
</div>
<script>
    $(function(){
    
        $('.navbar-brand li').click(function(){
        let id = $(this).val();
        let month = {{$id}};
        let day = {{$day}};
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
        
        $('.gain').change(function(){
            let select = $(this).closest('tr').children('td').find('select');
            let p = $(this).closest('tr')
            let percent = $(this).closest('tr').children('td').find('select').val();
            let id = $(this).closest('tr').find('input').val();
            console.log(price);
            $.ajax({
                type: "get",
                url: "/notes/gain/ajax",
                data: {
                        'id': id,
                        'percent': percent,
                      },
                dataType: 'json',
            }).done(function(data){
                console.log(data)
                let percent = data['percent'];
                console.log(percent)
                p.find("td.price").remove();
                data['purchase']
                console.log(data['purchase']['gain_price'])
                 html = `
                        <td class="price">${data['purchase']['gain_price']}8</td>
                  `;
                  p.append(html);
                
            }).fail(function() {
              console.log('失敗');
            }); 
        })
    });
</script>
@endsection