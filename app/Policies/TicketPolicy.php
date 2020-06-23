<?php

namespace App\Policies;

use App\Role;
use App\Status;
use App\Ticket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

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

    public function claim(User $user, Ticket $ticket)
    {
        return (
                $user->role->name == Role::FIRSTLINE && $ticket->status->name == Status::FIRSTLINE
            ) || (
                $user->role->name == Role::SECONDLINE && $ticket->status->name == Status::SECONDLINE);
    }

    public function free(User $user, Ticket $ticket)
    {
        return
            $user->assigned_tickets->contains($ticket) && (
                $user->role->name == Role::FIRSTLINE && $ticket->status->name == Status::FIRSTLINE_ASSIGNED
            ) || (
                $user->role->name == Role::SECONDLINE && $ticket->status->name == Status::SECONDLINE_ASSIGNED);
    }

    public function escalate(User $user, Ticket $ticket)
    {
        return $user->assigned_tickets->contains($ticket) && (
                $user->role->name == Role::FIRSTLINE && $ticket->status->name == Status::FIRSTLINE_ASSIGNED);
    }

    public function deescalate(User $user, Ticket $ticket)
    {
        return $user->assigned_tickets->contains($ticket) && (
                $user->role->name == Role::SECONDLINE && $ticket->status->name == Status::SECONDLINE_ASSIGNED);
    }

}
