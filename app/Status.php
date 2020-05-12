<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{


    const FIRSTLINE = 'Wachtend op eerstelijns';
    const FIRSTLINE_ASSIGNED =  "toegewezen op eerstelijns";
    const SECONDLINE = "Wachtend op eerstelijns";
    const SECONDLINE_ASSIGNED = "Toegewezen op eerstelijns";
    const DONE = "Ticket is afgehandeld";

    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }
}
