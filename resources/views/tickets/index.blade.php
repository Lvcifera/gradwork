@extends('layouts.layout')

@section('title')
    <title>Все тикеты</title>
@endsection

@section('content')
    <div class="row">
        <div class="card-columns">
            @foreach($tickets as $ticket)

                @if($ticket->person->region != $current_person->person->region)
                    <h5>Нет тикетов в вашем регионе</h5>
                    @break
                @elseif($ticket->person->city != $current_person->person->city)
                    <h5>Нет тикетов в вашем городе</h5>
                    @break
                @elseif($ticket->person->street != $current_person->person->street)
                    <h5>Нет тикетов на вашей улице</h5>
                    @break
                @else
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
                            Создано {{ $ticket->created_at }} <br>
                            @if($ticket->date_off != null)
                                Активно до {{ $ticket->date_off }}
                            @endif
                            @if($ticket->person->user->id == Auth::user()->id)
                                <span class="badge badge-info">Мой тикет</span>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
