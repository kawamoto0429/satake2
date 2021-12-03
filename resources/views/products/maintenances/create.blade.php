@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/products">home</a>
    <div class="maker-home">
        <label>
            商品追加
        </label>
    </div>
    <div class="mb-5 mt-2">
        <form method="POST" action="{{route('csv_store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="csv_input">
            <button>CSVで登録</button>
        </form>
    </div>
    
    <div>
        <form method="POST" action="{{ route('maintenance.store')}}">
             {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-sm-2" >商品名</label>
                <div class="col-sm-8">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                    @error('name')
                        <div class="error">{{$message}}</div>
                    @enderror
                </div>
                
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >１個の納価</label>
                <div class="col-sm-8">
                    <input type="text" name="price_1pc" value="{{old('price_1pc')}}" class="form-control">
                </div>
                    <label class="col-sm-1" >円</label>
                    @error('price_1pc')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2" >１０個の納価</label>
                <div class="col-sm-8">
                    <input type="text" name="price_10pcs" value="{{old('price_10pcs')}}" class="form-control">
                </div>
                    <label class="col-sm-1" >円</label>
                    @error('price_10pcs')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >３０個の納価</label>
                <div class="col-sm-8">
                    <input type="text" name="price_30pcs" value="{{old('price_30pcs')}}" class="form-control">
                </div>
                    <label class="col-sm-1" >円</label>
                    @error('price_30pcs')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >JANコード</label>
                <div class="col-sm-8">
                    <input type="text" name="jan" value="{{old("jan")}}" class="form-control">
                </div>
                    @error('jan')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-2">メーカー</label>
                <div class="col-sm-8">
                    <select name="maker_id" id="maker" value="{{old("maker_id")}}" class="form-control">
                    @foreach($makers as $maker)
                        <option  value="{{$maker->id}}">{{$maker->name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">カテゴリー</label>
                <div class="col-sm-8">
                    <select name="category_id" id="category"  value="{{old("category_id")}}" class="form-control">
                    @foreach($categories as $category)
                    @if($category->maker_id == 1)
                        <option  value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">ジャンル</label>
                <div class="col-sm-8">
                    <select name="genre_id" id="genres_select" value="{{old("genre_id")}}" class="form-control">
                    @foreach($genres as $genre)
                    @if($genre->maker_id == 1 && $genre->category_id == 1) //カテゴリーも絞られるように
                        <option id="genre_option" value="{{$genre->id}}">{{$genre->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">入数</label>
                <div class="col-sm-8">
                    <input type="text" name="lot" value="{{old("lot")}}" class="form-control">
                </div>
                <label>個</label>
                    @error('lot')
                    <div class="error">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-2">2便可</label>
                <div class="col-sm-8">
                    <input type="checkbox" name="tomo" class="mr-2"><label>2便ですか？</label>
                </div>
            </div>
            <button type="submit">Create</button>
        
        </form>
    </div>
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