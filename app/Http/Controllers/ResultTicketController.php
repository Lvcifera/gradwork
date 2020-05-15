<?php

namespace App\Http\Controllers;

use App\ResultTicket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultTicketController extends Controller
{

    public function store() {

        $current_person = User::with('person')
            ->find(Auth::user()->id);
        $result_ticket = ResultTicket::create([
            'ticket_id' => request('ticket_id'),
            'person_id' => $current_person->person->id,
            //'person_voted' => 1,
            'yes' => 0,
            'no' => 0,
            'other' => 0]);
        switch (request()->vote_result) {
            case 'yes':
                $result_ticket->yes = 1;
                break;
            case 'no':
                $result_ticket->no = 1;
                break;
            case 'other':
                $result_ticket->other = 1;
                break;
        }

        $result_ticket->save();

        return redirect()->back()->with('success', 'Ваш голос учтен');

    }

}
