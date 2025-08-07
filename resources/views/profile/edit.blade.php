<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800">Pengaturan Akun</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Kelola informasi profil, kata sandi, dan data akun Anda.
                    </p>
                </div>

                <div class="p-6">
                    <h4 class="text-xl font-semibold text-gray-800 mb-2">Informasi Profil</h4>
                    <p class="text-sm text-gray-500 mb-4">Perbarui informasi akun Anda.</p>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <hr class="border-gray-200 mx-6">

                <div class="p-6">
                    <h4 class="text-xl font-semibold text-gray-800 mb-2">Perbarui Kata Sandi</h4>
                    <p class="text-sm text-gray-500 mb-4">Pastikan kata sandi Anda kuat dan aman.</p>
                    @include('profile.partials.update-password-form')
                </div>

                <hr class="border-gray-200 mx-6">

                <div class="p-6">
                    <h4 class="text-xl font-semibold text-gray-800 mb-2">Hapus Akun</h4>
                    <p class="text-sm text-gray-500 mb-4">Tindakan ini tidak bisa dibatalkan.</p>
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>