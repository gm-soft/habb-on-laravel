

<nav class="navbar navbar-dark bg-challonge">
    <div class="container-fluid">
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

        <a class="navbar-brand text-white" href="/">Habb</a>

        <div class="collapse navbar-collapse navbar-toggleable-sm" id="navbarSupportedContent">

            <ul class="nav navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('news') }}">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('about') }}">О портале</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('contacts') }}">Контакты</a>
                </li>

                @if(Auth::check())

                    @if(Auth::user()->hasBackendRight())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin') }}">Админка</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown  float-sm-right">
                        <a class="nav-link dropdown-toggle" href="#" id="profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profile">
                            <a class="dropdown-item" href="{{ url('profile') }}"><i class="fa fa-cog" aria-hidden="true"></i> Профайл</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Выйти</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item float-sm-right">
                        <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                    </li>
                    <li class="nav-item float-sm-right">
                        <a class="nav-link" href="{{ route('login') }}">Авторизоваться</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>