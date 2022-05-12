@extends('layouts.app')


@section('content')
<div class="container">
    @if(!$maker->imgpath == null)
    <div>
        <img class="yamazaki_log" src="{{ $maker->imgpath }}">
        {{-- <img class="yamazaki_log" src="https://satake.s3.ap-northeast-1.amazonaws.com/x6rt9zlznVZAX4fimCdOUjgIBAK5d3802HhnCAUR.png"> --}}
    </div>
    @else
    <h1>{{$maker->name}}</h1>
    @endif
    <div class="container-fluid mt-4">
    <div class="row">
    <div class="clearfix"></div>
    <div class="col sidebar">
        <ul class="navbar-nav " id="genre">
            <li class="nav-item" value=1><a href="#">1便</a></li>
            <li class="nav-item" value=2><a href="#">2便</a></li>
        @foreach($categories as $category)
            <li class="nav-item dropdown" value="{{$genre_id}}" id="genre_id">
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
         <div >
             <form method="POST" action="/orders/purchase/conclude">
                 {{ csrf_field() }}
                <div class="sticky_table_wrapper w-900px">
                <table class="st-tbl1 table text-center">
                    <thead>
                        <tr>
                            <th scope="col" class="w10px"></th>
                            <th scope="col" class="">商品名</th>
                            <th scope="col" class="w80px">入数</th>
                            <th scope="col" class="w150px">納品/１個</th>
                        </tr>
                    </thead>
                    <tbody  class="products-list">
                        @foreach($maintenances as $maintenance)
                        <tr class="check_tr">
                            <td scope="row"><input type="checkbox" name="conclude[]" class="c_input" value="{{$maintenance->id}}"></td>
                            <td><a href="{{route('home_show', $maintenance)}}">{{$maintenance->name}}</a></td>
                            <td>{{$maintenance->lot}}</td>
                            <td>{{$maintenance->price_1pc}}<label>円</label></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" id="maker_id" value="{{$maker->id}}">
            <input type="text" name="purchase_qty">個
            <input type="number" min="1" name="arrived_at"> 日後
            <button type="submit" class="button" disabled>確定</button>
            </form>

        </div>
    </div>
</div>
<script src="{{ asset('js/order.js') }}" defer></script>
@endsection