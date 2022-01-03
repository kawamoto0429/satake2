@extends('layouts.app')


@section('content')
<div class="container">
    
    
    <h1>{{$maker->name}}</h1>
    <div class="container-fluid mt-4">
    <div class="row">
    <div class="clearfix"></div>
    <div class="col sidebar">
        <ul class="navbar-nav " id="category">
        @foreach($categories as $category)
            <li class="nav-item dropdown">
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
        <div>
            
            <form method="POST" action="/orders/purchase/conclude">
                 {{ csrf_field() }}
                <div class="sticky_table_wrapper w-900px">
                    <table class="st-tbl1 table text-center">
                        <thead>
                            <tr>
                                <th scope="col" class="w10px"></th>
                                <th scope="col" class="">商品名</th>
                                <th scope="col" class="w150px">納品/１個</th>
                            </tr>
                        </thead>
                        <tbody class="products-list">
                            @foreach($maintenances as $maintenance)
                            <tr>
                                <td scope="row"><input type="checkbox" name="conclude[]" class="check" value="{{$maintenance->id}}"></td>
                                <td><a href="{{route('home_show', $maintenance)}}">{{$maintenance->name}}</a></td>
                                <td>{{$maintenance->price_1pc}}<label>円</label></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div> 
            <input type="text" name="purchase_qty">個
            <input type="number" min="1" name="arrived_at"> 日後
            <button type="submit" class="button" disabled>確定</button>
            </form>
           
        
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
                        <td scope="row"><input type="checkbox" name="conclude[]" class="check" value=${value.id}></td>
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
        
        
        
        <!--$('#category li').click(function(){-->
        <!--    alert("aa");-->
        <!--    $(this)..slideToggle();-->
        <!--    return false;-->
        <!--});-->
        
        $('.check').change(function() {
            if($(".check").is(':checked')){
                $('.button').prop('disabled', false);
            }else{
                $('.button').prop('disabled', true); 
            }
        })
    });
</script>
@endsection