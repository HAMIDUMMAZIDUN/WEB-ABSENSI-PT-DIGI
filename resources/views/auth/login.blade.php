<x-guest-layout>
    <div class="w-full max-w-md p-8 space-y-8 bg-white shadow-lg rounded-xl">

        <div class="text-center">
            <img src="{{ asset('images/hamidun.jpg') }}" alt="Logo PT" class="w-24 h-24 mx-auto mb-4 rounded-full object-cover ring-4 ring-indigo-500/10 ring-offset-2">
            
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Aplikasi Absensi Karyawan
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                PT. DIGI TEKNO INDONESIA
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.095a1.23 1.23 0 00.41-1.412A6.998 6.998 0 0010 11.5a6.998 6.998 0 00-6.535 2.993z" />
                    </svg>
                </div>
                <x-text-input 
                    id="username" 
                    class="block w-full pl-10" 
                    type="text" 
                    name="username" 
                    :value="old('username')" 
                    required 
                    autofocus 
                    placeholder="Username"
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                     <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input 
                    id="password" 
                    class="block w-full pl-10"
                    type="password"
                    name="password"
                    required 
                    placeholder="Password"
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                       <path d="M10 9a3 3 0 100-6 3 3 0 000 6zM6 8a2 2 0 11-4 0 2 2 0 014 0zM1.49 15.326a.78.78 0 01-.358-.442 3 3 0 014.308-3.516 6.484 6.484 0 00-1.905 3.959c-.023.222-.014.442.028.658a.78.78 0 01-.585.869l-1.512.378a.78.78 0 01-.97-.923zM18.51 15.326a.78.78 0 00.358-.442 3 3 0 00-4.308-3.516 6.484 6.484 0 011.905 3.959c.023.222.014.442-.028.658a.78.78 0 00.585.869l1.512.378a.78.78 0 00.97-.923zM14 8a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <select name="role" class="block w-full rounded-md border-gray-300 py-2 pl-10 pr-3 text-gray-900 shadow-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="administrator">Administrator</option>
                    <option value="karyawan">Karyawan</option>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Ingat Saya</label>
                </div>

                <div class="text-sm">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
                            Lupa Password?
                        </a>
                    @endif
                </div>
            </div>
            <div> 
                <x-primary-button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-300 ease-in-out transform hover:scale-[1.02]">
                    Login
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>