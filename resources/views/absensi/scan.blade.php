<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scan Kehadiran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Ini adalah halaman untuk Scan Kehadiran.") }}
                    {{-- Add your QR code scanner or input field here --}}
                    <form action="{{ route('scan.kehadiran.store') }}" method="POST">
                        @csrf
                        <label for="employee_id">ID Karyawan:</label>
                        <input type="text" id="employee_id" name="employee_id" class="border p-2 rounded">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Catat Kehadiran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>