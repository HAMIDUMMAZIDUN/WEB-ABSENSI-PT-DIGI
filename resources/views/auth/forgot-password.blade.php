<x-guest-layout>
    <div class="w-full max-w-md p-6 space-y-6 bg-white rounded-xl shadow-md dark:bg-gray-800">
        
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Lupa Kata Sandi?
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
            </p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="email" class="sr-only">Email</x-input-label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                            <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                        </svg>
                    </div>
                    <x-text-input 
                        id="email" 
                        class="block w-full pl-10 mt-1" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        placeholder="contoh@email.com"
                        required 
                        autofocus 
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Kirim Tautan Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>