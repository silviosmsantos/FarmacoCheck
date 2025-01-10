<?php

namespace App\Http\Controllers;

use App\Models\interaction;
use Illuminate\Http\Request;

class interactionsController extends Controller
{

    public function index()
    {   
        $interactions = Interaction::with(['medicines1', 'medicines2'])->get();

        return view('interactions.index', compact('interactions'));
    }
}
