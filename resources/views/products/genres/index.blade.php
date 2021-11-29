@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/products">home</a>
    <div class="maker-home">
        <label class="label_title">
            ジャンル
        </label>
    </div>
    
    <div class="maker-container">
        <div class="maker-form">
        <form method="POST" action="/products/genres">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="name" value"{{old('name')}}" >
                <select name="maker_id" id="maker">
                @foreach($makers as $maker)
                
                    <option  value="{{$maker->id}}">{{$maker->name}}</option>
                @endforeach
                </select>
                <select name="category_id" id="category_select">
                @foreach($categories as $category)
                @if($category->maker_id == 1)
                    <option  value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                @endforeach
                </select>
                <button type="submit">Create</button>
                @error('name')
                    <div class="error">{{$message}}</div>
                @enderror
            </div>
        </form>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">メーカー</th>
                <th scope="col">カテゴリー</th>
                <th scope="col">ジャンル</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
                @foreach($genres as $genre)
                <tr>
                    <td>{{$genre->maker_name}}</td>
                    <td>{{$genre->category_name}}</td>
                    <td class="maker-name">{{ $genre->name }}</td>
                    <td>
                        <a href="/products/genres/{{$genre->id}}/edit">編集</a>
                    </td>
                    <td>
                        <form method="POST" action="/products/genres/{{$genre->id}}" onsubmit="return confirm('本気ですか？')">
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
    
        $('#maker').on('input', () => {
            let maker = $('#maker').val();
            console.log(maker);
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
                type: "get",
                url: "/products/genres/category/ajax",
                data: {'maker_id': maker},
                dataType: 'json',
            }).done(function(data){
                console.log(data)
               $('#category_select').children().remove();
               $.each(data['categories'], function (index, value) {
                html = `
                      <option value=${value.id}>${value.name}</option>
                 `;
                 $('#category_select').append(html);
               })
               
               
              
            }).fail(function() {
              console.log('失敗');
            }); 
                 
        });

    });
</script>
@endsection