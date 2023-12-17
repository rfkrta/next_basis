@extends('head')

@section('content')
    <div class="main">
        <div class="main-top1">
            <button type="button" class="btnclass btn-primary" onclick="openConfirmationModal()">
                <i class="fa fa-angle-left"></i>
            </button>
            <!-- <a href="{{ route('admin.perjalanandinas.index') }}"><i class="fa fa-angle-left"></i></a> -->
            <h3>Tambah Perjalanan Dinas</h3>
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

        <div class="cong-box4">
            <form action="{{ route('admin.perjalanandinas.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <h5>Perusahaan</h5>
                    <div class="form-group">
                        <select name="id_mitras" id="id_mitras" required class="form-control">
                            <option value="">
                                Pilih Perusahaan
                            </option>
                        @foreach ($mitra as $mitra)
                            <option value="{{ $mitra->id }}">{{ $mitra->nama_mitra }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Kota Keberangkatan</h5>
                            <div class="form-group1">
                                <select name="kota_keberangkatan" id="kota_keberangkatan" required class="form-control1">
                                    <option>
                                        Pilih Kabupaten / Kota...
                                    </option>
                                @foreach ($regency as $kota)
                                    <option value="{{ $kota->id }}">{{ $kota->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <!-- <input type="text" name="kota" id="kota" class="date" placeholder="Tuliskan kota keberangkatan, di sini" value="{{ old('kota') }}"> -->
                        </div>
                        <div class="tgl1">
                            <h5>Komisi</h5>
                            <input type="number" name="komisi_dinas" id="komisi_dinas" class="date" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Tanggal Mulai</h5>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{ old('tanggal_mulai') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Tanggal Selesai</h5>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="date" value="{{ old('tanggal_selesai') }}">
                        </div>
                    </div>
                    <h5 class="tim1">Tim</h5>
                    <div class="tim">
                        <div class="form-group1">
                            <select name="id_anggota1" id="id_anggota1" required class="form-control1">
                                <option value="">
                                    Pilih anggota 1
                                </option>
                            @foreach ($user as $users)
                                <option value="{{ $users->id }}">{{ $users->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group1">
                            <select name="id_anggota2" id="id_anggota2" required class="form-control1">
                                <option value="">
                                    Pilih anggota 2
                                </option>
                            @foreach ($user as $users)
                                <option value="{{ $users->id }}">{{ $users->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="button">
                        <button type="button" id="tambahAnggotaBtn" onclick="openTambahAnggota()" class="btnx btn-primary">
                            Tambah Anggota
                        </button>
                        @include('admin.perjalanandinas.tambah-anggota')
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>PIC Perusahaan</h5>
                            <input type="text" name="nama_PIC_perusahaan" id="nama_PIC_perusahaan" class="date" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Jabatan PIC</h5>
                            <input type="text" name="jabatan_PIC" id="jabatan_PIC" class="date" readonly>
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" class="btny1 btn-primary btn-block" >
                            Ajukan Dinas
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
                perjalanan dinas. Semua perubahan
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

    <!-- Alert -->
    <div id="alertBox" class="alert-container" style="display:none;">
        <div class="alert-content">
            <p>Mohon isi semua field sebelum menambah perjalanan dinas!</p>
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

        $(document).ready(function() {
            $('#id_mitras').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ route('getPosisiById', ':id') }}".replace(':id', selectedValue),
                    type: 'GET',
                    success: function(data) {
                        // Update the gaji_posisi field value here
                        $('#komisi_dinas').val(data.komisi_dinas);
                        // $('#nama_PIC_perusahaan').val(data.nama_PIC_perusahaan);
                        // $('#jabatan_PIC').val(data.jabatan_PIC);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#id_mitras').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ route('getPosisiById1', ':id') }}".replace(':id', selectedValue),
                    type: 'GET',
                    success: function(data) {
                        // Update the gaji_posisi field value here
                        // $('#komisi_dinas').val(data.komisi_dinas);
                        $('#nama_PIC_perusahaan').val(data.nama_PIC_perusahaan);
                        // $('#jabatan_PIC').val(data.jabatan_PIC);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#id_mitras').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ route('getPosisiById2', ':id') }}".replace(':id', selectedValue),
                    type: 'GET',
                    success: function(data) {
                        // Update the gaji_posisi field value here
                        // $('#komisi_dinas').val(data.komisi_dinas);
                        // $('#nama_PIC_perusahaan').val(data.nama_PIC_perusahaan);
                        $('#jabatan_PIC').val(data.jabatan_PIC);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    });

    function openTambahAnggota() {
        document.getElementById('confirmationTambahAnggota').style.display = 'block';
    }

    function openConfirmationModal() {
        // Ambil nilai dari setiap input
        var mitras = document.getElementById('id_mitras').value;
        var kota = document.getElementById('kota_keberangkatan').value;
        var komisi = document.getElementById('komisi_dinas').value;
        var mulai = document.getElementById('tanggal_mulai').value;
        var selesai = document.getElementById('tanggal_selesai').value;
        var anggota1 = document.getElementById('id_anggota1').value;
        var anggota2 = document.getElementById('id_anggota2').value;
        var tambah = document.getElementById('tambahAnggotaBtn').value;
        var anggota3 = document.getElementById('id_anggota3').value;
        var anggota4 = document.getElementById('id_anggota4').value;
        var pic = document.getElementById('nama_PIC_perusahaan').value;
        var jabatan = document.getElementById('jabatan_PIC').value;

        // Periksa apakah semua field tidak kosong
        if (mitras.trim() !== '' || kota.trim() !== '' || komisi.trim() !== '' || mulai.trim() !== '' || selesai.trim() !== '' || anggota1.trim() !== '' || anggota2.trim() !== '' || tambah.trim() !== '' || anggota3.trim() !== '' || anggota4.trim() !== '' || pic.trim() !== '' || jabatan.trim() !== '') {
            // Jika semua field tidak kosong, buka modal konfirmasi
            document.getElementById('confirmationModal').style.display = 'block';
        } else {
            // Jika ada field yang kosong, berikan pesan peringatan atau tindakan lain
            // alert('Mohon isi semua field sebelum menambah data.');
            window.location.href = "{{ route('admin.perjalanandinas.index') }}";
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
        window.location.href = "{{ route('admin.perjalanandinas.index') }}";
    }

    function openConfirmationAddModal() {
        // Ambil nilai dari setiap input
        var mitras = document.getElementById('id_mitras').value;
        var kota = document.getElementById('kota_keberangkatan').value;
        var komisi = document.getElementById('komisi_dinas').value;
        var mulai = document.getElementById('tanggal_mulai').value;
        var selesai = document.getElementById('tanggal_selesai').value;
        var anggota1 = document.getElementById('id_anggota1').value;
        var anggota2 = document.getElementById('id_anggota2').value;
        var pic = document.getElementById('nama_PIC_perusahaan').value;
        var jabatan = document.getElementById('jabatan_PIC').value;

        // Periksa apakah semua field tidak kosong
        if (mitras.trim() !== '' && kota.trim() !== '' && komisi.trim() !== '' && mulai.trim() !== '' && selesai.trim() !== '' && anggota1.trim() !== '' && anggota2.trim() !== '' && pic.trim() !== '' && jabatan.trim() !== '') {
            //  Jika semua field tidak kosong, buka modal konfirmasi
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
        window.location.href = "{{ route('admin.perjalanandinas.store') }}";
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