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
                'name' => ['required', 'string', 'max:255', 'unique:medicines,name'],
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

    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        if (auth()->user()->hasRole(['superadmin', 'admin'])) {
            $input = $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:medicines,name,'.$medicine->id],
                'active_ingredient' => ['required', 'string', 'max:255'],
                'therapeutic_class' => ['nullable', 'string', 'max:255'],
                'dosage' => ['required', 'string', 'max:255'],
                'manufacturer' => ['required', 'string', 'max:255'],
            ]);

            $medicine->update($input);

            return redirect()->route('medicines')->with('message', 'Medicamento atualizado com sucesso!');
        }

        return redirect()->route('login')->with('message', 'Você não tem permissão para editar usuários.');
    }

    public function delete(Medicine $medicine)
    {
        return view('medicines.delete', compact('medicine'));
    }

    public function destroy(Request $request, Medicine $medicine)
    {
        if (auth()->user()->hasRole(['superadmin', 'admin'])) {

            $request->validate([
                'confirmation' => 'required|numeric',
            ]);

            if ($request->confirmation != $medicine->id) {
                return back()->withErrors(['confirmation' => 'O ID digitado não corresponde ao medicamento.']);
            }

            $medicine->delete();

            return redirect()->route('medicines')->with('message', 'Medicamento excluido com sucesso!');
        }

        return redirect()->route('medicines')->with('message', 'Você não tem permissão para excluir medicametos.');
    }
}
