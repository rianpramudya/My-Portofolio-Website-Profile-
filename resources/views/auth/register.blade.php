<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Buat Akun Admin</h2>
        <p class="text-sm text-slate-500 mt-1">Mulai kelola portofolio Anda sekarang.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Nama Lengkap</label>
            <div class="relative">
                <i class="ph-fill ph-user absolute left-3 top-3 text-slate-400 text-lg"></i>
                <input id="name" class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm placeholder:text-slate-400" 
                       type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Email Address</label>
            <div class="relative">
                <i class="ph-fill ph-envelope absolute left-3 top-3 text-slate-400 text-lg"></i>
                <input id="email" class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm placeholder:text-slate-400" 
                       type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Password</label>
            <div class="relative">
                <i class="ph-fill ph-lock-key absolute left-3 top-3 text-slate-400 text-lg"></i>
                <input id="password" class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm placeholder:text-slate-400"
                       type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Konfirmasi Password</label>
            <div class="relative">
                <i class="ph-fill ph-check-circle absolute left-3 top-3 text-slate-400 text-lg"></i>
                <input id="password_confirmation" class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm placeholder:text-slate-400"
                       type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30 flex items-center justify-center gap-2">
                Daftar Sekarang <i class="ph-bold ph-arrow-right"></i>
            </button>
        </div>

        <div class="text-center pt-4 border-t border-slate-100">
            <p class="text-sm text-slate-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-500 transition">
                    Login disini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>