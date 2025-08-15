<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function profilIndex()
    {
        $user = Auth::user();
        return view('admin.profil.index', compact( 'user'));
    }

    public function profilUpdate(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'updated_at' => now(),
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        DB::table('users')->where('id', $user->id)->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
