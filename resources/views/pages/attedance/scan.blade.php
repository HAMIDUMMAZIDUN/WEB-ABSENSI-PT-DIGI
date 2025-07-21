@extends('layouts.app') {{-- Asumsi Anda punya layout utama --}}

@section('content')
<div class="container">
    <div class="text-center">
        <h2>Scan Kartu RFID Anda</h2>
        <p>Arahkan kartu ke RFID Reader</p>
    </div>

    <form id="scan-form" class="text-center">
        @csrf
        {{-- Input ini akan diisi otomatis oleh reader, kita sembunyikan saja --}}
        <input type="text" id="rfid_uid" name="rfid_uid" class="form-control" autofocus>
    </form>

    <hr>

    <div id="result-area" class="text-center" style="min-height: 300px;">
        <div id="default-message">
            <p class="text-muted">Menunggu scan...</p>
            
        </div>
        <div id="scan-result" style="display: none;">
            <img id="employee-photo" src="" alt="Foto Karyawan" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
            <h3 id="employee-name"></h3>
            <p id="scan-message" class="lead"></p>
            <p>Waktu: <strong id="scan-time"></strong></p>
        </div>
        <div id="error-message" class="alert alert-danger" style="display: none;"></div>
    </div>
</div>

{{-- SCRIPT PENTING --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const form = document.getElementById('scan-form');
    const rfidInput = document.getElementById('rfid_uid');
    
    // --- Hasil Scan Elements ---
    const defaultMessage = document.getElementById('default-message');
    const scanResultDiv = document.getElementById('scan-result');
    const errorMessageDiv = document.getElementById('error-message');

    // --- Data Elements ---
    const photoEl = document.getElementById('employee-photo');
    const nameEl = document.getElementById('employee-name');
    const messageEl = document.getElementById('scan-message');
    const timeEl = document.getElementById('scan-time');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form submit biasa
        
        const rfid = rfidInput.value;

        // Reset tampilan
        errorMessageDiv.style.display = 'none';
        scanResultDiv.style.display = 'none';
        defaultMessage.style.display = 'block';

        axios.post("{{ route('attendance.record') }}", {
            rfid_uid: rfid
        })
        .then(function(response) {
            const result = response.data;
            if (result.status === 'success') {
                const data = result.data;
                photoEl.src = data.photo;
                nameEl.textContent = data.name;
                messageEl.textContent = result.message;
                timeEl.textContent = data.time;
                
                // Tampilkan hasil
                defaultMessage.style.display = 'none';
                scanResultDiv.style.display = 'block';
            }
        })
        .catch(function(error) {
            // Tampilkan error jika kartu tidak ada atau masalah server
            const message = error.response.data.message || 'Terjadi kesalahan.';
            errorMessageDiv.textContent = message;
            errorMessageDiv.style.display = 'block';
            defaultMessage.style.display = 'none';
        })
        .finally(function() {
            // Kosongkan input dan fokuskan kembali setelah beberapa detik
            setTimeout(() => {
                rfidInput.value = '';
                rfidInput.focus();
                
                // Sembunyikan lagi hasil setelah beberapa detik
                setTimeout(() => {
                    scanResultDiv.style.display = 'none';
                    errorMessageDiv.style.display = 'none';
                    defaultMessage.style.display = 'block';
                }, 5000); // Tampilkan hasil selama 5 detik
            }, 500);
        });
    });

    // Selalu fokus ke input field
    setInterval(() => {
      rfidInput.focus();
    }, 500);
</script>
@endsection