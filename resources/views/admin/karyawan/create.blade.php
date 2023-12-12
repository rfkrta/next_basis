@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <button type="button" class="btnclass btn-primary" onclick="openConfirmationModal()">
            <i class="fa fa-angle-left"></i>
        </button>
        <!-- <a href="{{ route('admin.karyawan.index') }}"><i class="fa fa-angle-left"></i></a> -->
        <h3>Tambah Karyawan</h3>
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

    <div class="cong-box2">
        <form action="{{ route('admin.karyawan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="form-group">
                    <div class="nama">
                        <h5>Nama</h5>
                        <div class="form-group">
                            <select name="nama" id="nama" required class="form-control">
                                <option value="" disabled selected>Pilih nama karyawan</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->name }}">{{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="nama1">
                    <h5>Posisi</h5>
                    <div class="form-group">
                        <select name="id_positions" id="id_positions" required class="form-control karyawan">
                            <option value="">
                                Pilih Posisi Karyawan
                            </option>
                            @foreach ($position as $position)
                            <option value="{{ $position->id }}">{{ $position->nama_posisi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>NIP</h5>
                        <input type="text" name="nip" id="nip" class="date" placeholder="Tuliskan NIP di sini" value="{{ $nip ?? old('nip') }}">
                    </div>
                    <!-- <div id="gaji"></div> -->
                    <div class="tgl1">
                        <h5>Gaji</h5>
                        <input type="text" name="gaji_posisi" id="gaji_posisi" class="date gaji_posisi" readonly>
                    </div>

                </div>
                <!-- <div id="position"></div> -->
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal Mulai Kontrak Kerja</h5>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{ old('tanggal_mulai') }}">
                    </div>
                    <div class="tgl1">
                        <h5>Tanggal Selesai Kontrak Kerja</h5>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="date" value="{{ old('tanggal_selesai') }}">
                    </div>
                </div>
                <div class="button">
                    <button type="button" class="btnc btn-primary btn-block" onclick="openConfirmationAddModal()">
                        Tambah Karyawan
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
            tambah karyawan. Semua perubahan
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
        <p>Mohon isi semua field sebelum menambah karyawan!</p>
        <span class="close-button" onclick="closeAlertBox()">&times;</span>
    </div>
</div>
@endsection

@push('addon-script')
<!-- <script type="text/javascript" src="{{ url('admin/js/jquery-1.10.2.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ url('admin/js/jquery-3.7.1.min.js') }}"></script> -->
<script type="text/javascript" src="{{ url('admin/js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#id_positions').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ route('getGajiPosisiById', ':id') }}".replace(':id', selectedValue),
                    type: 'GET',
                    success: function(data) {
                        // Format the received salary as IDR before setting it in the input field
                        var formattedSalary = 'Rp.' + new Intl.NumberFormat('id-ID').format(data.gaji_posisi);

                        // Update the gaji_posisi field value here with the formatted salary
                        $('#gaji_posisi').val(formattedSalary);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#nama').on('change', function() {
                var selectedName = $(this).val();

                $.ajax({
                    url: "{{ route('getNIPByName', ':name') }}".replace(':name', selectedName),
                    type: 'GET',
                    success: function(data) {
                        // Update the nip field value here
                        $('#nip').val(data.nip);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
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
        if (nama.trim() !== '' && posisi.trim() !== '' && nip.trim() !== '' && gaji.trim() !== '' && mulai.trim() !== '' && selesai.trim() !== '') {
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