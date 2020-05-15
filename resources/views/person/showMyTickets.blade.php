@extends('layouts.layout')

@section('title')
    <title>Мои тикеты</title>
@endsection

@section('content')
    <div class="row">
        <div class="card-columns">
            @if(count($myTickets->person->tickets) == 0)
                <h4>Вы еще не создавали тикеты</h4>
                @else
                    @foreach($myTickets->person->tickets as $ticket)
                        @if($ticket->type == 'Объявление')
                            <div class="card border-primary mb-3" style="max-width: 20rem;">
                        @endif
                        @if($ticket->type == 'Голосование')
                            <div class="card border-info mb-3" style="max-width: 20rem;">
                        @endif
                            <div class="card-header">
                                {{ $ticket->type }}
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route('tickets.show', ['id' => $ticket->id]) }}" class="card-link">{{ $ticket->name }}</a>
                                </h4>
                                <p class="card-text">{{ $ticket->description }}</p>
                            </div>
                                <div class="card-footer text-muted">
                                    Создано {{ $ticket->created_at->format('d.m h:m') }} <br>
                                    @if($ticket->date_off != null)
                                        Активно до {{ $ticket->date_off->format('d.m h:m') }} <br>
                                    @endif
                                    Статус: @if($ticket->status == 'opened')
                                                открыт <br>
                                            @else
                                                закрыт <br>
                                            @endif
                                    Кол-во просмотров: {{ $ticket->view_count }} <br>
                                </div>
                            </div>
                    @endforeach
            @endif
        </div>
    </div>
@endsection
