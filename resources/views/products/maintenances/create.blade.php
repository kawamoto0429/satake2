@extends('layouts.app')

@section('content')
<a href="/products">home</a>
<div class="maker-home">
    <label>
        商品追加
    </label>
</div>
<div>
    <form method="POST" action="{{route('csv_store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="csv_input">
        <button>CSVで登録</button>
    </form>
</div>
<div>
    <form method="POST" action="{{ route('maintenance.store')}}">
        {{ csrf_field() }}
        <label>商品名</label>
        <input type="text" name="name" value"{{old('name')}}">
        @error('name')
            <div class="error">{{$message}}</div>
        @enderror
        <div>
            <label>１個の納価</label>
            <input type="text" name="price_1pc" value"{{old('price_1pc')}}">
            <label>円</label>
            @error('price_1pc')
            <div class="error">{{$message}}</div>
            @enderror
        </div>
        
        <div>
            <label>１０個の納価</label>
            <input type="text" name="price_10pcs" value"{{old("price_10pcs")}}">
            <label>円</label>
            @error('price_10pcs')
            <div class="error">{{$message}}</div>
            @enderror
        </div>
        <div>
            <label>３０個の納価</label>
            <input type="text" name="price_30pcs" value"{{old("price_30pcs")}}">
            <label>円</label>
            @error('price_30pcs')
            <div class="error">{{$message}}</div>
            @enderror
        </div>
        <div>
            <label>JANコード</label>
            <input type="text" name="jan" value"{{old("jan")}}">
            @error('jan')
            <div class="error">{{$message}}</div>
            @enderror
        </div>
        <div>
        <label>メーカー</label>
        <select name="maker_id" id="maker" value"{{old("maker_id")}}">
        @foreach($makers as $maker)
            <option  value="{{$maker->id}}">{{$maker->name}}</option>
        @endforeach
        </select>
        </div>
        <div>
        <label>カテゴリー</label>
        <select name="category_id" id="category"  value"{{old("category_id")}}">
        @foreach($categories as $category)
        @if($category->maker_id == 1)
            <option  value="{{$category->id}}">{{$category->name}}</option>
        @endif
        @endforeach
        </select>
        </div>
        <div>
        <label>ジャンル</label>
        <select name="genre_id" id="genres_select" value"{{old("genre_id")}}">
        @foreach($genres as $genre)
        @if($genre->maker_id == 1 && $genre->category_id == 1) //カテゴリーも絞られるように
            <option id="genre_option" value="{{$genre->id}}">{{$genre->name}}</option>
        @endif
        @endforeach
        </select>
        </div>
        <div>
            <label>入数</label>
            <input type="text" name="lot" value"{{old("lot")}}">
            <label>個</label>
            @error('lot')
            <div class="error">{{$message}}</div>
            @enderror
        </div>
        <button type="submit">Create</button>

    </form>
</div>
<script>
    $(function(){
    
        $('#maker').on('input', () => {
            let maker = $('#maker').val();
            console.log(maker);
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
                type: "get",
                url: "/products/maintenances/maker/ajax",
                data: {'maker_id': maker},
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
        
        $('#category').on('input', () => {
            let category = $('#category').val();
            console.log(category);
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
                type: "get",
                url: "/products/maintenances/category/ajax",
                data: {'category_id': category},
                dataType: 'json',
            }).done(function(data){
                console.log(data)
               $('#genres_select').children().remove();
               $.each(data, function (index, value) {
                html = `
                      <option value=${value.id}>${value.name}</option>
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