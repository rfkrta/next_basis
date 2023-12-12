<!-- resources/views/confirmation-modal.blade.php -->
<div id="confirmationModal" class="modal-container">
    <div class="confirmation-container">
        <h2>Keluar Halaman ?</h2>
        <p>Kamu akan membatalkan perubahan
            pengajuan cuti. Semua perubahan
            data tidak akan di simpan.</p>
        <div class="confirmation-buttons">
            <button class="cancel-button" onclick="cancelExit()">Batal</button>
            <button class="confirm-button" onclick="confirmExit()">Keluar</button>
        </div>
    </div>
</div>

<script>
    function cancelExit() {
        document.getElementById('confirmationModal').style.display = 'none';
        // Tambahkan logika untuk membatalkan keluar
        // alert('Pengguna membatalkan keluar.');
    }

    function confirmExit() {
        // Tambahkan logika untuk mengonfirmasi keluar
        // alert('Pengguna mengonfirmasi keluar.');
        // Redirect atau lakukan tindakan sesuai kebutuhan
        // return redirect()->route('admin.pengajuancuti.index');
        // return view('admin.pengajuancuti.index');
        window.location.href = "<?php echo e(route('admin.pengajuancuti.index')); ?>";
    }
</script>
<?php /**PATH D:\Project\next_basis\resources\views/admin/pengajuancuti/back.blade.php ENDPATH**/ ?>