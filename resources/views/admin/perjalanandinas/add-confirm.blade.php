<!-- resources/views/confirmation-modal.blade.php -->
<div id="confirmationAddModal" class="modal-container" style="display:none;">
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
        window.location.href = "{{ route('admin.perjalanandinas.store') }}";
        // document.getElementById('successAlert').style.display = 'block';
    }
</script>