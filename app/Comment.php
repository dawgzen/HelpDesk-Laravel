<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function users()
    {
        return $this->belongsTo("App\User");
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
