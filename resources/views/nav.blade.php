<nav class="navbar navbar-expand navbar-dark aqua-gradient">

    <a class="navbar-brand" href="/"><i class="fas fa-running mr-2"></i>Run on</a>

    <ul class="navbar-nav ml-auto">

        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
            </li>
        @endguest

        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
            </li>
        @endguest

        @auth
            <li class="nav-item">
                <a class="nav-link font-weight-bold" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" href=""><i class="fas fa-tasks"></i>ToDo</a>
            </li>
        @endauth

        @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-primary text-center" aria-labelledby="navbarDropdownMenuLink">
                    <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
                        マイページ
                    </button>
                    <div class="dropdown-divider"></div>
                    <button form="logout-button" class="dropdown-item" type="submit">
                        ログアウト
                    </button>
                    <div class="dropdown-divider"></div>
                    <form class="form-inline my-2 my-lg-0 ml-2 justify-content-center" action="{{ route('users.search') }}" method="get">
                        <div class="form-group">
                            <input type="search" class="form-control mr-sm-2" name="query" placeholder="ユーザーを検索" aria-label="検索...">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </li>
            <form id="logout-button" method="POST" action="{{ route('logout') }}">
                @csrf
            </form>
        @endauth

    </ul>

</nav>
