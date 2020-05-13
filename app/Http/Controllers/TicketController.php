<?php

namespace App\Http\Controllers;

use App\Status;
use App\Ticket;
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

        $status = Status::where('description', Status::FIRSTLINE)->first();
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->status()->associate($status);
        $request->user()->submitted_tickets()->save($ticket);
        return redirect()->route('ticket_index')->with('success', 'Your ticket is saved...');

    }

    public function index()
    {
        $tickets = Auth::user()->submitted_tickets()->orderBy('created_at', 'DESC')->get();
        return view('ticket.index', ['tickets' => $tickets]);
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorize('show', $ticket);
        return view('ticket.show', ['ticket' => $ticket]);
    }

    public function update($id)
    {

    }
}
