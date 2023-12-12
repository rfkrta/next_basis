<!-- resources/views/confirmation-modal.blade.php -->
<div id="confirmationAddModal" class="modal-container">
    <div class="confirmation-container">
        <!-- <h2>Keluar Halaman ?</h2> -->
        <p>Apakah permohonan cuti 
            yang ingin diajukan
            sudah benar ?</p>
        <div class="confirmation-buttons">
            <button class="cancel-button" onclick="cancelExitAdd()">Tidak</button>
            <button type="submit" class="confirm-button" onclick="confirmExitAdd()">Iya</button>
        </div>
    </div>
</div>

<div id="successAlert" class="alert success" style="display:none;">
    <span class="closebtn" onclick="closeAlert()">&times;</span>
    Data berhasil ditambahkan!
</div>

<script>
    function cancelExitAdd() {
        document.getElementById('confirmationAddModal').style.display = 'none';
        // Tambahkan logika untuk membatalkan keluar
        // alert('Pengguna membatalkan pengajuan cuti.');
    }

    function confirmExitAdd() {
        // Tambahkan logika untuk mengonfirmasi keluar
        // alert('Pengguna mengonfirmasi pengajuan cuti.');
        // Redirect atau lakukan tindakan sesuai kebutuhan
        // return redirect()->route('admin.pengajuancuti.index');
        // return view('admin.pengajuancuti.index');
        window.location.href = "{{ route('admin.pengajuancuti.store') }}";
        // document.getElementById('successAlert').style.display = 'block';
    }

    function confirmAdd() {
    // ... (skrip sebelumnya) ...

    // Tampilkan alert ketika data berhasil ditambahkan
        document.getElementById('successAlert').style.display = 'block';
    }

    function closeAlert() {
        // Sembunyikan alert saat tombol close diklik
        document.getElementById('successAlert').style.display = 'none';
    }
</script>
