
<nav class="uk-navbar-container uk-margin" uk-navbar="mode: click">
    <div class="uk-navbar-left">

        <a class="uk-navbar-item uk-logo" href="{{ url('home') }}">{{ config('app.name') }}</a>
        <!--a class="uk-navbar-toggle" href="#">
            <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">Меню</span>
        </a-->

        <ul class="uk-navbar-nav">
            <li>
                <a href="{{ url('news') }}">Новости</a>
            </li>
            <li>
                <a href="#">Рейтинги <i class="fa fa-caret-down uk-margin-small-left" aria-hidden="true"></i></a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">

                        <li><a href="{{ url('rating/gamers') }}">Персональный рейтинг</a></li>
                        <li><a href="{{ url('rating/teams') }}">Командный рейтинг</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#">Регистрация в Habb <i class="fa fa-caret-down uk-margin-small-left" aria-hidden="true"></i></a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">

                        <li><a href="{{ url('register/gamer') }}">Регистрация участника HABB</a></li>
                        <li><a href="{{ url('register/team') }}">Регистрации заявки на команду</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ url('about') }}">О портале</a>
            </li>
            <li>
                <a href="{{ url('contacts') }}">Контакты</a>
            </li>
        </ul>
        <!--div class="uk-navbar-item">
            <form action="javascript:void(0)">
                <input class="uk-input uk-form-width-small" type="text" placeholder="Input">
                <button class="uk-button uk-button-default">Button</button>
            </form>
        </div-->
    </div>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            @if(Auth::check())
                    <li>
                        <a href="#">{{ Auth::user()->name }}<span class="uk-icon uk-margin-small-left" uk-icon="icon: user"></span></a></a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                @if(Auth::user()->hasBackendRight())
                                    <li><a href="{{ url('admin') }}">Админка<span class="uk-icon uk-margin-small-left" uk-icon="icon: settings"></span></a></li>
                                @endif

                                <li><a href="{{ url('profile') }}">Профайл<span class="uk-icon uk-margin-small-left" uk-icon="icon: cog"></span></a></li>
                                <li><a href="{{ route('logout') }}">Выйти<span class="uk-icon uk-margin-small-left" uk-icon="icon: sign-out"></span></a></li>
                            </ul>
                        </div>
                    </li>
            @else
                <li><a href="{{ route('register') }}">Зарегистрироваться<span class="uk-icon uk-margin-small-left" uk-icon="icon: star"></span></a></li>
                <li><a href="{{ route('login') }}">Авторизоваться<span class="uk-icon uk-margin-small-left" uk-icon="icon: sign-in"></span></a></li>
            @endif
        </ul>
    </div>
</nav>