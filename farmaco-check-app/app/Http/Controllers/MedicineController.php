<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        return view('medicines.index');
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {

        if (auth()->user()->hasRole(['superadmin', 'admin'])) {

            $input = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'active_ingredient' => ['required', 'string', 'max:255'],
                'therapeutic_class' => ['required', 'string', 'max:255'],
                'dosage' => ['required', 'string', 'max:255'],
                'manufacturer' => ['required', 'string', 'max:255'],
            ]);

            try {

                Medicine::create($input);

                return redirect()->route('medicines')->with('message', 'Medicamento cadastrado com sucesso!');
            } catch (\Exception $e) {

                return redirect()->back()->with('error', 'Houve um erro ao cadastrar o medicamento.');
            }
        }

        return redirect()->route('dashboard')->with('error', 'Você não tem permissão para realizar essa ação.');
    }
}
