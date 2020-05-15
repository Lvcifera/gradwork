<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $fillable = [
        'user_id',
        'fio',
        'region',
        'city',
        'street',
        'struct_number',
        'flat_number'];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function tickets() {
        return $this->hasMany('App\Ticket');
    }
    public function comment() {
        return $this->hasMany('App\Comment');
    }
    public function result_ticket() {
        return $this->hasOne('App\ResultTicket');
    }
}
