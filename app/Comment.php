<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo("App\Users");
    }

    public function ticket()
    {
        return $this->belongsTo('App\Tickets');
    }
}
