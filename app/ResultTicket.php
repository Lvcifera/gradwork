<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultTicket extends Model
{
    protected $fillable = ['ticket_id', 'person_id', 'person_voted', 'yes', 'no', 'other'];
    public function ticket() {
        return $this->belongsTo('App\Ticket');
    }
    public function person() {
        return $this->belongsTo('App/Person');
    }
}
