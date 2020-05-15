<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $dates = ['date_off', 'created_at'];

    public function person() {
        return $this->belongsTo('App\Person');
    }
    public function result_ticket() {
        return $this->hasMany('App\ResultTicket');
    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }
}
