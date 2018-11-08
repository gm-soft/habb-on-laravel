
<nav class="navbar navbar-expand-sm navbar-dark bg-dark bg-habb">
    <div class="container">
        <a class="navbar-brand" href="{{ url('home') }}">
            <img src="{{ asset('images/habb-white.png') }}" width="150px">
        </a>

        <button class="navbar-toggler navbar-toggler-right" type="button"
                data-toggle="collapse" data-target="#frontendNavbar"
                aria-controls="frontendNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="frontendNavbar">
            <ul class="navbar-nav mr-auto mt-1">

                <li class="nav-item">
                    <a class="nav-link" href="{{ action("HomeController@news") }}">Новости</a>
                </li>

                <!--li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="ratingsMenu"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Регистрации
                    </a>

                    <div class="dropdown-menu" aria-labelledby="ratingsMenu">

                        <a class="dropdown-item" href="{{ url('register/team') }}">Заявка на команду</a>

                        <a class="dropdown-item" href="{{ url('register/gamer') }}">Аккаунт игрока</a>
                    </div>
                </li-->

                <li class="nav-item">
                    <a class="nav-link" href="{{ action("HomeController@eventSchedule") }}">Расписание</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ action("HomeController@about") }}">О нас</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ action("HomeController@contacts") }}">Контакты</a>
                </li>

                @foreach($model->attached_tournaments_links as $tournamentLink)
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="{{ $tournamentLink->url }}">{{ $tournamentLink->title }}</a>
                    </li>
                @endforeach

            </ul>
            <!--form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form-->
            <ul class="navbar-nav float-sm-right">
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="privateMenu"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="privateMenu">
                            @if(Auth::user()->hasBackendRight())
                                <a class="dropdown-item" href="{{ url('admin') }}">Админка</a>
                            @endif

                            <a class="dropdown-item" href="{{ url('profile') }}">Профайл</a>

                            <a class="dropdown-item" href="{{ route('logout') }}">Выйти</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="https://vk.com/habb_kz" title="Наше сообщество Вконтакте"
                           data-toggle="tooltip" data-placement="bottom">
                            <i class="fa fa-vk fa-2x nav-icons" aria-hidden="true"></i>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="https://www.instagram.com/habb.kz/" title="Мы в инстаграме"
                           data-toggle="tooltip" data-placement="bottom">
                            <i class="fa fa-instagram fa-2x nav-icons" aria-hidden="true"></i>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="https://www.youtube.com/channel/UCyqFsI2CP2k29A1Uk14asxQ/featured"
                           title="Наш канал на youtube" data-toggle="tooltip" data-placement="bottom">
                            <i class="fa fa-youtube-play fa-2x nav-icons" aria-hidden="true"></i>
                        </a>

                    </li>

                    <!--li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Авторизация</a>
                    </li-->

                    <!--li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li-->
                @endif
            </ul>
        </div>
    </div>

</nav>
<div class="habb-div-bar"></div>