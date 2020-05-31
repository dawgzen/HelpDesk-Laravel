<?php

namespace App\Policies;

use App\Role;
use App\Ticket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function show(User $user, Ticket $ticket){
        return $user->is($ticket->submitting_user);

    }

    public function create(User $user) {
        return $user->role->name == Role::CUSTOMER;
    }
    public function assign( User $user){
        return $user->role->name == Role::FIRSTLINE || $user->role->name == Role::SECONDLINE;
    }
}
