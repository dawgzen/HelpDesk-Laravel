<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }
}
