<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    @yield('title')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="https://img.icons8.com/dusk/64/000000/cursor.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('style/bootstrap.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('style/custom.min.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Ты решаешь!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">О проекте <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Как это работает</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">Тикеты <span class="caret"></span></a>
                    <div class="dropdown-menu" aria-labelledby="download">
                        <a class="dropdown-item" href="{{ route('tickets.index') }}">Все тикеты</a>
                        <a class="dropdown-item" href="{{ route('tickets.ad') }}">Объявления</a>
                        <a class="dropdown-item" href="{{ route('tickets.vote') }}">Голосования</a>
                    </div>
                </li>
                @if(Auth::check())
                    @if((Auth::user()->role) == 'head')
                        <li class="nav-item"><a class="nav-link" href="{{ route('tickets.create') }}">Добавить тикет</a>
                        </li>
                    @endif
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('person.show', ['id' => Auth::user()->id]) }}">
                                {{ __('Обо мне') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('person.create') }}">
                                {{ __('Редактировать профиль') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('person.showMyTickets') }}">
                                {{ __('Мои тикеты') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            <form action="{{ route('tickets.search') }}" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="search" type="text" placeholder="Искать что-нибудь...">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Найти</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 {{ $error }}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
        @endforeach
    @endif
</div>

<div class="container">
    @yield('content')
</div>

<!-- Footer -->
<footer class="page-footer font-small cyan darken-3 fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">

            </div>
        </div>
    </div>
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://vk.com/prettiestkid"> Вишневский А.Ю.</a>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
