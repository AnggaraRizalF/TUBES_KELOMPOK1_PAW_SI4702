<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $roleFilter = $request->input('role');

        $users = User::query()
                    ->when($searchQuery, function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . $searchQuery . '%')
                            ->orWhere('email', 'like', '%' . $searchQuery . '%');
                    })
                    ->when($roleFilter && $roleFilter !== 'all', function ($query) use ($roleFilter) {
                        $query->where('role', $roleFilter);
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('admin.users.index', compact('users', 'searchQuery', 'roleFilter'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nim' => $request->nim ?? null,
        ]);

        return redirect()->route('admin.users.index')
        ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')
                            ->with('success', 'Pengguna berhasil diperbarui.');
    }
    public function destroy(User $user)
    {
        if (auth()->user()->id === $user->id) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
