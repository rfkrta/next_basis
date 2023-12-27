@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <button type="button" class="btnclass btn-primary" onclick="openConfirmationModal()">
            <i class="fa fa-angle-left"></i>
        </button>
        <!-- <a href="{{ route('admin.mitra.index') }}"><i class="fa fa-angle-left"></i></a> -->
        <h3>Tambah Mitra Perusahaan</h3>
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
        <form action="{{ route('admin.mitra.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <!-- <div class="tglx"> -->
                    <div class="form1">
                        <div class="form-1">
                            <label for="nama_mitra">Nama Perusahaan</label>
                            <input type="text" name="nama_mitra" id="nama_mitra" placeholder="Tuliskan nama perusahaan, di sini" value="{{ old('nama_mitra') }}" required>
                        </div>
                        <div class="form-1">
                            <label for="provinsi">Provinsi</label>
                            <select name="provinsi" id="provinsi" required required>
                                <option>
                                    Pilih Provinsi...
                                </option>
                                @foreach ($provinces->sortBy('name')  as $provinsi)
                                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="kota">Kabupaten / Kota</label>
                            <select name="kota" id="kota" required>
                                <option>
                                    Pilih Kabupaten / Kota...
                                </option>
                            
                            </select>
                        </div>
                        <div class="form-1">
                            <label for="kecamatan">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" required>
                                <option>
                                    Pilih Kecamatan...
                                </option>
                            
                            </select>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="kelurahan">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" required>
                                <option> 
                                    Pilih Kelurahan / Desa...
                                </option>
                            
                            </select>
                        </div>
                        <div class="form-1">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" placeholder="Tuliskan kode pos, di sini" value="{{ old('kode_pos') }}" required>
                        </div>
                    </div>
                    <div class="form-ket">
                        <label for="alamat_lengkap">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" id="alamat_lengkap" placeholder="Tuliskan alamat lengkap, di sini" required>{{ old('alamat_lengkap') }}</textarea>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="nama_PIC_perusahaan">PIC Perusahaan</label>
                            <input type="text" name="nama_PIC_perusahaan" id="nama_PIC_perusahaan" placeholder="Tuliskan PIC perusahaan, di sini" value="{{ old('nama_PIC_perusahaan') }}" required>
                        </div>
                        <div class="form-1">
                            <label for="jabatan_PIC">Jabatan PIC</label>
                            <input type="text" name="jabatan_PIC" id="jabatan_PIC" placeholder="Tuliskan jabatan PIC, di sini" value="{{ old('jabatan_PIC') }}" required>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="nomer_telepon_PIC">Nomor PIC</label>
                            <input type="text" name="nomer_telepon_PIC" id="nomer_telepon_PIC" placeholder="Tuliskan nomor PIC, di sini" value="{{ old('nomer_telepon_PIC') }}" required>
                        </div>
                        <div class="form-1">
                            <label for="komisi_dinas">Komisi Perjalanan Dinas</label>
                            <input type="text" name="komisi_dinas" id="komisi_dinas" placeholder="Tuliskan komisi perjalanan dinas, di sini" value="{{ old('komisi_dinas') }}" required>
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" class="button-cong" onclick="openConfirmationAddModal()">
                            Tambah Mitra
                        </button>
                    </div>
                    <!-- <div class="button">
                        <button type="submit" class="btny1x btn-primary btn-block" onclick="openConfirmationAddModal()">
                            Tambah Mitra
                        </button>
                    </div> -->
                <!-- </div> -->
            </div>
        </form>
    </div>

<!-- resources/views/confirmation-modal.blade.php -->
<div id="confirmationModal" class="modal-container" style="display:none;">
    <div class="confirmation-container">
        <h2>Keluar Halaman ?</h2>
        <p>Kamu akan membatalkan perubahan
            tambah mitra. Semua perubahan
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
        <p>Apakah mitra
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
        <p>Mohon isi semua field sebelum menambah mitra!</p>
        <span class="close-button" onclick="closeAlertBox()">&times;</span>
    </div>
</div>
@endsection

