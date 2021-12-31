@extends('layouts.app')
<!--<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">-->
<!--        <div class="container">-->
            

<!--            <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
<!--                 Left Side Of Navbar -->
<!--                <ul class="navbar-nav mr-auto">-->

<!--                </ul>-->

<!--                 Right Side Of Navbar -->
<!--                <ul class="navbar-nav ml-auto">-->
<!--                     Authentication Links -->
<!--                    @guest-->
<!--                        @if (Route::has('login'))-->
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>-->
<!--                            </li>-->
<!--                        @endif-->

<!--                    @else-->
<!--                        <li class="nav-item dropdown">-->
<!--                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>-->
<!--                                {{ Auth::user()->name }}-->
<!--                            </a>-->

<!--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">-->
<!--                                <a class="dropdown-item" href="{{ route('logout') }}"-->
<!--                                   onclick="event.preventDefault();-->
<!--                                                 document.getElementById('logout-form').submit();">-->
<!--                                    {{ __('Logout') }}-->
<!--                                </a>-->

<!--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">-->
<!--                                    @csrf-->
<!--                                </form>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                    @endguest-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </nav>-->
    @auth

    @section('content')
    
    <div class="container">
        <div class="note">
            <a href="{{ route('note_home')}}">
            <p>ノート確認</p>
            </a>
        </div>
        <div class="orders">
            <a href="{{ route('orders')}}">
                <p>発注</p>
            </a>
        </div>
        <div class="products">
            <a href="{{ route('products')}}">
                <p>商品管理</p>
            </a>
        </div>
        <div class="pop">
            <a href="/pops">
                <p>POP印刷</p>
            </a>
        </div>
    </div>
    
    
    @endsection
    @endauth