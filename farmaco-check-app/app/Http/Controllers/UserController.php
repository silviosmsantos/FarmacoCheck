<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

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

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

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

    public function delete(User $user)
    {
        return view('users.delete', compact('user'));
    }

    public function destroy(User $user)
    {
        if (auth()->user()->hasRole('superadmin')) {
            $user->delete();

            return redirect()->route('users')->with('message', 'Usuário excluido com sucesso!');
        } else {
            return redirect()->route('/users')->with('message', 'Você não tem permissão para excluir usuários.');
        }
    }
}
