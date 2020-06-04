<?php

namespace App\Policies;

use App\Role;
use App\Tickets;
use App\Users;
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

    public function show(Users $user, Tickets $ticket)
    {
        return $user->is($ticket->submitting_user) || $user->role->name == Role::SECONDLINE || $user->role->name == Role::FIRSTLINE;

    }

    public function create(Users $user)
    {
        return $user->role->name == Role::CUSTOMER;
    }

    public function assign(Users $user)
    {
        return $user->role->name == Role::FIRSTLINE || $user->role->name == Role::SECONDLINE;
    }

    public function comment(Users $user, Tickets $ticket)
    {
        return $user->is($ticket->submitting_user) && $ticket->isOpen() || $user->assigned_tickets->contains($ticket) && $ticket->isOpen();
    }

    public function close(Users $user , Tickets $ticket){
        return $user->is($ticket->submitting_user) && $ticket->isOpen() || $user->assigned_tickets->contains($ticket) && $ticket->isOpen();
    }
}
