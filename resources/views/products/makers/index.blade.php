@extends('layouts.app')

@section('content')
    <a href="/products">home</a>
<div class="maker-home">
    <label>
        メーカー
    </label>
</div>

<div class="maker-container">
    <div class="maker-form">
    <form method="POST" action="/products/makers">
        {{ csrf_field() }}
        <input type="text" name="name" value="{{old('name')}}">
        <button type="submit">Create</button>
        @error('name')
            <div class="error">{{$message}}</div>
        @enderror
    </form>
    </div>

    <table class="maker-table">
        <tbody>
            @foreach($makers as $maker)
            <tr>
                
                <td class="maker-name">{{ $maker->name }}</td>
                <td>
                    <a href="/products/makers/{{$maker->id}}/edit">編集</a>
                </td>
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
@endsection