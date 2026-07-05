<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Menyimpan pembaruan data profil.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika user mengubah email, reset verifikasi email (opsional, bawaan Breeze)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Jika user mengisi form ganti password
        if ($request->filled('new_password')) {
            // Cek apakah password lama yang dimasukkan benar
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah!']);
            }
            // Enkripsi dan simpan password baru
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Data Profil berhasil diperbarui!');
    }

    /**
     * Menghapus akun pengguna (Opsional, bawaan Breeze. Kita biarkan saja).
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}