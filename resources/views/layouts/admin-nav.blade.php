<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('admin/')}}">
            Habb Админка
        </a>

        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-toggleable-md" id="navbarResponsive">

            <ul class="nav navbar-nav">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="front" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Фронт</a>
                    <div class="dropdown-menu" aria-labelledby="front">
                        <a class="dropdown-item" href="{{ url('/') }}">Главная</a>
                        <a class="dropdown-item" href="{{ url('news') }}">Новости</a>
                        <a class="dropdown-item" href="{{ url('about') }}">О портале</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accounts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Объекты</a>
                    <div class="dropdown-menu" aria-labelledby="accounts">

                        <a class="dropdown-item" href="{{ url('admin/gamers/') }}">Аккаунты</a>
                        <a class="dropdown-item" href="{{ url('admin/teams/') }}">Команды</a>
                        <a class="dropdown-item" href="{{ url('admin/tournaments/') }}">Турниры</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('admin/posts/') }}">Посты</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('admin/users/') }}">Пользователи</a>
                        <a class="dropdown-item" href="{{ url('admin/statistic/') }}">Записи статистики</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="requests" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Запросы</a>
                    <div class="dropdown-menu" aria-labelledby="requests">
                        <a class="dropdown-item" href="{{ url('admin/requests/teamCreate/') }}">На создание команды</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Настройка</a>
                    <div class="dropdown-menu" aria-labelledby="settings">
                        <a class="dropdown-item" href="{{ url('admin/server/') }}"><i class="fa fa-server" aria-hidden="true"></i> Сервер авторизации</a>
                        <a class="dropdown-item" href="{{ url('phpmyadmin') }}"><i class="fa fa-database" aria-hidden="true"></i> PhpMyAdmin</a>
                    </div>
                </li>

                @if(Auth::check())
                    <li class="nav-item dropdown  float-sm-right">
                        <a class="nav-link dropdown-toggle" href="#" id="profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}
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