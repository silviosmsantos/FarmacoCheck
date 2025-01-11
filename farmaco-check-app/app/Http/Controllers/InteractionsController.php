<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Models\Medicine;
use Illuminate\Http\Request;

class InteractionsController extends Controller
{

    public function index()
    {   
        $interactions = Interaction::with(['medicines1', 'medicines2'])->paginate(3);


        return view('interactions.index', compact('interactions'));
    }

    public function create()
    {
        $medicines = Medicine::all();
        return view('interactions.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'medicine_1_id' => 'required|exists:medicines,id',
            'medicine_2_id' => 'required|exists:medicines,id|different:medicine_1_id',
            'severity' => 'required|in:grave,moderada,leve',
            'causes' => 'required|string',
            'source' => 'required|url',
        ]);

        Interaction::create([
            'medicine_1_id' => $request->medicine_1_id,     
            'medicine_2_id' => $request->medicine_2_id,
            'severity' => $request->severity,
            'causes' => $request->causes,
            'source' => $request->source,
        ]);
        
        return redirect()->route('interactions')->with('success', 'Interação cadastrada com sucesso!');
    }
}
