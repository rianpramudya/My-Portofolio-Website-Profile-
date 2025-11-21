<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Welcome Back! 👋</h2>
        <p class="text-sm text-slate-500 mt-1">Silakan login untuk mengakses dashboard.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Email Address</label>
            <div class="relative">
                <i class="ph-fill ph-envelope absolute left-3 top-3 text-slate-400 text-lg"></i>
                <input id="email" class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm placeholder:text-slate-400" 
                       type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1.5">
                <label for="password" class="block text-xs font-bold text-slate-500 uppercase">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-500 transition">
                        Lupa Password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <i class="ph-fill ph-lock-key absolute left-3 top-3 text-slate-400 text-lg"></i>
                <input id="password" class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm placeholder:text-slate-400"
                       type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Submit -->
        <div class="pt-2">
            <div class="block mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-slate-600">Ingat saya di perangkat ini</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30 flex items-center justify-center gap-2">
                Login <i class="ph-bold ph-sign-in"></i>
            </button>
        </div>

        <!-- Register Link -->
        <div class="text-center pt-4 border-t border-slate-100">
            <p class="text-sm text-slate-500">
                Belum punya akun admin? 
                <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-500 transition">
                    Daftar disini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>