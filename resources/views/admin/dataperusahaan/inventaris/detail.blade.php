@extends('head')

@section('content')
    <div class="main">
        <div class="main-top1">
            <a href="{{ route('admin.dataperusahaan.inventaris.index') }}"><i class="fa fa-angle-left"></i></a>
            <h3>Detail Inventaris {{ $item->Nama_Barang }}</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="cong-box">
            <form action="{{ route('admin.dataperusahaan.inventaris.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <div class="form-1">
                        <label for="Kode">Kode Inventaris</label>
                        <input type="text" name="Kode" id="Kode" value="{{ $item->Kode }}" readonly>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="Nama_Barang">Nama Inventaris</label>
                            <input type="text" name="Nama_Barang" id="Nama_Barang" placeholder="Tuliskan Nama Inventaris, di sini" value="{{ $item->Nama_Barang }}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="Kategori">Kategori Inventaris</label>
                            <input type="text" name="Kategori" id="Kategori" placeholder="Tuliskan Nama Inventaris, di sini" value="{{ $item->kategoriInventaris->nama_inv }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="Jumlah">Jumlah</label>
                            <input type="number" name="Jumlah" id="Jumlah" placeholder="Tuliskan Jumlah Inventaris, di sini" value="{{ $item->Jumlah }}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="Tanggal_Diperoleh">Tanggal Diperoleh</label>
                            <input type="date" name="Tanggal_Diperoleh" id="Tanggal_Diperoleh" placeholder="Pilih Tanggal Perolehan Inventaris, di sini" value="{{ $item->Tanggal_Diperoleh }}" readonly>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- resources/views/confirmation-modal.blade.php -->
    <div id="confirmationModal" class="modal-container" style="display:none;">
        <div class="confirmation-container">
            <h2>Keluar Halaman ?</h2>
            <p>Kamu akan membatalkan perubahan
                inventaris. Semua perubahan
                data tidak akan di simpan.</p>
            <div class="confirmation-buttons">
                <button class="cancel-button" onclick="cancelExit()">Batal</button>
                <button class="confirm-button" onclick="confirmExit()">Keluar</button>
            </div>
        </div>
    </div>

    <!-- resources/views/confirmation-modal.blade.php -->
    <div id="confirmationAddModal" class="modal-container" style="display:none;">
        <div class="confirmation-container">
            <!-- <h2>Keluar Halaman ?</h2> -->
            <p>Apakah inventaris 
                yang ingin ditambahkan
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

    <!-- Alert -->
    <div id="alertBox" class="alert-container" style="display:none;">
        <div class="alert-content">
            <p>Mohon isi semua field sebelum menambah inventaris</p>
            <span class="close-button" onclick="closeAlertBox()">&times;</span>
        </div>
    </div>
@endsection

@push('addon-script')
<!-- <script type="text/javascript" src="{{ url('admin/js/jquery-1.10.2.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ url('admin/js/jquery-3.7.1.min.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ url('admin/js/jquery-3.6.0.min.js') }}"></script> -->
<!-- jQuery dan AJAX library -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function openConfirmationModal() {
        // Ambil nilai dari setiap input
        var kode = document.getElementById('Kode').value;
        var nama = document.getElementById('Nama_Barang').value;
        var kategori = document.getElementById('Kategori').value;
        var jumlah = document.getElementById('Jumlah').value;
        var tanggal = document.getElementById('Tanggal_Diperoleh').value;

        // Periksa apakah semua field tidak kosong
        if (kode.trim() !== '' || nama.trim() !== '' || kategori.trim() !== '' || jumlah.trim() !== '' || tanggal.trim() !== '') {
            // Jika semua field tidak kosong, buka modal konfirmasi
            document.getElementById('confirmationModal').style.display = 'block';
        } else {
            // Jika ada field yang kosong, berikan pesan peringatan atau tindakan lain
            // alert('Mohon isi semua field sebelum menambah data.');
            window.location.href = "{{ route('admin.dataperusahaan.inventaris.index') }}";
        }
    }

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
        window.location.href = "{{ route('admin.dataperusahaan.inventaris.index') }}";
    }

    function openConfirmationAddModal() {
        // Ambil nilai dari setiap input
        var kode = document.getElementById('Kode').value;
        var nama = document.getElementById('Nama_Barang').value;
        var kategori = document.getElementById('Kategori').value;
        var jumlah = document.getElementById('Jumlah').value;
        var tanggal = document.getElementById('Tanggal_Diperoleh').value;

        // Periksa apakah semua field tidak kosong
        if (kode.trim() !== '' && nama.trim() !== '' && kategori.trim() !== '' && jumlah.trim() !== '' && tanggal.trim() !== '') {
            //  Jika semua field tidak kosong, buka modal konfirmasi
            // document.getElementById('confirmationAddModal').style.display = 'block';
        } else {
            // Jika ada field yang kosong, berikan pesan peringatan atau tindakan lain
            // alert('Mohon isi semua field sebelum menambah data.');
            document.getElementById('alertBox').style.display = 'block';
        }
    }

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
        window.location.href = "{{ route('admin.dataperusahaan.inventaris.store') }}";
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

    function closeAlertBox() {
        // Sembunyikan alert saat tombol close diklik
        document.getElementById('alertBox').style.display = 'none';
    }
</script>
@endpush