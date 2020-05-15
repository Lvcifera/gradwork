@extends('layouts.layout')

@section('title')
    <title>Редактировать тикет</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3 align="center" class="display-5">Редактировать тикет</h3>
            <div>
                <form method="post" action="{{ route('tickets.update', $ticket->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="ticket_type">Тип тикета:</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="adRadio" name="ticket_type" class="custom-control-input" value="Объявление" @if($ticket->type == 'Объявление') checked="" @endif>
                            <label class="custom-control-label" for="adRadio">Объявление</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="voteRadio" name="ticket_type" class="custom-control-input" value="Голосование" @if($ticket->type == 'Голосование') checked="" @endif>
                            <label class="custom-control-label" for="voteRadio">Голосование</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ticket_name">Название:</label>
                        <input type="text" class="form-control" name="ticket_name" value="{{ $ticket->name }}">
                    </div>
                    <div class="form-group">
                        <label for="ticket_description">Описание:</label>
                        <textarea class="form-control" name="ticket_description" rows="3">{{ $ticket->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="date_off">Дата истечения:</label>
                        <input type="datetime-local" name="ticket_date_off" class="form-control" @if($ticket->date_off != null) value="{{ Carbon\Carbon::parse($ticket->date_off)->format('Y-m-d\TH:i') }}" @endif>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить тикет</button>
                </form>
            </div>
        </div>
    </div>
@endsection
