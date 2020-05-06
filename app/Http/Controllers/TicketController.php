<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('ticket.create');
    }
    public function save(){

    }
    public function index(){

    }
    public function show($id){

    }
    public function update($id){

    }
}
