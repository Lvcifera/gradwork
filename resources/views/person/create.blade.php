@extends('layouts.layout')

@section('title')
    <title>Заполнить анкету</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h3 align="center" class="display-5">Редактировать профиль</h3>
            @if($person == null)
                <form action="{{ route('person.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
            @else
                <form action="{{ route('person.update', ['id' => $person->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
            @endif
                    <table class="table table-th-block">
                        <tbody>
                        <tr><td class="active">ФИО:</td><td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="fio" placeholder="Иванов Иван Иванович" @if($person != null) value="{{ $person->fio }} @endif">
                                </div>
                            </td></tr>
                        <tr><td class="active">Регион:</td><td>
                                <div class="form-group">
                                    <input type="text" name="region" class="form-control" placeholder="Московская область" @if($person != null) value="{{ $person->region }} @endif">
                                </div>
                            </td></tr>
                        <tr><td class="active">Город:</td><td>
                                <div class="form-group">
                                    <input type="text" name="city" class="form-control" placeholder="Москва" @if($person != null) value="{{ $person->city }} @endif">
                                </div>
                            </td></tr>
                        <tr><td class="active">Улица:</td><td>
                                <div class="form-group">
                                    <input type="text" name="street" class="form-control" placeholder="Ленина" @if($person != null) value="{{ $person->street }} @endif">
                                </div>
                            </td></tr>
                        <tr><td class="active">Номер дома:</td><td>
                                <div class="form-group">
                                    <input type="text" name="struct_number" class="form-control" placeholder="10" @if($person != null) value="{{ $person->struct_number }} @endif">
                                </div>
                            </td></tr>
                        <tr><td class="active">Номер квартиры:</td><td>
                                <div class="form-group">
                                    <input type="text" name="flat_number" class="form-control" placeholder="15" @if($person != null) value="{{ $person->flat_number }} @endif">
                                </div>
                            </td></tr>
                        </tr>
                        </tbody>
                    </table>
                <input type="submit" value="Сохранить" class="btn btn-outline-success">
            </form>
        </div>
    </div>
@endsection
