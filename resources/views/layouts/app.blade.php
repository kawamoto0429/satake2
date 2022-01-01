<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--<link href="{{ secure_asset('css/satake.css')}}" rel="stylesheet">-->
    <link href="{{ secure_asset('css/bootstrap.css')}}" rel="stylesheet">
    <!--<link href="{{ secure_asset('css/note.css')}}" rel="stylesheet">-->
    <!--<link href="{{ secure_asset('css/products/product.css')}}" rel="stylesheet">-->
    <!--<link href="{{ secure_asset('css/products/maintenance.css')}}" rel="stylesheet">-->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light background-g shadow-sm ">
            <div class="container background-g ">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="satakeLog" src="{{ secure_asset('img/satake2.gif')}}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Route::has('login'))
                                <div class="nav-item">
                                    <a class="btn btn-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </div>
                            @endif
                        @else
                            <div class="dropdown ">
                                <a id="navbarDropdown" class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     ノート
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li>
                                    <a class="dropdown-item" href="{{ route('note_home')}}">
                                    ノート確認
                                    </a>
                                    </li>
                                        <li><a class="dropdown-item" href="/notes/home/{{$date->month}}/{{$date->day-1}}">昨日の納品</a></li>
                                        <li><a class="dropdown-item" href="/notes/home/{{$date->month}}/{{$date->day}}">今日の納品</a></li>
                                        <li><a class="dropdown-item" href="/notes/home/{{$date->month}}/{{$date->day+1}}">明日の納品</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     発注
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @foreach($makers as $maker)
                                    <li><a class="dropdown-item" href="/orders/{{$maker->id}}/home">{{$maker->name}}</a></li>
                                    @endforeach
                                    <li><a class="dropdown-item" href="{{route('orders_purchase')}}">今日の発注</a></li>
                                </ul>
                            </div>
                        @endguest
                    </ul>
                </div>
                
                    
                
            </div>
        </nav>
        
        <main class="py-4">
            
            @yield('content')
            
        </main>
    </div>
</body>
</html>
