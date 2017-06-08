
<nav class="uk-navbar-container " uk-navbar="mode: click">
    <div class="uk-navbar-left">
        <a class="uk-navbar-toggle" uk-toggle="target: #slideNavigation">
            <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">Меню</span>
        </a>
        <a class="uk-navbar-item uk-logo" href="{{ url('home') }}">{{ config('app.name') }}</a>

        <ul class="uk-navbar-nav">
            <li>
                <a href="{{ url('news') }}">Новости</a>
            </li>
            <li  class="uk-parent">
                <a href="#">Рейтинги <i class="fa fa-caret-down uk-margin-small-left" aria-hidden="true"></i></a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">

                        <li>
                            <a href="{{ url('rating/gamers') }}">
                                <span class="uk-icon uk-margin-small-right" uk-icon="icon: user"></span>
                                Персональный рейтинг
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('rating/teams') }}">
                                <span class="uk-icon uk-margin-small-right" uk-icon="icon: users"></span>
                                Командный рейтинг
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!--div class="uk-navbar-item">
            <form action="javascript:void(0)">
                <input class="uk-input uk-form-width-small" type="text" placeholder="Input">
                <button class="uk-button uk-button-default">Button</button>
            </form>
        </div-->
    </div>
    <div class="uk-navbar-right uk-visible@m">
        <ul class="uk-navbar-nav">
            @if(Auth::check())
                    <li>
                        <a href="#">{{ Auth::user()->name }} <span class="uk-icon uk-margin-small-left" uk-icon="icon: triangle-down"></span></a></a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                @if(Auth::user()->hasBackendRight())
                                    <li>
                                        <a href="{{ url('admin') }}"><span class="uk-icon uk-margin-small-right" uk-icon="icon: settings"></span> Админка</a>
                                    </li>
                                @endif

                                <li>
                                    <a href="{{ url('profile') }}"><span class="uk-icon uk-margin-small-right" uk-icon="icon: cog"></span> Профайл</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"><span class="uk-icon uk-margin-small-right" uk-icon="icon: sign-out"></span> Выйти</a>
                                </li>
                            </ul>
                        </div>
                    </li>
            @else
                <li>
                    <a href="{{ url('register/gamer') }}">
                        <span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
                        Регистрация
                    </a>
                </li>
                <!--li><a href="{{ route('register') }}">Зарегистрироваться <span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span></a></li-->
                <li><a href="{{ route('login') }}">Авторизоваться <span class="uk-icon uk-margin-small-right" uk-icon="icon: sign-in"></span></a></li>
            @endif
        </ul>
    </div>
</nav>


<div id="slideNavigation" uk-offcanvas="mode: push; overlay: true">
    <div class="uk-offcanvas-bar">
        <h3>
            <a href="{{ url('home') }}">{{ config('app.name') }}</a>
        </h3>

        <ul class="uk-nav uk-nav-default">
            <li>
                <a href="{{ url('news') }}">Новости</a>
            </li>

            <li class="uk-parent">
                <a href="#">Рейтинги <i class="fa fa-caret-down uk-margin-small-left" aria-hidden="true"></i></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="{{ url('rating/gamers') }}">
                            <span class="uk-icon uk-margin-small-right" uk-icon="icon: user"></span>
                            Персональный рейтинг
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('rating/teams') }}">
                            <span class="uk-icon uk-margin-small-right" uk-icon="icon: users"></span>
                            Командный рейтинг
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#">Формы регистрации <i class="fa fa-caret-down uk-margin-small-left" aria-hidden="true"></i></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="{{ url('register/gamer') }}">
                            <span class="uk-icon uk-margin-small-right" uk-icon="icon: user"></span>
                            Регистрация геймера
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('register/team') }}">
                            <span class="uk-icon uk-margin-small-right" uk-icon="icon: users"></span>
                            Регистрации заявки на команду
                        </a>
                    </li>
                </ul>
            </li>

            <li><a href="{{ url('about') }}">О портале</a></li>
            <li><a href="{{ url('contacts') }}">Контакты</a></li>

            @if(Auth::check())
                <li class="uk-parent">
                    <a href="#">{{ Auth::user()->name }} <span class="uk-icon uk-margin-small-left" uk-icon="icon: triangle-down"></span></a>
                    <ul class="uk-nav-sub">
                        @if(Auth::user()->hasBackendRight())
                            <li>
                                <a href="{{ url('admin') }}"><span class="uk-icon uk-margin-small-right" uk-icon="icon: settings"></span> Админка</a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ url('profile') }}"><span class="uk-icon uk-margin-small-right" uk-icon="icon: cog"></span> Профайл</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"><span class="uk-icon uk-margin-small-right" uk-icon="icon: sign-out"></span> Выйти</a>
                        </li>
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{ route('register') }}">
                        Зарегистрироваться
                        <span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('login') }}">
                        Авторизоваться
                        <span class="uk-icon uk-margin-small-right" uk-icon="icon: sign-in"></span>
                    </a>
                </li>
            @endif
        </ul>

        <button class="uk-button uk-button-default uk-offcanvas-close uk-width-1-1 uk-margin" type="button">Закрыть</button>

    </div>
</div>