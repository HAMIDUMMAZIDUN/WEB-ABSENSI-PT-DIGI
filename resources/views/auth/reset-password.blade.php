<x-guest-layout>
    <div class="w-full max-w-md p-6 space-y-6 bg-white rounded-xl shadow-md dark:bg-gray-800">

        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Atur Ulang Kata Sandi
            </h2>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block w-full mt-1 bg-gray-100 dark:bg-gray-700" type="email" name="email" :value="old('email', $request->email)" required readonly />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Kata Sandi Baru')" />
                <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="w-full justify-center">
                    {{ __('Atur Ulang Kata Sandi') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>