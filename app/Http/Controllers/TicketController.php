<?php

namespace App\Http\Controllers;

use App\Role;
use App\Status;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $this->authorize('create', Ticket::class);
        return view('ticket.create');
    }

    public function save(Request $request)
    {
        $this->authorize('create', Ticket::class);
        $request->validate([
            'title' => 'required|max:191',
            'description' => 'required'
        ]);

        $status = Status::where('name', Status::FIRSTLINE)->first();
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->status()->associate($status);
        $request->user()->submitted_tickets()->save($ticket);
        return redirect()->route('ticket_index')->with('success', 'Your ticket is saved...');

    }

    public function close($id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorize('close', $ticket);
        $status = Status::where('description', Status::DONE)->first();

        return redirect()->route('ticket_index')->with('success', 'Your ticket is now closed...');
    }

    public function index()
    {
        $this->authorize('create', Ticket::class);

        $tickets = Auth::user()->submitted_tickets()->orderBy('created_at', 'DESC')->get();

        return view('ticket.index', ['tickets' => $tickets]);
    }

    public function assign(User $user)
    {
        return $user->role->name == Role::FIRSTLINE || $user->role->name == Role::SECONDLINE;
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorize('show', $ticket);
        return view('ticket.show', ['ticket' => $ticket]);
    }


    public function index_helpdesk()
    {
        $this->authorize('assign', Ticket::class);

        $assigned_tickets = Auth::user()->assigned_tickets;

        if(Auth::user()->role->name == Role::FIRSTLINE){
            $status = Status::where('name', Status::FIRSTLINE)->first();
        }
        else if(Auth::user()->role->name == Role::SECONDLINE){
            $status = Status::where('name', Status::SECONDLINE)->first();
        }

        $unassigned_tickets = $status->tickets;
        return view(

            'ticket.index_helpdesk',
            [
                'assigned_tickets' => $assigned_tickets,
                'unassigned_tickets' => $unassigned_tickets
            ]
        );
    }
}
