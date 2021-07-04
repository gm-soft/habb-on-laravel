<nav class="navbar navbar-expand-sm navbar-inverse navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler navbar-toggler-right" type="button"
                data-toggle="collapse" data-target="#backendNavbar"
                aria-controls="backendNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{url('admin')}}">
            Habb Админка
        </a>

        <div class="collapse navbar-collapse" id="backendNavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="front" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Фронт</a>
                    <div class="dropdown-menu" aria-labelledby="front">
                        <a class="dropdown-item" href="{{ url('/') }}">Главная</a>
                        <a class="dropdown-item" href="{{ url('news') }}">Новости</a>
                        <a class="dropdown-item" href="{{ url('about') }}">О портале</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accounts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Новости</a>
                    <div class="dropdown-menu" aria-labelledby="accounts">
                        <a class="dropdown-item" href="{{ action('PostController@create') }}">Создать новость</a>
                        <a class="dropdown-item" href="{{ url('admin/posts/') }}">Список новостей</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accounts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Объекты</a>
                    <div class="dropdown-menu" aria-labelledby="accounts">

                        <a class="dropdown-item" href="{{ url('admin/gamers/') }}">Аккаунты игроков</a>
                        <a class="dropdown-item" href="{{ url('admin/teams/') }}">Команды</a>
                        <a class="dropdown-item" href="{{ url('admin/tournaments/') }}">Турниры</a>
                        <a class="dropdown-item" href="{{ url('admin/banners/') }}">Баннеры</a>
                        <a class="dropdown-item" href="{{ action('StaticPageController@index') }}">Статичные страницы</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('admin/external_services/') }}">Внешние сервисы</a>
                        <a class="dropdown-item" href="{{ url('admin/users/') }}">Модераторы</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="files" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Загрузка файлов</a>
                    <div class="dropdown-menu" aria-labelledby="files">

                        <a class="dropdown-item" href="{{ action('UploadController@page') }}">Загрузить файл</a>
                        <a class="dropdown-item" href="{{ action('UploadController@index') }}">Все файлы</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Настройка</a>
                    <div class="dropdown-menu" aria-labelledby="settings">

                        <a class="dropdown-item" href="{{ action('BackupController@index') }}">Бэкапы <span class="badge badge-warning">beta</span></a>
                        <a class="dropdown-item" href="{{ url('admin/keyValues/') }}">Ключ-Значение</a>
                        <a class="dropdown-item" href="{{ url('phpmyadmin') }}"><i class="fa fa-database" aria-hidden="true"></i> PhpMyAdmin</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav float-md-right">
                <li class="nav-item dropdown  float-md-right">
                    <a class="nav-link dropdown-toggle" href="#" id="profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profile">
                        <a class="dropdown-item" href="{{ url('profile') }}"><i class="fa fa-cog" aria-hidden="true"></i> Профайл</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Выйти</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</nav>