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

    public function show(User $user, Ticket $ticket)
    {
        return $user->is($ticket->submitting_user) || $user->role->name == Role::SECONDLINE || $user->role->name == Role::FIRSTLINE;

    }

    public function create(User $user)
    {
        return $user->role->name == Role::CUSTOMER;
    }

    public function assign(User $user)
    {
        return $user->role->name == Role::FIRSTLINE || $user->role->name == Role::SECONDLINE;
    }

    public function comment(User $user, Ticket $ticket)
    {
        return ($user->is($ticket->submitting_user) || $user->assigned_tickets->contains($ticket)) && $ticket->isOpen();
    }

    public function close(User $user, Ticket $ticket)
    {
        return ($user->is($ticket->submitting_user) || $user->assigned_tickets->contains($ticket)) && $ticket->isOpen();
    }
}
