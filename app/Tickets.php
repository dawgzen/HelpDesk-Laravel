<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $guarded = [];
    private $title;
    private $description;

    public function submitting_user()
    {
        return $this->belongsTo('App\Users', "users_id");
    }

    public function assigned_users()
    {
        return $this->belongsToMany("App\Users");
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function comments()
    {
        return $this->hasMany("App\Comment");
    }

    public function isOpen()
    {
        return $this->belongsToMany("App\Status");
    }
}
