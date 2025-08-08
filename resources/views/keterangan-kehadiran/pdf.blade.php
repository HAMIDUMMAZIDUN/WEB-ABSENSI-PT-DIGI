<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kehadiran</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        .header p { margin: 5px 0; }
        .badge { display: inline-block; padding: 2px 8px; font-size: 9px; border-radius: 12px; }
        .bg-green { background-color: #d1fae5; color: #065f46; }
        .bg-red { background-color: #fee2e2; color: #991b1b; }
        .bg-orange { background-color: #ffedd5; color: #9a3412; }
        .bg-blue { background-color: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Kehadiran Karyawan</h1>
        <p>PT Digitekno {{-- Ganti dengan nama perusahaan Anda --}}</p>
        <p>Tanggal Laporan: {{ $tanggal }}</p>
        @if($filterBagian)
        <p><strong>Filter Bagian:</strong> {{ $filterBagian }}</p>
        @endif
        @if($searchQuery)
        <p><strong>Filter Nama:</strong> {{ $searchQuery }}</p>
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Karyawan</th>
                <th>Email</th>
                <th>Bagian</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataKehadiran as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_karyawan }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->bagian }}</td>
                <td>
                    @php
                        $statusClass = [
                            'Hadir' => 'bg-green',
                            'Alpha' => 'bg-red',
                            'Terlambat' => 'bg-orange',
                            'Izin' => 'bg-blue',
                        ][$item->status_kehadiran] ?? '';
                    @endphp
                    <span class="badge {{ $statusClass }}">
                        {{ $item->status_kehadiran }}
                    </span>
                </td>
                <td>{{ $item->keterangan_text }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
