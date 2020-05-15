@extends('layouts.layout')

@section('title')
    <title>Результаты поиска</title>
@endsection

@section('content')
    <div class="row">
        <h5>Результаты поиска</h5>
    </div>
    <div class="row">
        <div class="card-columns">
            @foreach($tickets as $ticket)
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
            @endforeach
        </div>
    </div>
@endsection
