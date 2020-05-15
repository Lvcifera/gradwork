<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function person() {
        return $this->belongsTo('App\Person');
    }
    public function ticket() {
        return $this->belongsTo('App\Ticket');
    }
}
