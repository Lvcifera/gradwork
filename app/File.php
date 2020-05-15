<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['ticket_id', 'file'];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
