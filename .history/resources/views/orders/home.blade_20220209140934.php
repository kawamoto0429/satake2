@extends('layouts.app')

@section('content')
<div class="container">

    @if(!$maker->imgpath == null)
    <div>
        <img class="yamazaki_log" src="{{ Storage::disk('s3')->url("satake/{$maker->imgpath}") }}">
        {{-- <img class="yamazaki_log" src="https://satake.s3.ap-northeast-1.amazonaws.com/x6rt9zlznVZAX4fimCdOUjgIBAK5d3802HhnCAUR.png"> --}}
    </div>
    @else
    <h1>{{$maker->name}}</h1>
    @endif
    <div class="container-fluid mt-4">
    <div class="row">
    <div class="clearfix"></div>
    <div class="col sidebar">
        <ul class="navbar-nav" id="category">
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
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main ">
        <h2 class="h1">今月の新商品</h2>
        <div class="w-100">
            @foreach ($maintenances as $maintenance)
            <div class="item ml-2 mb-4 text-center">
                @if($maintenance->imgpath == null)
                <a href="{{route('home_show', $maintenance)}}">
                    <div>
                        <img class="product mb-2" src="{{ asset('img/no_image.jpeg')}}">
                    </div>
                    <div class="mozi">
                        {{$maintenance->name}}
                    </div>
                </a>
                @else
                <a href="{{route('home_show', $maintenance)}}">
                    <div>
                        <img class="product mb-2" src="{{ asset('storage/'.$maintenance->imgpath)}}">
                    </div>
                    <div class="mozi">
                        {{$maintenance->name}}
                    </div>
                </a>
                @endif
            </div>
           @endforeach
        </div>
    </div>
    <div class="block mx-auto">
         {{ $maintenances->links() }}
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
                        <td scope="row"><input type="checkbox" name="conclude[]" value=${value.id}></td>
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
