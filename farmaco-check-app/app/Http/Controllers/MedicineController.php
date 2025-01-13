<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

/**
 * MedicineController manages CRUD operations for the Medicine model.
 * 
 * Responsibilities:
 * - Display, create, update, and delete medicines.
 * - Enforce role-based access control (RBAC) for medicine management operations.
 * - Validate and handle user input for secure processing.
 */
class MedicineController extends Controller
{
    
    /**
     * Display a list of all medicines.
     *
     * @return \Illuminate\View\View The view displaying the list of medicines.
     */
    public function index()
    {
        return view('medicines.index');
    }

      /**
     * Show the form to create a new medicine.
     *
     * @return \Illuminate\View\View The view with the medicine creation form.
     */
    public function create()
    {
        return view('medicines.create');
    }

    /**
     * Store a newly created medicine in the database.
     *
     * @param Request $request The HTTP request containing the medicine data.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirects to the medicines list on success or an error message on failure.
     */
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

    /**
     * Show the form to edit a medicine's details.
     *
     * @param Medicine $medicine The medicine to edit.
     * 
     * @return \Illuminate\View\View The view with the medicine edit form.
     */
    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

        /**
     * Update a medicine's details in the database.
     *
     * @param Request $request The HTTP request containing the updated medicine data.
     * @param Medicine $medicine The medicine to update.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirects to the medicines list on success.
     */
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

    /**
     * Show the confirmation form for deleting a medicine.
     *
     * @param Medicine $medicine The medicine to delete.
     * 
     * @return \Illuminate\View\View The view with the medicine deletion form.
     */
    public function delete(Medicine $medicine)
    {
        return view('medicines.delete', compact('medicine'));
    }

    /**
     * Delete a medicine from the database.
     *
     * @param Request $request The HTTP request containing the confirmation data.
     * @param Medicine $medicine The medicine to delete.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirects to the medicines list on success or an error message on failure.
     */
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
