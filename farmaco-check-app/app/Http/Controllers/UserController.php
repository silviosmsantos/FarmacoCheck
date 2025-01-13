<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

/**
 * UserController manages the CRUD operations for the User model.
 * 
 * Responsibilities:
 * - Display, create, update, and delete users.
 * - Enforce role-based access control (RBAC) for user management operations.
 * - Validate and sanitize user input for secure processing.
 */

class UserController extends Controller
{
    /**
     * Display a list of all users.
     *
     * @return \Illuminate\View\View The view displaying the list of users.
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form to create a new user.
     *
     * @return \Illuminate\View\View The view with the user creation form.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in the database.
     *
     * @param Request $request The HTTP request containing the user data.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirects to the users list on success.
     */
    public function store(Request $request)
    {
        if (auth()->user()->hasRole('superadmin')) {
            $input = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
                'role' => 'required|in:admin,superadmin',
            ]);

            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($request->role);

            // Mensagem de sucesso
            return redirect()->route('users')->with('message', 'Usuário criado com sucesso!');
        } else {
            // Caso o usuário não tenha permissão
            return redirect()->route('home')->with('message', 'Você não tem permissão para criar usuários.');
        }
    }

     /**
     * Show the form to edit a user's details.
     *
     * @param User $user The user to edit.
     * 
     * @return \Illuminate\View\View The view with the user edit form.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update a user's details in the database.
     *
     * @param Request $request The HTTP request containing the user data.
     * @param User $user The user to update.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirects back to the edit form on success.
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->hasRole('superadmin')) {
            // Validação dos dados enviados no formulário de edição
            $input = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'password' => ['nullable', 'string', 'confirmed', Rules\Password::defaults()],
                'role' => 'required|in:admin,superadmin',
            ]);

            // Atualizando os dados do usuário
            $user->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'] ? Hash::make($request->password) : $user->password, // Atualiza a senha somente se fornecida
            ]);

            // Atualizando o cargo do usuário
            $user->syncRoles([$request->role]);

            // Mensagem de sucesso
            return back()->with('message', 'Usuário atualizado com sucesso!');
        } else {
            return redirect()->route('/login')->with('message', 'Você não tem permissão para editar usuários.');
        }
    }

    /**
     * Show the confirmation form for deleting a user.
     *
     * @param User $user The user to delete.
     * 
     * @return \Illuminate\View\View The view with the user deletion form.
     */
    public function delete(User $user)
    {
        return view('users.delete', compact('user'));
    }

    /**
     * Delete a user from the database.
     *
     * @param Request $request The HTTP request containing the confirmation data.
     * @param User $user The user to delete.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirects to the users list on success.
     */
    public function destroy(Request $request, User $user)
    {
        if (auth()->user()->hasRole('superadmin')) {

            $request->validate([
                'confirmation' => 'required|String',
            ]);

            if ($request->confirmation != $user->name) {
                return back()->withErrors(['confirmation' => 'O nome digitado não corresponde ao usuário.']);
            }

            $user->delete();

            return redirect()->route('users')->with('message', 'Usuário excluido com sucesso!');
        } else {
            return redirect()->route('users')->with('message', 'Você não tem permissão para excluir usuários.');
        }
    }
}
