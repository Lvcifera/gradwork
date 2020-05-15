@extends('layouts.layout')

@section('title')
    <title>Добавить тикет</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3 align="center" class="display-5">Добавить тикет</h3>
            <div>
                <form method="post" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="ticket_type">Тип тикета:</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="adRadio" name="ticket_type" class="custom-control-input" value="Объявление" checked="">
                            <label class="custom-control-label" for="adRadio">Объявление</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="voteRadio" name="ticket_type" class="custom-control-input" value="Голосование">
                            <label class="custom-control-label" for="voteRadio">Голосование</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ticket_name">Название:</label>
                        <input type="text" class="form-control" name="ticket_name" {{ old('name') ??  $ticket->name ?? '' }}>
                    </div>
                    <div class="form-group">
                        <label for="ticket_description">Описание:</label>
                        <textarea class="form-control" name="ticket_description" rows="3" {{ old('description') ??  $ticket->description ?? '' }}></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date_off">Дата истечения:</label>
                        <input type="datetime-local" name="ticket_date_off" class="form-control">
                    </div>
					<div class="form-group">
                        <label for="ticket_description">Файлы:</label>
                        <input type="file" name="files[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить тикет</button>
                </form>
            </div>
        </div>
    </div>
@endsection
