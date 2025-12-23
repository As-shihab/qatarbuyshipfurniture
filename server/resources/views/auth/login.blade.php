<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Hub Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
            overflow: hidden;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .mesh-bg {
            position: fixed;
            top:0; left:0; width:100%; height:100%;
            z-index:-1;
            background-color:#0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.33) 0, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(124, 58, 237, 0.33) 0, transparent 50%),
                radial-gradient(at 100% 0%, rgba(139, 92, 246, 0.33) 0, transparent 50%),
                radial-gradient(at 0% 100%, rgba(99, 102, 241, 0.33) 0, transparent 50%);
            filter: blur(80px);
            animation: meshMove 20s ease infinite alternate;
        }
        @keyframes meshMove { from{transform:scale(1);} to{transform:scale(1.2);} }
        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
            animation: cardEntrance 0.8s cubic-bezier(0.16,1,0.3,1), float 6s ease-in-out infinite;
        }
        @keyframes cardEntrance { from{opacity:0;transform:scale(0.9) translateY(30px);} to{opacity:1;transform:scale(1) translateY(0);} }
        @keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
        .input-glass {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .input-glass:focus {
            background: rgba(255,255,255,0.08);
            border-color:#818cf8;
            box-shadow:0 0 20px rgba(99,102,241,0.2);
            transform: scale(1.01);
        }
        .btn-premium {
            background: linear-gradient(135deg,#6366f1 0%,#a855f7 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-premium::after {
            content:'';
            position:absolute; top:-50%; left:-50%;
            width:200%; height:200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            transition:0.5s;
        }
        .btn-premium:hover::after { left:100%; }
        .btn-premium:hover { transform: translateY(-2px) scale(1.02); box-shadow:0 15px 30px -5px rgba(99,102,241,0.5);}
        .show-pass-btn { transition: all 0.2s ease; color: rgba(255,255,255,0.3); }
        .show-pass-btn:hover { color:#818cf8; background: rgba(255,255,255,0.05);}
        .error-text { color:#f87171; font-size:0.8rem; margin-top:0.25rem; }
    </style>
</head>
<body>
    <div class="mesh-bg"></div>

    <div class="login-card w-full max-w-md p-10 rounded-[3rem] text-white">
        <div class="text-center mb-10">
            <div class="w-20 h-20 bg-gradient-to-tr from-indigo-600 to-purple-500 rounded-3xl mx-auto mb-6 flex items-center justify-center shadow-2xl shadow-indigo-500/30">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-800 tracking-tighter">Welcome Back<span class="text-indigo-400">.</span></h1>
            <p class="text-slate-400 mt-2 font-medium">Access your admin gateway</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
            @csrf

            @if(session('success'))
                <p class="text-green-400 text-sm text-center">{{ session('success') }}</p>
            @endif

            <!-- Email -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Admin Email</label>
                <div class="relative">
                    <input type="email" name="email" required placeholder="admin@hub.studio"
                        value="{{ old('email') }}"
                        class="input-glass w-full p-5 pl-6 rounded-2xl outline-none text-white placeholder:text-slate-600">
                </div>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <div class="flex justify-between items-center px-1">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Secret Key</label>
                    <a href="#" class="text-[10px] font-bold text-indigo-400 hover:text-indigo-300 transition-colors uppercase tracking-wider">Recover?</a>
                </div>
                <div class="relative group">
                    <input id="password-input" type="password" name="password" required placeholder="••••••••"
                        class="input-glass w-full p-5 pl-6 pr-14 rounded-2xl outline-none text-white placeholder:text-slate-600">
                </div>
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between px-1">
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                        class="w-4 h-4 rounded bg-slate-800 border-none accent-indigo-500 cursor-pointer">
                    <label for="remember" class="text-sm text-slate-400 font-medium cursor-pointer select-none">Persistent Session</label>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-premium w-full py-5 rounded-2xl font-800 text-lg shadow-xl mt-4">
                Verify Identity
            </button>
        </form>

        <p class="text-center text-slate-500 text-sm mt-10">
            Powered by <a href="https://aptigen.net" target="_blank" class="font-bold text-indigo-400 hover:text-indigo-300 transition-colors">Aptigen</a>
        </p>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password-input');
            const icon = document.getElementById('eye-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
    </script>
</body>
</html>
