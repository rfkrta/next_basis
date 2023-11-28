@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <!-- <button type="button" class="btnclass btn-primary" onclick="openConfirmationModal()">
            <i class="fa fa-angle-left"></i>
        </button> -->
        <a href="{{ route('admin.karyawan.index') }}"><i class="fa fa-angle-left"></i></a>
        <h3>Ubah Karyawan {{ $item->nama }}</h3>
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

    <div class="cong-box1">
        <form action="{{ route('admin.karyawan.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="content">
                <div class="nama">
                    <h5>Nama</h5>
                    <input type="text" name="nama" id="nama" class="input2" placeholder="Tuliskan nama karyawan, di sini" value="{{ $item->nama }}" readonly>
                </div>
                <div class="nama1">
                    <h5>Posisi</h5>
                    <div class="form-group">
                        <select name="id_positions" id='id_positions' required class="form-control">
                            <option value="">Pilih Posisi Karyawan</option>
                            @foreach ($position as $pos)
                            <option value="{{ $pos->id }}" {{ $item->id_positions == $pos->id ? 'selected' : '' }}>
                                {{ $pos->nama_posisi }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>NIP</h5>
                        <input type="number" name="nip" id="nip" class="date" placeholder="Tuliskan NIP, di sini" value="{{ $item->nip }}" readonly>
                    </div>
                    <!-- <div id="position"></div> -->
                    <div class="tgl1">
                        <h5>Gaji Posisi</h5>
                        <input type="text" name="gaji_posisi" id="gaji_posisi" class="date" value="{{ $item->gaji_posisi }}" readonly>
                    </div>
                </div>
                <!-- <div id="position"></div> -->
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal Mulai Kontrak Kerja</h5>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{ $item->tanggal_mulai }}">
                    </div>
                    <div class="tgl1">
                        <h5>Tanggal Selesai Kontrak Kerja</h5>
                        <input type="date" name="tanggal_selesai" id="" class="date" value="{{ $item->tanggal_selesai }}">
                    </div>
                </div>
                <div class="tglx1">
                        <div class="tgl1">
                            <h5>Status</h5>
                            <div class="form-group">
                                <select value='status' name="status" id="status" class="form-control">
                                    <option value="{{ $item->status }}">
                                        {{ $item->status }}
                                    </option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="button">
                    <button type="submit" class="btnc btn-primary btn-block">
                        Ubah Karyawan
                    </button>
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
                karyawan. Semua perubahan
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
            <p>Apakah karyawan 
                yang ingin di ubah
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
            <p>Mohon isi semua field sebelum ubah karyawan!</p>
            <span class="close-button" onclick="closeAlertBox()">&times;</span>
        </div>
    </div>
@endsection

@push('addon-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#id_positions').on('change', function() {
            var selectedValue = $(this).val();
            console.log(selectedValue); // Verify if the correct position ID is captured

            // Make an Ajax request to fetch gaji_posisi based on selectedValue
            $.ajax({
                url: "/admin/karyawan/getgajiposisi/" + selectedValue,
                type: 'GET',
                success: function(data) {
                    // Update the gaji_posisi field in your form
                    $('#gaji_posisi').val(data.gaji_posisi);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

    function openConfirmationModal() {
        // Ambil nilai dari setiap input
        var nama = document.getElementById('nama').value;
        var posisi = document.getElementById('id_positions').value;
        var nip = document.getElementById('nip').value;
        var gaji = document.getElementById('gaji_posisi').value;
        var mulai = document.getElementById('tanggal_mulai').value;
        var selesai = document.getElementById('tanggal_selesai').value;

        // Periksa apakah semua field tidak kosong
        if (nama.trim() !== '' || posisi.trim() !== '' || nip.trim() !== '' || gaji.trim() !== '' || mulai.trim() !== '' || selesai.trim() !== '') {
            // Jika semua field tidak kosong, buka modal konfirmasi
            document.getElementById('confirmationModal').style.display = 'block';
        } else {
            // Jika ada field yang kosong, berikan pesan peringatan atau tindakan lain
            // alert('Mohon isi semua field sebelum menambah data.');
            window.location.href = "{{ route('admin.karyawan.index') }}";
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
        window.location.href = "{{ route('admin.karyawan.index') }}";
    }

    function openConfirmationAddModal() {
        // Ambil nilai dari setiap input
        var nama = document.getElementById('nama').value;
        var posisi = document.getElementById('id_positions').value;
        var nip = document.getElementById('nip').value;
        var gaji = document.getElementById('gaji_posisi').value;
        var mulai = document.getElementById('tanggal_mulai').value;
        var selesai = document.getElementById('tanggal_selesai').value;

        // Periksa apakah semua field tidak kosong
        if (nama.trim() !== '' || posisi.trim() !== '' || nip.trim() !== '' || gaji.trim() !== '' || mulai.trim() !== '' || selesai.trim() !== '') {
            // Jika semua field tidak kosong, buka modal konfirmasi
            document.getElementById('confirmationAddModal').style.display = 'block';
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
        window.location.href = "{{ route('admin.karyawan.store') }}";
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