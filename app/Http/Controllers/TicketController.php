<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketsRequest;
use App\ResultTicket;
use App\Ticket;
use App\User;
use App\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index() {
        /*
         * здесь сравниваем дату, после которой
         * тикет считается закрытым
         */
        $current_date = Carbon::today(); // текущая дата
        $current_person = User::with('person')->find(Auth::user()->id);
        $tickets = Ticket::with('person.user')
            ->where('status', '=', 'opened')
            //->where('date_off', '>', $current_date)
            ->orderBy('created_at', 'desc')
            ->get();

        if($current_person->person == null) {
            return redirect()->route('person.create')->with('success', 'Заполните данные о себе');
        }

        return view('tickets.index', compact(['tickets', 'current_person']));
    }
    public function vote() {

        $tickets = Ticket::with('person.user')
            ->where('type', '=', 'Голосование')->get();

        return view('tickets.vote', compact('tickets'));
    }
    public function ad() {

        $tickets = Ticket::with('person.user')
            ->where('type', '=', 'Объявление')->get();

        return view('tickets.ad', compact('tickets'));
    }

    public function create() {

        $person = User::with('person')
            ->find(Auth::user()->id);
        if($person->person == null) {
            return redirect()->route('person.create')->with('success', 'Заполните как минимум ФИО и регион');
        } else {
            return view('tickets.create');
        }

    }

    public function store(TicketsRequest $request) {

        $person = User::with('person.tickets')
            ->find(Auth::user()->id);
        $ticket = new Ticket();
        $ticket->person_id = $person->person->id;
        $ticket->type = $request->ticket_type;
        $ticket->name = $request->ticket_name;
        $ticket->description = $request->ticket_description;
        $ticket->date_off = $request->ticket_date_off;

        $ticket->save();

		if($request->hasFile('files')) {
			foreach ($request->file('files') as $f) {
				$filename = time().'_'.$f->getClientOriginalname();
				$f->move(public_path() . '/upload/',$filename);
				$file = File::create([
					'ticket_id' => $ticket->id,
					'file' => '/upload/'.$filename,
				]);
			}
		}

        /*if($request->ticket_type == 'Голосование') {
            $result_ticket = ResultTicket::create(['ticket_id' => $ticket->id,
                                                    'person_id' => $person->person->id,
                                                    'total' => 0,
                                                    'yes' => 0,
                                                    'no' => 0,
                                                    'other' => 0]);
        }*/

        return redirect()->route('tickets.index')->with('success', 'Тикет успешно добавлен');

    }

    public function show($id) {

        $ticket = Ticket::with(['comments', 'person', 'result_ticket', 'person.user'])
            ->find($id);
        $current_person = User::with('person', 'person.result_ticket')->find(Auth::user()->id);
        $result_ticket = $ticket->result_ticket->where('person_id', $current_person->id);
        $vote = $result_ticket->where('person_id', $current_person->id);

        event('ticketHasViewed', $ticket);

        return view('tickets.show', compact(['ticket', 'current_person', 'result_ticket', 'vote']));

    }

    public function destroy($id) {

        $ticket = Ticket::find($id);
        $ticket->delete();

        return redirect('/person/mytickets')->with('success', 'Тикет успешно удален');
    }

    public function edit($id) {

        $ticket = Ticket::find($id);

        return view('tickets.edit', compact('ticket'));
    }

    public function update(TicketsRequest $request, $id) {

        $ticket = Ticket::find($id);
        $ticket->type = $request->ticket_type;
        $ticket->name = $request->ticket_name;
        $ticket->description = $request->ticket_description;
        $ticket->date_off = $request->ticket_date_off;

        $ticket->save();
        return redirect()->route('tickets.index')->with('success', 'Тикет успешно отредактирован');

    }

    public function close($id) {

        $ticket = Ticket::find($id);
        $ticket->status = 'closed';

        $ticket->save();

        return redirect()->back()->with('success', 'Тикет успешно закрыт');

    }

    public function open($id) {

        $ticket = Ticket::find($id);
        $ticket->status = 'opened';

        $ticket->save();

        return redirect()->back()->with('success', 'Тикет успешно открыт');

    }

    public function search(Request $request) {

        $tickets = Ticket::where('description', $request->search)
            ->orWhere('type', $request->search)
            ->orWhere('name', $request->search)
            ->get();

        return view('tickets.search', compact('tickets'));

    }
}
