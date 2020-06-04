<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];
    private $title;
    private $description;

    public function submitting_user()
    {
        return $this->belongsTo('App\User', "user_id");
    }

    public function assigned_users()
    {
        return $this->belongsToMany("App\User");
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function comments()
    {
        return $this->hasMany("App\Comment");
    }

    public function isOpen($id)
    {
        $ticket = Ticket::findOrFail($id);
        return $ticket->status->name != Status::DONE;
    }
}
