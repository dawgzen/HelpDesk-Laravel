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
        $status = Status::where('name', Status::DONE)->first();
        $ticket->status()->associate($status);
//        $this->user()->submitted_tickets()->save($ticket);
        $ticket->save();
        return redirect()->back()->with('success', __('Your ticket is now closed...'));
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

    public function claim($id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorize('claim', $ticket);
        if ($ticket->status->name == Status::FIRSTLINE) {
            $status = Status::where('name', Status::FIRSTLINE_ASSIGNED)->first();
        }   else if ($ticket->status->name == Status::SECONDLINE) {
            $status = Status::where('name', Status::SECONDLINE_ASSIGNED)->first();
        }
        $ticket->status()->associate($status);
        $ticket->save();
        Auth::User()->assigned_tickets()->attach($ticket);
        return redirect()->back()->with('success', 'Ticket claimed');
    }

    public function free($id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorize('free', $ticket);
        if ($ticket->status->name == Status::FIRSTLINE_ASSIGNED) {
            $status = Status::where('name', Status::FIRSTLINE)->first();
        }   else if ($ticket->status->name == Status::SECONDLINE_ASSIGNED) {
            $status = Status::where('name', Status::SECONDLINE)->first();
        }
        $ticket->status()->associate($status);
        $ticket->save();
        Auth::User()->assigned_tickets()->detach($ticket);
        return redirect()->back()->with('success', 'Ticket freed');
    }


    public function index_helpdesk()
    {
        $this->authorize('assign', Ticket::class);

        $assigned_tickets = Auth::user()->assigned_tickets;

        if (Auth::user()->role->name == Role::FIRSTLINE) {
            $status = Status::where('name', Status::FIRSTLINE)->first();
        } else if (Auth::user()->role->name == Role::SECONDLINE) {
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
