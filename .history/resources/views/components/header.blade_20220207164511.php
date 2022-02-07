
 <header>
    <div id="app" class="mb-3">
        <nav class="navbar navbar-expand-md navbar-light background-g shadow-sm ">
            <div class="container background-g ">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="satakeLog" src="{{ asset('img/satake2.gif')}}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Route::has('login'))
                                <div class="nav-item">
                                    <a class="btn btn-secondary" href="{{ route('login') }}">ログイン</a>
                                </div>
                            @endif
                        @else
                            <div class="dropdown">
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
                                     商品管理
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <li>
                                    <a class="dropdown-item" href="{{route('maintenance.index')}}">
                                    商品メンテナンス
                                    </a>
                                    </li>
                                        <li><a class="dropdown-item" href="/products/makers">メーカー</a></li>
                                        <li><a class="dropdown-item" href="/products/categories">カテゴリー</a></li>
                                        <li><a class="dropdown-item" href="/products/genres">ジャンル</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     ノート
                                </a>
                                <div class="dropdown-menu dropdown-menu-right calendar" aria-labelledby="dropdownMenuLink" id="datepicker">

                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     発注
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
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
    </div>
        script src="{{ asset('js/calendar.js') }}" defer></script>
</header>
