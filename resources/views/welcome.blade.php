@extends('layouts.layout')

@section('title')
    <title>Главная</title>
@endsection

@section('content')
    <div class="jumbotron p-3 p-md-5 text-black rounded bg-white">
        <div class="col-md-12 px-0">
            <h1 class="display-4 font-italic">Только представь, что <b>ты сможешь решать,</b> как будет выглядеть
            твой район и даже твой дом</h1>
            <p class="lead my-3">Ты всегда хотел предложить сделать что-нибудь оригинальное со своим домом, но не мог этого сказать всем?
            Теперь у тебя есть такая возможность!</p>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <h2 class="card-text">Простота</h2>
                    <h3 class="mb-0">
                        <p class="text-black">Это легко!</p>
                    </h3>
                    <p class="card-text mb-auto">Просто сгенерируй идею и изложи ее в тикетах.
                    Расскажи о ней так, как ты видишь ее воплощение, поделись мыслями с соседями
                    и они обязательно поддержат тебя ^_^</p>
                </div>
                <img src="{{ asset('img/social.png') }}" height="192" width="192">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <h2 class="card-text">Удобство</h2>
                    <h3 class="mb-0">
                        <p class="text-black">Это удобно!</p>
                    </h3>
                    <p class="card-text mb-auto">Заходи на сайт с любого устройства и не только
                    создавай новые тикеты, но и участвуй в обсуждении текущих. Комментируй, помогай
                    доработать идею. Твое мнение важно для всех</p>
                </div>
                <img src="{{ asset('img/puzzle.png') }}" height="192" width="192">
            </div>
        </div>
    </div>
    </div>
@endsection
