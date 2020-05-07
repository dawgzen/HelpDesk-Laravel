<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{


    const UNASSIGNED = 'unassigned';

    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }
}
