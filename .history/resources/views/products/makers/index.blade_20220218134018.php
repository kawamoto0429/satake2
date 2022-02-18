@extends('layouts.app')

@section('content')
<div class="container">
    <div class="maker-home">
        <label class="label_title">
            メーカー
        </label>
    </div>

    <div class="maker-container">
        <div class="maker-form">
        <form method="POST" action="/products/makers" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-sm-8 input-group mb-3">
                <input type="text" name="name" value="{{old('name')}}" maxlength="10" class="10" >
                <input type="file" name="imgpath">
                <button type="submit">Create</button>
            </div>
                @error('name')
                    <div class="error">{{$message}}</div>
                @enderror


        </form>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col" class="w100px">#</th>
                    <th scope="col">メーカー</th>
                    <th scope="col">画像フォルダー</th>
                    <th scope="col" class="w80px"></th>
                    <th scope="col" class="w80px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($makers as $maker)
                <tr>
                    <form method="POST" action="/products/makers/{{$maker->id}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <th scope="row">{{$maker->id}}</th>
                    <td class="maker-name"><input type="text" name="name" value="{{$maker->name}}" maxlength="10"></td>
                    <td><input type="file" name="imgpath" value="{{$maker->imgpath}}"></td>
                    <td>
                        <button type="submit">編集</button>
                    </td>
                    </form>
                    <td>
                        <form method="POST" action="/products/makers/{{$maker->id}}" onsubmit="return confirm('本気ですか？')">
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
@endsection
<script>
    $(function(){
    $(".10").on('keyup', function(){
        var txt = $(this).val();
        if ( 10 <txt.length ) {
        $(this).val(txt.substr(0,10));
        }
    });
    }
</script>
