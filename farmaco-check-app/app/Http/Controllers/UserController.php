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
        // Verifica se o usuário autenticado tem a permissão de superadmin
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

            session()->flash('message', 'Usuário criado com sucesso!');

            return redirect()->route('users');

        } else {
            return redirect()->route('home')->with('error', 'Você não tem permissão para criar usuários.');
        }
    }
}
