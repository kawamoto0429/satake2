@extends('layouts.app')

@section('content')
<div class="container">
    <div class="maker-home">
        <label>
            商品一覧
        </label>
    </div>
    <div>
        <a href="{{route('maintenance.create')}}" class="mr-4">商品追加</a>
        @foreach($makers as $maker)
            <a href="/products/maintenances/maker/{{$maker->id}}" class="mr-2">{{$maker->name}}</a>
        @endforeach
    </div>
    <div class="mb-2">
        <form>
            <div class="col-xs-2">
                <label>検索</label>
                <input type="text" id="search" class="form-control w20"  placeholder="キーワードを入力してくだい">
            </div>
        </form>
    </div>
    <div>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th scope="col" class="w100px">#</th>
                <th scope="col" class="w150px">メーカー</th>
                <th scope="col">商品名</th>
                <th scope="col" class="w100px">納価/1個</th>
                <th scope="col" class="w80px"></th>
                <th scope="col" class="w80px"></th>
                <th scope="col" class="w80px"></th>
            </tr>
            </thead>
            <tbody class="products-list">
            @foreach($maintenances as $maintenance)
            <tr>
                <th scope="row">{{$maintenance->id}}</th>
                <td>{{$maintenance->maker_name}}</td>
                <td>{{$maintenance->name}}</td>
                <td>{{$maintenance->price_1pc}}円</td>
                <td ><a href="{{ route('maintenance.show', $maintenance)}}">詳細</a></td>
                <td ><a href="{{ route('maintenance.edit', $maintenance)}}">編集</a></td>
                <td>
                    <form method="POST" action="{{route('maintenance.delete', $maintenance)}}" onsubmit="return confirm('本気ですか？')">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
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
                url: "/maintenances/search/ajax",
                data: {
                        'keywords' : keywords,
                      },
                dataType: 'json',
            }).done(function(data){
                console.log(data);
                $('.products-list').children().remove();
                $.each(data, function (index, value) {
                console.log(value)
                 html = `
                    <tr>
                        <th scope="row">${value.id}</th>
                        <td>${value.maker_name}</td>
                        <td>${value.name}</td>
                        <td>${value.price_1pc}円</td>
                        <td><a href="/products/maintenances/${value.id}/show">詳細</a></td>
                        <td><a href="/products/maintenances/${value.id}/edit">編集</a></td>
                        <td>
                            <form method="POST" action="/products/maintenances/${value.id}/delete" onsubmit="return confirm('本気ですか？')">
                                @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit">delete</button>
                            </form>
                        </td>
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