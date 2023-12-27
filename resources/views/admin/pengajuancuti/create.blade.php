@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <button type="button" class="btnclass btn-primary" onclick="openConfirmationModal()">
            <i class="fa fa-angle-left"></i>
        </button>
        @include('admin.pengajuancuti.back')
        <!-- Modal Konfirmasi -->
        <!-- <a href="{{ route('admin.pengajuancuti.index') }}" data-toggle="modal" data-target="#confirmationModal"><i class="fa fa-angle-left"></i></a> -->
        <h3>Pengajuan Cuti</h3>
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
    @if(Session::has('alert'))
    <script>
        alert("{{ Session::get('alert') }}");
    </script>
    @endif

    <div class="cong-box">
        <form action="{{ route('admin.pengajuancuti.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="form1">
                    <div class="form-1">
                        <label for="user_id">Nama</label>
                        <select name="user_id" id="user_id" required>
                            <option value="">
                                Pilih Nama Karyawan
                            </option>
                            @foreach ($users as $user)
                            @if ($user->role_id === 3)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-1">
                        <label for="id_kategori">Kategori Cuti</label>
                        <select name="id_kategori" id="id_kategori" required>
                            <option value="">
                                Pilih Kategori Cuti
                            </option>
                            @foreach ($kategori as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-ket">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" placeholder="Tuliskan Keterangan atau alasan mengambil cuti, di sini">{{ old('keterangan') }}</textarea>
                </div>
                <div class="form1">
                    <div class="form-1">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                    </div>
                    <div class="form-1">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                    </div>
                </div>
                <!-- <div>
                    <label for="file_surat">File Surat (PDF only, max 2MB):</label>
                    <input type="file" id="file_surat" name="file_surat" accept=".pdf">
                </div> -->
                <div class="button">
<<<<<<< Updated upstream
                    <button type="submit" class="btnc btn-primary btn-block" onclick="openConfirmationAddModal()">
=======
                    <button type="submit" class="button-cong" onclick="openConfirmationAddModal()">
>>>>>>> Stashed changes
                        Ajukan Cuti
                    </button>
                </div>
                
                <!-- <div class="button">
                    <button type="submit" class="btnc btn-primary btn-block" onclick="openConfirmationAddModal()">
                        Ajukan Cuti
                    </button>
                </div> -->
            </div>
        </form>
    </div>
</div>
<!-- Alert -->
<div id="alertBox" class="alert-container" style="display:none;">
    <div class="alert-content">
        <p>Mohon isi semua field sebelum menambah pengajuan cuti!</p>
        <span class="close-button" onclick="closeAlertBox()">&times;</span>
    </div>
</div>
<div id="successAlert" class="alert success" style="display:none;">
    <span class="closebtn" onclick="closeAlert()">&times;</span>
    Data berhasil ditambahkan!
</div>
@endsection

@push('addon-script')
<script>
    function openConfirmationModal() {
        // Ambil nilai dari setiap input
        var nama = document.getElementById('user_id').value;
        var kategori = document.getElementById('id_kategori').value;
        var keterangan = document.getElementById('keterangan').value;
        var mulai = document.getElementById('tanggal_mulai').value;
        var selesai = document.getElementById('tanggal_selesai').value;

        // Periksa apakah semua field tidak kosong
        if (nama.trim() !== '' || kategori.trim() !== '' || keterangan.trim() !== '' || mulai.trim() !== '' || selesai.trim() !== '') {
            // Jika semua field tidak kosong, buka modal konfirmasi
            document.getElementById('confirmationModal').style.display = 'block';
        } else {
            // Jika ada field yang kosong, berikan pesan peringatan atau tindakan lain
            // alert('Mohon isi semua field sebelum menambah data.');
            window.location.href = "{{ route('admin.pengajuancuti.index') }}";
        }
    }

    function openConfirmationAddModal() {
        // Ambil nilai dari setiap input
        var nama = document.getElementById('user_id').value;
        var kategori = document.getElementById('id_kategori').value;
        var keterangan = document.getElementById('keterangan').value;
        var mulai = document.getElementById('tanggal_mulai').value;
        var selesai = document.getElementById('tanggal_selesai').value;

        // Periksa apakah semua field tidak kosong
        if (nama.trim() !== '' && kategori.trim() !== '' && keterangan.trim() !== '' && mulai.trim() !== '' && selesai.trim() !== '') {
            // Jika semua field tidak kosong, buka modal konfirmasi
            // document.getElementById('confirmationAddModal').style.display = 'block';
        } else {
            // Jika ada field yang kosong, berikan pesan peringatan atau tindakan lain
            // alert('Mohon isi semua field sebelum menambah data.');
            document.getElementById('alertBox').style.display = 'block';
        }
    }

    function closeAlertBox() {
        // Sembunyikan alert saat tombol close diklik
        document.getElementById('alertBox').style.display = 'none';
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
@endpush