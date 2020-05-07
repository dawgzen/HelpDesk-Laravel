<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{


    public function show($id)
    {
        return view('test', ['id' => $id]);
    }

    public function index()
    {
        $klanten = DB::select('select * from klanten', [1]);

        return view('test', ['klanten' => $klanten]);
    }
}
