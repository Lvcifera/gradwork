@extends('layouts.layout')

@section('title')
    <title>{{ $ticket->name }}</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="jumbotron">
                <h1 class="display-6">{{ $ticket->name }}</h1><hr>
                <p class="lead">{{ $ticket->description }}</p>
                @if($ticket->files->count() > 0)
                    <hr class="my-4">
                    <h1 class="display-6">Файлы</h1>
                    <p class="lead">
                        @foreach($ticket->files as $file)
                            <a href="{{ $file->file }}">{{ $file->file }}</a><br>
                        @endforeach
                    </p>
                @endif
                <hr class="my-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Разместил: {{ $ticket->person->fio }}</li>
                    <li class="list-group-item">Дата размещения: {{ $ticket->created_at }}</li>
                    @if($ticket->date_off != null)
                        <li class="list-group-item">Дата истечения: {{ $ticket->date_off }}</li>
                    @endif
                    @if($ticket->person->region != null)
                        <li class="list-group-item">Регион: {{ $ticket->person->region }}</li>
                    @endif
                    @if($ticket->person->city != null)
                        <li class="list-group-item">Город: {{ $ticket->person->city }}</li>
                    @endif
                    @if($ticket->person->street != null)
                    <li class="list-group-item">Адрес: улица {{ $ticket->person->street }}
                                                @if($ticket->person->struct_number != null)
                                                    , дом {{ $ticket->person->struct_number }}
                                                @endif</li>
                    @endif
                </ul>
                @if($ticket->person->user->id == Auth::user()->id)
                    <br><a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-outline-success">Редактировать</a>
                    @if($ticket->status == 'opened')
                        <a href="{{ route('tickets.close', ['id' => $ticket->id]) }}" class="btn btn-outline-secondary">Закрыть тикет</a>
                    @else
                        <a href="{{ route('tickets.open', ['id' => $ticket->id]) }}" class="btn btn-outline-secondary">Открыть тикет</a>
                    @endif
                    <a href="{{ route('tickets.delete', ['id' => $ticket->id]) }}" class="btn btn-outline-danger">Удалить</a>
                @endif

                @if($ticket->type == 'Голосование')
                    <hr class="my-4">
                    @if($ticket->status == 'opened')
                        <h5>Голосование</h5>
                        @if($vote->count() > 0)
                            <h6>Вы уже голосовали в этом тикете. Результаты общего голосования будут доступны после закрытия тикета</h6>
                        @endif
                        @if($vote->count() == 0)
                            <form method="post" action="{{ route('result_ticket.store') }}">
                                @csrf
                                @method('PATCH')
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="yesRadio" name="vote_result" class="custom-control-input" value="yes">
                                    <label class="custom-control-label" for="yesRadio">Согласен</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="noRadio" name="vote_result" class="custom-control-input" value="no">
                                    <label class="custom-control-label" for="noRadio">Не согласен</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="otherRadio" name="vote_result" class="custom-control-input" value="other">
                                    <label class="custom-control-label" for="otherRadio">Другой вариант (в комментариях)</label>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                </div>
                                <button type="submit" class="btn btn-outline-info">Голосовать</button>
                            </form>
                        @endif

                    @else
                        <h5>Результаты голосования</h5>
                        Всего голосов:  {{ $ticket->result_ticket->count() }}<br>
                        Поддержали:  {{ $ticket->result_ticket->where('yes', 1)->count() }}<br>
                        Высказались против:  {{ $ticket->result_ticket->where('no', 1)->count() }}<br>
                        Иной вариант:  {{ $ticket->result_ticket->where('other', 1)->count() }}<br>
                    @endif
                @endif

                <hr class="my-4">
                @if($ticket->status != 'closed')
                    @if($ticket->comments->count() == 0)
                        <h5>К этому тикету еще нет комментариев</h5>
                    @endif
                    @if($ticket->comments->count() > 0)
                            <h5>Комментарии</h5>
                            <ul class="list-group list-group-flush">
                        @foreach($ticket->comments as $comment)
                                <li class="list-group-item">
                                    Автор: {{ $comment->person->fio }},
                                    дата {{ $comment->created_at }}
                                    <p>{{ $comment->text }}</p>
                                    @if($comment->person->user->id == Auth::user()->id)
                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="card-outline-danger">
                                            <span class="badge badge-pill badge-danger">Удалить комментарий</span>
                                        </a>
                                    @endif
                                </li>
                        @endforeach
                            </ul><br>
                    @endif
                        <form method="post" action="{{ route('comment.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="ticket_description">Текст комментария:</label>
                                <textarea class="form-control" name="comment_text" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Добавить комментарий</button>
                        </form>
                @else
                    <h5>Тикет закрыт, оставлять комментарии больше нельзя</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
