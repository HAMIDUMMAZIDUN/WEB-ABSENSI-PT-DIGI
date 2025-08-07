<table class="min-w-full divide-y divide-gray-200">
    <thead class="sticky top-0 bg-gray-100 z-10">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Karyawan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bagian</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak (Phone)</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody>
        {{-- Check if $employees is not empty before looping --}}
        @if ($employees->count() > 0)
            @foreach ($employees as $index => $data)
                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $employees->firstItem() + $index }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if ($data->photo)
                            <img src="{{ asset('storage/' . $data->photo) }}" alt="Foto {{ $data->nama }}" class="h-10 w-10 rounded-full object-cover">
                        @else
                            <img src="{{ asset('images/default_avatar.png') }}" alt="Default Avatar" class="h-10 w-10 rounded-full object-cover">
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->nik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->email }}</td>
                   <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @php
                            $deptColors = [
                                'IT' => 'bg-red-500',
                                'Finance' => 'bg-blue-500',
                                'HRD' => 'bg-green-500',
                                'Marketing' => 'bg-orange-500',
                                'Sales' => 'bg-purple-500',
                                'Engineer' => 'bg-red-500',
                                'Product' => 'bg-indigo-500',
                                // Tambahkan semua departemen dan kelas warna yang sesuai
                            ];
                            $currentDeptColorClass = $deptColors[$data->dept] ?? 'bg-gray-500'; // Default jika tidak ditemukan
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $currentDeptColorClass }} text-white">
                            {{ $data->dept }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->role }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                         <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                             @if($data->status_colour == 'green') bg-green-100 text-green-800
                             @elseif($data->status_colour == 'red') bg-red-100 text-red-800
                             @elseif($data->status_colour == 'yellow') bg-yellow-100 text-yellow-800
                             @else bg-gray-100 text-gray-800
                             @endif">
                            {{ ucfirst($data->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ \Carbon\Carbon::parse($data->join_date)->format('d F Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->alamat }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->phone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('karyawan.edit', $data->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('karyawan.destroy', $data->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada data karyawan ditemukan.</td>
            </tr>
        @endif
    </tbody>
</table>
