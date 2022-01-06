@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/products/maintenances">商品一覧</a>
    <div class="maker-home">
        <label>
            商品編集
        </label>
    </div>
    <div>
        
        <form method="POST" action="{{ route('maintenance.update', $maintenance)}}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
             {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-sm-2" >商品名</label>
                <div class="col-sm-8">
                    <input type="text" name="name" value={{ $maintenance->name }} class="form-control">
                    @error('name')
                        <div class="error">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >１個の納価</label>
                <div class="col-sm-8">
                    <input type="text" name="price_1pc" value="{{$maintenance->price_1pc}}" class="form-control">
                    @error('price_1pc')
                    <div class="error">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    円
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2" >１０個の納価</label>
                <div class="col-sm-8">
                    <input type="text" name="price_10pcs" value={{$maintenance->price_10pcs}} class="form-control">
                    @error('price_10pcs')
                    <div class="error">{{$message}}</div>
                    @enderror
                </div>    
                <div>
                    円
                </div>    
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >３０個の納価</label>
                <div class="col-sm-8">
                    <input type="text" name="price_30pcs" value={{$maintenance->price_30pcs}} class="form-control">
                    @error('price_30pcs')
                    <div class="error">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    円
                </div>    
            </div>
            <div class="form-group row">
                <label class="col-sm-2" >JANコード</label>
                <div class="col-sm-8">
                    <input type="text" name="jan" value={{$maintenance->jan}} class="form-control">
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
                    @if($maker->id == $maintenance->maker_id)
                        <option value="{{$maker->id}}" selected>{{$maker->name}}</option>
                    @else
                        <option  value="{{$maker->id}}">{{$maker->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">カテゴリー</label>
                <div class="col-sm-8">
                    <select name="category_id" id="category"  value="{{old("category_id")}}" class="form-control">
                    @foreach($categories as $category)
                    @if($category->id == $maintenance->category_id)
                        <option  value="{{$category->id}}" selected>{{$category->name}}</option>
                    @elseif($category->maker_id == $maintenance->maker_id)
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
                    @if($genre->id == $maintenance->genre_id)
                        <option  value="{{$genre->id}}" selected>{{$genre->name}}</option>
                    @elseif($genre->maker_id == $maintenance->maker_id && $genre->category_id == $maintenance->category_id)
                        <option  value="{{$genre->id}}">{{$genre->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">入数</label>
                <div class="col-sm-8">
                    <input type="text" name="lot" value="{{$maintenance->lot}}" class="form-control">
                
               
                    @error('lot')
                    <div class="error">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    個
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">2便可</label>
                <div class="col-sm-8">
                    @if($maintenance->tomorrow_flg == 1)
                        <input type="checkbox" name="tomorrow_flg" class="mr-2" checked><label>2便ですか？</label>
                    @else
                        <input type="checkbox" name="tomorrow_flg" class="mr-2"><label>2便ですか？</label>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">表示しない</label>
                <div class="col-sm-8">
                    @if($maintenance->nodisplay_flg == 1)
                        <input type="checkbox" name="nodisplay_flg" class="mr-2" checked><label>表示しないですか？</label>
                    @else
                        <input type="checkbox" name="nodisplay_flg" class="mr-2"><label>表示しないですか？</label>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">新商品</label>
                <div class="col-sm-8">
                    @if($maintenance->new_flg == 1)
                        <input type="checkbox" name="new_flg" class="mr-2" checked><label>新商品</label>
                    @else
                        <input type="checkbox" name="new_flg" class="mr-2"><label>新商品</label>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">画像アップロード</label>
                <div class="col-sm-8">
                    <input type="file" name="imgpath">
                </div>
            </div>
            <button type="submit">編集</button>
        
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