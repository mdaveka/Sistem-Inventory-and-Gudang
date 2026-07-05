<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DANGGU - Lupa Password</title>

    <!-- ICON PHOSPHOR -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/fill/style.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Desain Latar Belakang Gambar Gudang (Sama seperti Login) */
        body {
            background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }

        /* Overlay Gradasi Gelap (Navy & Biru) */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(30, 64, 175, 0.65) 100%);
            z-index: -1;
        }

        /* Desain Kartu Solid & Bersih */
        .solid-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            transform: translateY(0px);
            transition: all 0.3s ease;
        }
        .solid-card:hover {
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.45);
        }

        /* Desain Form Input Minimalis (Sama persis dengan Login, tanpa icon di dalam) */
        .modern-input {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            color: #1e293b;
            padding: 14px 18px; 
            width: 100%;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .modern-input:focus {
            background: #ffffff;
            border-color: #2563eb; 
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        .modern-input::placeholder {
            color: #94a3b8;
        }

        /* Desain Tombol Biru Solid */
        .btn-modern {
            background: #2563eb; 
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 12px;
            padding: 16px 24px;
            width: 100%;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);
        }
        .btn-modern:hover {
            background: #1d4ed8; 
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.4);
        }
        .btn-modern:active {
            transform: translateY(0);
        }

        .fade-in {
            animation: fadeIn ease 0.8s;
        }
        @keyframes fadeIn {
            0% {opacity:0; transform: translateY(20px);}
            100% {opacity:1; transform: translateY(0);}
        }
    </style> 
</head>
<body class="font-sans antialiased text-gray-900 h-screen flex items-center justify-center p-4">
    
    <div class="solid-card fade-in w-full max-w-lg p-10 md:p-12 space-y-8 relative z-10">
        
        <!-- LOGO DANGGU (Persis seperti di Halaman Login) -->
        <div class="text-center flex flex-col items-center justify-center mb-2">
            <div class="flex items-center justify-center">
                <i class="ph-fill ph-stack text-blue-600 text-3xl mr-2"></i>
                <h1 class="text-3xl font-bold tracking-wider text-slate-900">DANGGU</h1>
            </div>
            <p class="text-sm text-gray-500 font-medium mt-2">Sistem Manajemen Inventory</p>
        </div>

        <!-- Teks Bantuan -->
        <div class="text-sm text-gray-600 leading-relaxed text-center font-medium">
            Lupa password? Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan link untuk membuat password baru.
        </div>

        <!-- Session Status (Pesan sukses jika email berhasil terkirim) -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Input Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <div class="relative">
                    <input id="email" class="modern-input" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email terdaftar" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-500 font-medium text-sm" />
            </div>

            <!-- Tombol Aksi & Link Kembali -->
            <div class="pt-4 space-y-6">
                <button type="submit" class="btn-modern">
                    Kirim Link Reset
                </button>
                
                <!-- Link Kembali ke Login -->
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors">
                        Kembali ke halaman Login
                    </a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>