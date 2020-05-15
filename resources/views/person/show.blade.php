@extends('layouts.layout')

@section('title')
    <title>Обо мне</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3 align="center" class="display-5">Обо мне</h3>
            <div>
                <table class="table table-th-block">
                    <tbody>
                    <tr><td class="active">Зарегистрирован:</td><td>
                            {{ $person->created_at }}
                        </td></tr>
                    <tr><td class="active">ФИО:</td><td>
                            {{ $person->person->fio }}
                        </td></tr>
                    <tr><td class="active">Регион:</td><td>
                            {{ $person->person->region }}
                        </td></tr>
                    <tr><td class="active">Город:</td><td>
                            {{ $person->person->city }}
                        </td></tr>
                    <tr><td class="active">Улица:</td><td>
                            {{ $person->person->street }}
                        </td></tr>
                    <tr><td class="active">Номер дома:</td><td>
                            {{ $person->person->struct_number }}
                        </td></tr>
                    <tr><td class="active">Номер квартиры:</td><td>
                            {{ $person->person->flat_number }}
                        </td></tr>
                    </tr>
                    </tbody>
                </table>
                <a href="{{ route('person.create') }}" class="btn btn-outline-success">Редактировать</a>
            </div>
        </div>
    </div>
@endsection
