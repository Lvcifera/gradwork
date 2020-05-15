<?php

namespace App\Http\Controllers;

use App\Person;
use App\Ticket;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /*
     * здесь выводим информацию
     * о текущем пользователе
     * (его ФИО и адрес проживания)
     */
    public function create() {

        $person = Person::with('user')
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        return view('person.create', compact('person'));

    }

    public function store(Request $request) {

        $person = new Person;

        $person->user_id = Auth::user()->id;
        $person->fio = $request->fio;
        $person->region = $request->region;
        $person->city = $request->city;
        $person->street = $request->street;
        $person->struct_number = $request->struct_number;
        $person->flat_number = $request->flat_number;

        $person->save();

        return redirect()->route('tickets.index')->with('success', 'Данные пользователя успешно сохранены');

    }

    public function edit($id) {

        $person = Person::find($id);
        return view('person.edit', compact('person'));

    }

    public function update(Request $request, $id) {

        $person = Person::find($id);
        $person->fio = $request->get('fio');
        $person->region = $request->get('region');
        $person->city = $request->get('city');
        $person->street = $request->get('street');
        $person->struct_number = $request->get('struct_number');
        $person->flat_number = $request->get('flat_number');

        $person->save();

        return redirect('/person/create')->with('success', 'Данные успешно обновлены!');

    }

    public function show($id) {

        /*
         * $id - это айди юзера, а не персоны
         */
        $person = User::with('person')
            ->find($id);
        if($person->person == null) {
            return redirect()->route('person.create')->with('success', 'Заполните данные о себе');
        }

        return view('person.show', compact('person'));

    }

    public function showMyTickets() {

        $myTickets = User::with('person.tickets')->find(Auth::user()->id);
        if($myTickets->person == null) {
            return redirect()->route('person.create')->with('success', 'Заполните данные о себе');
        }

        return view('person.showMyTickets', compact('myTickets'));

    }
}