@push('addon-script')
<script type="text/javascript" src="{{ url('admin/js/jquery-1.10.2.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('#provinsi').on('change', function() {
                let id_provinsi = $('#provinsi').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('getkota') }}",
                    data: {
                        id_provinsi: id_provinsi
                    },
                    cache: false,

                    success: function(msg) {
                        $('#kota').html(msg);
                        $('#kecamatan').html('');
                        $('#kelurahan').html('');
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },
                })
            })
        })

        $(function() {
            $('#kota').on('change', function() {
                let id_kota = $('#kota').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('getkecamatan') }}",
                    data: {
                        id_kota: id_kota
                    },
                    cache: false,

                    success: function(msg) {
                        // Get options, sort them, and re-add in ascending order
                        var kotaSelect = $('#kota');
                        var options = kotaSelect.find('option');
                        var arr = options.map(function(_, option) {
                            return {
                                value: option.value,
                                text: option.text
                            };
                        }).get();

                        arr.sort(function(a, b) {
                            return a.text.localeCompare(b.text);
                        });

                        kotaSelect.empty(); // Clear existing options

                        $.each(arr, function(_, sortedOption) {
                            kotaSelect.append($('<option>', {
                                value: sortedOption.value,
                                text: sortedOption.text
                            }));
                        });

                        // Perform further actions as needed
                        $('#kecamatan').html(msg);
                        $('#kelurahan').html('');
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },
                })
            })
        })


        $(function() {
            $('#kecamatan').on('change', function() {
                let id_kecamatan = $('#kecamatan').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('getkelurahan') }}",
                    data: {
                        id_kecamatan: id_kecamatan
                    },
                    cache: false,

                    success: function(msg) {
                        $('#kelurahan').html(msg);
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },
                })
            })
        })

    });

    function openConfirmationModal() {
        // Ambil nilai dari setiap input
        var nama = document.getElementById('nama_mitra').value;
        var provinsi = document.getElementById('provinsi').value;
        var kode = document.getElementById('kode_pos').value;
        var alamat = document.getElementById('alamat_lengkap').value;
        var pic = document.getElementById('nama_PIC_perusahaan').value;
        var jabatan = document.getElementById('jabatan_PIC').value;
        var nomer = document.getElementById('nomer_telepon_PIC').value;
        var komisi = document.getElementById('komisi_dinas').value;

        // Periksa apakah semua field tidak kosong
        if (nama.trim() !== '' || provinsi.trim() !== '' || kode.trim() !== '' || alamat.trim() !== '' || pic.trim() !== '' || jabatan.trim() !== '' || nomer.trim() !== '' || komisi.trim() !== '') {
            // Jika semua field tidak kosong, buka modal konfirmasi
            document.getElementById('confirmationModal').style.display = 'block';
        } else {
            // Jika ada field yang kosong, berikan pesan peringatan atau tindakan lain
            // alert('Mohon isi semua field sebelum menambah data.');
            window.location.href = "{{ route('admin.mitra.index') }}";
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
        window.location.href = "{{ route('admin.mitra.index') }}";
    }

    function openConfirmationAddModal() {
        // Ambil nilai dari setiap input
        var nama = document.getElementById('nama_mitra').value;
        var provinsi = document.getElementById('provinsi').value;
        var kode = document.getElementById('kode_pos').value;
        var alamat = document.getElementById('alamat_lengkap').value;
        var pic = document.getElementById('nama_PIC_perusahaan').value;
        var jabatan = document.getElementById('jabatan_PIC').value;
        var nomer = document.getElementById('nomer_telepon_PIC').value;
        var komisi = document.getElementById('komisi_dinas').value;

        // Periksa apakah semua field tidak kosong
        if (nama.trim() !== '' && provinsi.trim() !== '' && kode.trim() !== '' && alamat.trim() !== '' && pic.trim() !== '' && jabatan.trim() !== '' && nomer.trim() !== '' && komisi.trim() !== '') {
            //Jika semua field tidak kosong, buka modal konfirmasi
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
        window.location.href = "{{ route('admin.mitra.store') }}";
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