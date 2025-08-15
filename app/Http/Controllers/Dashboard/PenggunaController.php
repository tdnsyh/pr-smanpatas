<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PenggunaController extends Controller
{
    public function penggunaIndex()
    {
        $title = 'Pengguna';
        $users = User::all();
        return view('admin.pengguna.index', compact('title', 'users'));
    }

    public function penggunaCreate()
    {
        $title = 'Tambah Pengguna';
        return view('admin.pengguna.create', compact('title'));
    }

    public function penggunaStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:bendahara,sekretaris,media,operator,alumni,kehormatan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function penggunaEdit(User $user)
    {
        $title = 'Edit Pengguna';
        return view('admin.pengguna.edit', compact('title', 'user'));
    }

    public function penggunaUpdate(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:bendahara,sekretaris,media,operator,alumni,kehormatan',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function penggunaDestroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
