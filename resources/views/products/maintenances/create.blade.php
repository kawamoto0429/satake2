@extends('layouts.app')

@section('content')
<a href="/products">home</a>
<div class="maker-home">
    <label>
        商品追加
    </label>
</div>
<div>
    <form method="POST" action="{{ route('maintenance.store')}}">
        {{ csrf_field() }}
        <label>商品名</label>
        <input type="text" name="name">
        <div>
        <div>
            <label>１個の納価</label>
            <input type="text" name="price_1pc">
            <label>円</label>
        </div>
        <div>
            <label>１０個の納価</label>
            <input type="text" name="price_10pcs">
            <label>円</label>
        </div>
        <div>
            <label>３０個の納価</label>
            <input type="text" name="price_30pcs">
            <label>円</label>
        </div>
        <div>
            <label>JANコード</label>
            <input type="text" name="jan">
        </div>
        <label>メーカー</label>
        <select name="maker_id" id="maker">
        @foreach($makers as $maker)
            <option  value="{{$maker->id}}">{{$maker->name}}</option>
        @endforeach
        </select>
        </div>
        <div>
        <label>カテゴリー</label>
        <select name="category_id">
        @foreach($categories as $category)
            <option  value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
        </select>
        </div>
        <div>
        <label>ジャンル</label>
        <select name="genre_id" id="genres_select">
        @foreach($genres as $genre)
            <option id="genre_option" value="{{$genre->id}}">{{$genre->name}}</option>
        @endforeach
        </select>
        </div>
        <div>
            <label>入数</label>
            <input type="text" name="lot">
            <label>個</label>
        </div>
        <button type="submit">Create</button>

    </form>
</div>
<script>
    $(function(){
    
        $('#maker').on('input', () => {
            let maker = $('#maker').val();
            <!--console.log(maker);-->
            $.ajax({
            <!--headers: {-->
            <!--    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
            <!--}, -->
                type: "get",
                url: "/products/maintenances/maker/ajax",
                data: {'maker_id': maker},
                dataType: 'json',
            }).done(function(data){
                console.log(data)
               $('#genres_select').children().remove();
               $.each(data, function (index, value) {
                html = `
                      <option>${value.name}</option>
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