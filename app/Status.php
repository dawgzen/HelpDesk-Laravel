<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const FIRSTLINE = 'Wachtend op eerstelijns';
    const FIRSTLINE_ASSIGNED = "toegewezen op eerstelijns";
    const SECONDLINE = "Wachtend op tweedelijns";
    const SECONDLINE_ASSIGNED = "Toegewezen op tweedelijns";
    const DONE = "Ticket is afgehandeld";

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
