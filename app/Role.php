<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const CUSTOMER = "customer";
    const FIRSTLINE = "first_line";
    const SECONDLINE = "second_line";
    const ADMIN = "admin";

    public function user(){
        return$this->hasMany("App\user");
    }
}
