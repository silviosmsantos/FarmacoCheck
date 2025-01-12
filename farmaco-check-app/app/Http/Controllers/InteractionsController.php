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

        if (auth()->user()->hasRole(['superadmin', 'admin'])) {

            $request->validate([
                'medicine_1_id' => 'required|exists:medicines,id',
                'medicine_2_id' => 'required|exists:medicines,id|different:medicine_1_id',
                'severity' => 'required|in:grave,moderada,leve',
                'causes' => 'required|string',
                'source' => 'required|url',
            ]);

            $exists = Interaction::where(function ($query) use ($request) {
                $query->where('medicine_1_id', $request->medicine_1_id)
                    ->where('medicine_2_id', $request->medicine_2_id);
            })->orWhere(function ($query) use ($request) {
                $query->where('medicine_1_id', $request->medicine_2_id)
                    ->where('medicine_2_id', $request->medicine_1_id);
            })->exists();

            if ($exists) {
                return back()->withErrors(['error' => 'Já existe uma interação cadastrada para esses medicamentos.']);
            }

            Interaction::create([
                'medicine_1_id' => $request->medicine_1_id,
                'medicine_2_id' => $request->medicine_2_id,
                'severity' => $request->severity,
                'causes' => $request->causes,
                'source' => $request->source,
            ]);

            return redirect()->route('interactions')->with('message', 'Interação cadastrada com sucesso!');
        }

        return redirect()->route('/login')->with('message', 'Você não tem permissão para editar usuários.');
    }

    public function edit(Interaction $interaction)
    {
        $medicines = Medicine::all();

        return view('interactions.edit', compact(['interaction', 'medicines']));
    }

    public function update(Request $request, Interaction $interaction)
    {
        if (auth()->user()->hasRole(['superadmin', 'admin'])) {

            $input = $request->validate([
                'medicine_1_id' => ['required', 'exists:medicines,id'],
                'medicine_2_id' => ['required', 'exists:medicines,id', 'different:medicine_1_id'],
                'severity' => ['required', 'in:grave,moderada,leve'],
                'causes' => ['required', 'string'],
                'source' => ['required', 'url'],
            ]);

            if ($interaction->medicine_1_id != $request->medicine_1_id || $interaction->medicine_2_id != $request->medicine_2_id) {
                $exists = Interaction::where(function ($query) use ($request) {
                    $query->where('medicine_1_id', $request->medicine_1_id)
                        ->where('medicine_2_id', $request->medicine_2_id);
                })
                    ->orWhere(function ($query) use ($request) {
                        $query->where('medicine_1_id', $request->medicine_2_id)
                            ->where('medicine_2_id', $request->medicine_1_id);
                    })
                    ->where('id', '!=', $interaction->id)
                    ->exists();

                if ($exists) {
                    return back()->withErrors(['error' => 'Já existe uma interação cadastrada para esses medicamentos.']);
                }
            }

            $interaction->update($input);

            return redirect()->route('interactions')->with('message', 'Interação atualizada com sucesso!');
        }

        return redirect()->route('login')->with('message', 'Você não tem permissão para editar interações.');
    }

    public function delete(Interaction $interaction)
    {
        $interaction = Interaction::with(['medicines1', 'medicines2'])->findOrFail($interaction->id);

        return view('interactions.delete', compact('interaction'));
    }

    public function destroy(Request $request, Interaction $interaction)
    {
        if (auth()->user()->hasRole(['superadmin', 'admin'])) {

            $request->validate([
                'confirmation' => 'required|String',
            ]);

            if ($request->confirmation != $interaction->id) {
                return back()->withErrors(['confirmation' => 'O ID digitado não corresponde ao ID da interação.']);
            }

            $interaction->delete();

            return redirect()->route('interactions')->with('message', 'Interação excluida com sucesso!');
        }

        return redirect()->route('/login')->with('message', 'Você não tem permissão para excluir interações.');
    }

    public function search(Request $request)
    {
        $request->validate([
            'medicine1' => 'required|string',
            'medicine2' => 'required|string',
        ]);

        $medicine1 = Medicine::where('name', $request->medicine1)->first();
        $medicine2 = Medicine::where('name', $request->medicine2)->first();

        if (! $medicine1 || ! $medicine2) {
            return back()->with('message', 'Um ou ambos os medicamentos não foram encontrados.');
        }

        $interaction = Interaction::with(['medicines1', 'medicines2'])
            ->where('medicine_1_id', $medicine1->id)
            ->where('medicine_2_id', $medicine2->id)
            ->orWhere(function ($query) use ($medicine1, $medicine2) {
                $query->where('medicine_1_id', $medicine2->id)
                    ->where('medicine_2_id', $medicine1->id);
            })
            ->first();

        if ($interaction) {
            return view('dashboard', ['interaction' => $interaction]);
        }

        return back()->with('message', 'Nenhuma interação encontrada entre os medicamentos informados.');
    }
}
