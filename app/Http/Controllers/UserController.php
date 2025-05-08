<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-users');
    }

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'jawatan' => 'nullable|string|max:255',
            'gred' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'no_kp' => 'nullable|string|max:255',
            'role' => ['required', Rule::in(['superadmin', 'admin', 'ppp', 'ppk', 'pyd'])],
            'jenis' => ['nullable', 'required_if:role,pyd', Rule::in(['pengurusan', 'sokongan_i', 'sokongan_ii'])]
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jawatan' => $request->jawatan,
            'gred' => $request->gred,
            'jabatan' => $request->jabatan,
            'no_kp' => $request->no_kp,
            'role' => $request->role,
            'jenis' => $request->jenis
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berjaya dicipta.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'jawatan' => 'nullable|string|max:255',
            'gred' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'no_kp' => 'nullable|string|max:255',
            'role' => ['required', Rule::in(['superadmin', 'admin', 'ppp', 'ppk', 'pyd'])],
            'jenis' => ['nullable', 'required_if:role,pyd', Rule::in(['pengurusan', 'sokongan_i', 'sokongan_ii'])]
        ]);

        $user->update($request->except('password'));

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')->with('success', 'Pengguna berjaya dikemaskini.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berjaya dipadam.');
    }
}
