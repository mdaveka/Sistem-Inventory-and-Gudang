<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            Mail::to($user->email)->send(new LoginMail($user));

            return response()->json([
                'message' => 'Login Berhasil! Email notifikasi sudah dikirim.',
                'user' => $user
            ]);
        }

        return response()->json(['message' => 'Email atau Password salah'], 401);
    }
}