@extends('layouts.app')

@section('content')
    <a href="/products">home</a>
<div class="maker-home">
    <label class="label_title">
        カテゴリー
    </label>
</div>

<div class="maker-container">
    <div class="maker-form">
    <form method="POST" action="/products/categories">
        {{ csrf_field() }}
        <input type="text" name="name" value"{{old('name')}}">
        <button type="submit">Create</button>
        @error('name')
            <div class="error">{{$message}}</div>
        @enderror
    </form>
    </div>

    <table class="maker-table">
        <tbody>
            @foreach($categories as $category)
            <tr>
                
                <td class="maker-name">{{ $category->name }}</td>
                <td>
                    <a href="/products/categories/{{$category->id}}/edit">編集</a>
                </td>
                <td>
                    <form method="POST" action="/products/categories/{{$category->id}}" onsubmit="return confirm('本気ですか？')">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" >delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    
</div>
@endsection