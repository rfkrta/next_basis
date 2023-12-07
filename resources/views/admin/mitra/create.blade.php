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

        <div class="cong-box4">
            <form action="{{ route('admin.mitra.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <div class="tglx">
                        <div class="tgl1">
                            <h5>Nama Perusahaan</h5>
                            <input type="text" name="nama_mitra" id="nama_mitra" class="date" placeholder="Tuliskan nama perusahaan, di sini" value="{{ old('nama_mitra') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Provinsi</h5>
                            <div class="form-group1">
                                <select name="provinsi" id="provinsi" required class="form-control1">
                                    <option>
                                        Pilih Provinsi...
                                    </option>
                                @foreach ($provinces as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <!-- <input type="text" name="provinsi" id="provinsi" class="date" placeholder="Tuliskan nama provinsi, di sini" value="{{ old('provinsi') }}"> -->
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Kabupaten / Kota</h5>
                            <div class="form-group1">
                                <select name="kota" id="kota" required class="form-control1">
                                    <option>
                                        Pilih Kabupaten / Kota...
                                    </option>
                                
                                </select>
                            </div>
                            <!-- <input type="text" name="kota" id="kota" class="date" placeholder="Tuliskan nama kabupaten atau kota, di sini" value="{{ old('kota') }}"> -->
                        </div>
                        <div class="tgl1">
                            <h5>Kecamatan</h5>
                            <div class="form-group1">
                                <select name="kecamatan" id="kecamatan" required class="form-control1">
                                    <option>
                                        Pilih Kecamatan...
                                    </option>
                                
                                </select>
                            </div>
                            <!-- <input type="text" name="kecamatan" id="kecamatan" class="date" placeholder="Tuliskan nama kecamatan, di sini" value="{{ old('kecamatan') }}"> -->
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Kelurahan</h5>
                            <div class="form-group1">
                                <select name="kelurahan" id="kelurahan" required class="form-control1">
                                    <option> 
                                        Pilih Kelurahan / Desa...
                                    </option>
                                
                                </select>
                            </div>
                            <!-- <input type="text" name="kelurahan" id="kelurahan" class="date" placeholder="Tuliskan nama kelurahan, di sini" value="{{ old('kelurahan') }}"> -->
                        </div>
                        <div class="tgl1">
                            <h5>Kode Pos</h5>
                            <input type="text" name="kode_pos" id="kode_pos" class="date" placeholder="Tuliskan kode pos, di sini" value="{{ old('kode_pos') }}">
                        </div>
                    </div>
                    <div class="keter">
                        <h5>Alamat Lengkap</h5>
                        <textarea name="alamat_lengkap" id="alamat_lengkap" cols="122" rows="5" placeholder="Tuliskan alamat lengkap, di sini">{{ old('alamat_lengkap') }}</textarea>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>PIC Perusahaan</h5>
                            <input type="text" name="nama_PIC_perusahaan" id="nama_PIC_perusahaan" class="date" placeholder="Tuliskan PIC perusahaan, di sini" value="{{ old('nama_PIC_perusahaan') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Jabatan PIC</h5>
                            <input type="text" name="jabatan_PIC" id="jabatan_PIC" class="date" placeholder="Tuliskan jabatan PIC, di sini" value="{{ old('jabatan_PIC') }}">
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Nomor PIC</h5>
                            <input type="text" name="nomer_telepon_PIC" id="nomer_telepon_PIC" class="date" placeholder="Tuliskan nomor PIC, di sini" value="{{ old('nomer_telepon_PIC') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Komisi Perjalanan Dinas</h5>
                            <input type="text" name="komisi_dinas" id="komisi_dinas" class="date" placeholder="Tuliskan komisi perjalanan dinas, di sini" value="{{ old('komisi_dinas') }}">
                        </div>
                    </div>
                    <div class="button">
<<<<<<< Updated upstream
                        <button type="submit" class="btny1x btn-primary btn-block" onclick="openConfirmationAddModal()">
=======
                        <button type="button" class="btny1x btn-primary btn-block" onclick="openConfirmationAddModal()">
>>>>>>> Stashed changes
                            Tambah Mitra
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
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function (){
                $('#provinsi').on('change',function(){
                    let id_provinsi = $('#provinsi').val();

                    $.ajax({
                        type : 'POST',
                        url : "{{ route('getkota') }}",
                        data : {id_provinsi:id_provinsi},
                        cache : false,

                        success : function(msg){
                            $('#kota').html(msg);
                            $('#kecamatan').html('');
                            $('#kelurahan').html('');
                        },
                        error : function(data){
                            console.log('error:',data)
                        },
                    })
                })
            })

            $(function (){
                $('#kota').on('change',function(){
                    let id_kota = $('#kota').val();

                    $.ajax({
                        type : 'POST',
                        url : "{{ route('getkecamatan') }}",
                        data : {id_kota:id_kota},
                        cache : false,

                        success : function(msg){
                            $('#kecamatan').html(msg);
                            $('#kelurahan').html('');
                        },
                        error : function(data){
                            console.log('error:',data)
                        },
                    })
                })
            })

            $(function (){
                $('#kecamatan').on('change',function(){
                    let id_kecamatan = $('#kecamatan').val();

                    $.ajax({
                        type : 'POST',
                        url : "{{ route('getkelurahan') }}",
                        data : {id_kecamatan:id_kecamatan},
                        cache : false,

                        success : function(msg){
                            $('#kelurahan').html(msg);
                        },
                        error : function(data){
                            console.log('error:',data)
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