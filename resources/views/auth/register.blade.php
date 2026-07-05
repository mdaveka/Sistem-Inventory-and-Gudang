<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DANGGU - Register Staff</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen relative flex items-center justify-center p-4 overflow-hidden">

    <img 
        src="{{ asset('img/backgroud_login.avif') }}" 
        alt="Background" 
        class="absolute inset-0 w-full h-full object-cover z-0"
    >

    <div class="absolute inset-0 bg-blue-950/85 z-10"></div>

    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-8 md:p-10 relative z-20 my-10">
        
        <div class="text-center mb-6">
            <div class="flex justify-center items-center space-x-2 mb-2">
                <div class="bg-blue-600 p-2 rounded-xl">
                    <i class="fas fa-user-plus text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold tracking-tighter text-slate-900">DAFTAR AKUN</h1>
            </div>
            <p class="text-sm text-gray-500 font-medium">Lengkapi data untuk akses sistem DANGGU</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full pl-11 pr-4 py-3 bg-gray-50 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                           placeholder="Nama Lengkap Staff" required>
                </div>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full pl-11 pr-4 py-3 bg-gray-50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                           placeholder="email@gudang.com" required>
                </div>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" name="password" 
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                               placeholder="••••••••" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <input type="password" name="password_confirmation" 
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                               placeholder="••••••••" required>
                    </div>
                </div>
            </div>
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg transition-all active:scale-[0.98] mt-4">
                DAFTAR SEKARANG
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-500">Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Log In</a>
            </p>
        </div>
    </div>

</body>
</html>
    