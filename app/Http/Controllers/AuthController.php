<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;


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

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'staf', 
        ]);

        
        $this->sendWelcomeEmail($user);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan cek email Anda.');
    }

    protected function sendWelcomeEmail($user)
    {
        $mail = new PHPMailer(true);

        try {
            
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'projectsisteminventoryandgudan@gmail.com'; 
            $mail->Password   = 'sdyeppxgzupybbuy'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port       = 587;

            $mail->setFrom('projectsisteminventoryandgudan@gmail.com', 'Danggu');
            $mail->addAddress($user->email, $user->name); 

            $mail->isHTML(true);
            $mail->Subject = 'Verifikasi Email Danggu';
            
            $mail->Body    = "
                <div style='font-family: sans-serif;'>
                    <h2>Halo {$user->name},</h2>
                    <p>Kamu telah melakukan pendaftaran akun <b>Danggu</b>.</p>
                    <p>Silakan gunakan akun ini untuk mengakses sistem gudang kami.</p>
                    <br>
                    <p>Salam,<br>Admin Danggu</p>
                </div>
            ";

            $mail->send();
        } catch (Exception $e) {
            \Log::error("Gagal mengirim email: {$mail->ErrorInfo}");
        }
    }
}