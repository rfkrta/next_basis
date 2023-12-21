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

    <div class="cong-box2">
        <form action="{{ route('admin.pengajuancuti.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="tglx">
                    <div class="tgl1">
                        <h5>Nama</h5>
                        <!-- <input type="text" name="nama" id="nama" class="date" placeholder="Tuliskan nama, di sini" value="{{ old('nama') }}"> -->
                        <div class="form-group1">
                            <select name="user_id" id="user_id" required class="form-control1">
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
                    </div>
                    <div class="tgl1">
                        <h5>Kategori Cuti</h5>
                        <!-- <input type="text" name="kategori" id="kategori" class="date" placeholder="Tuliskan kategori, di sini" value="{{ old('kategori') }}"> -->
                        <div class="form-group1">
                            <select name="id_kategori" id="id_kategori" required class="form-control1">
                                <option value="">
                                    Pilih Kategori Cuti
                                </option>
                                @foreach ($kategori as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="keter">
                    <h5>Keterangan</h5>
                    <textarea name="keterangan" id="keterangan" placeholder="Tuliskan Keterangan atau alasan mengambil cuti, di sini">{{ old('keterangan') }}</textarea>
                    <!-- cols="122" rows="5" -->
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
                <!-- <div>
                    <label for="file_surat">File Surat (PDF only, max 2MB):</label>
                    <input type="file" id="file_surat" name="file_surat" accept=".pdf">
                </div> -->
                <div class="button">
                    <button type="submit" class="btnc btn-primary btn-block" onclick="openConfirmationAddModal()">
                        Ajukan Cuti
                    </button>
                </div>
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