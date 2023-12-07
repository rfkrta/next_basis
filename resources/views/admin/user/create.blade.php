@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <a href="{{ route('admin.user.index') }}"><i class="fa fa-angle-left"></i></a>
        <h3>Tambah User</h3>
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

<<<<<<< Updated upstream
    <div class="cong-box1">
=======
    <div class="cong-box4">
>>>>>>> Stashed changes
        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Nama</h5>
                        <input type="text" name="name" id="name" class="date" placeholder="Tuliskan nama, di sini" value="">
                    </div>
                    <!-- <div id="gaji"></div> -->
                    <div class="tgl1">
                        <h5>Email</h5>
                        <input type="email" name="email" id="email" class="date" placeholder="Tuliskan Email, di sini" value="">
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Password</h5>
                        <input type="password" name="password" id="password" class="date" placeholder="Tuliskan password, di sini" value="">
                    </div>
                    <!-- <div id="gaji"></div> -->
                    <div class="tgl1">
                        <h5>NIP</h5>
                        <input type="nip" name="nip" id="nip" class="date" placeholder="Tuliskan NIP, di sini" value="{{ old('nip') }}">
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Kota</h5>
                        <select name="kota" id="kota" required class="form-control1">
                            <option>Pilih Kota...</option>
                            @foreach ($cities as $kota) <!-- Ganti $kotas sesuai dengan variabel yang berisi data kota -->
                            <option value="{{ $kota->id }}" id="option-{{ $kota->id }}">{{ $kota->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div id="gaji"></div> -->
                    <div class="tgl1">
                        <h5>Alamat</h5>
                        <input type="text" name="alamat" id="alamat " class="date" placeholder="Tuliskan alamat, di sini" value="{{ old('alamat') }}">
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>No Telepon</h5>
                        <input type="text" name="no_hp" id="no_hp" class="date" placeholder="Tuliskan no telp, di sini" value="{{ old('no_hp') }}">
                    </div>
                    <!-- <div id="gaji"></div> -->
                    <div class="tgl1">
                        <h5>Jenis Kelamin</h5>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="date">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal Lahir</h5>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="date" placeholder="Tuliskan no telp, di sini" value="{{ old('tanggal_lahir') }}">
                    </div>
                    <!-- <div id="gaji"></div>
                    <div class="tgl1">
                        <h5>Status</h5>
                        <input type="status" name="status" id="status" class="date" placeholder="Pilih Status, di sini">
                    </div> -->
                    <div class="tgl1">
                        <h5>Agama</h5>
                        <select name="agama" id="agama" class="date">
                            <option value="">Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>


                </div>
                <div class="button">
                    <button type="button" class="btnc btn-primary btn-block">
                        Tambah Karyawan
                    </button>
                </div>
            </div>
        </form>
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

    document.addEventListener("DOMContentLoaded", function() {
        const selectElement = document.getElementById('kota');

        selectElement.addEventListener('click', function() {
            this.focus();
        });

        selectElement.addEventListener('keydown', function(e) {
            const key = e.key.toLowerCase();
            const options = Array.from(this.options);

            const findOptionByLetter = (startIndex) => {
                for (let i = startIndex; i < options.length; i++) {
                    const optionText = options[i].textContent.toLowerCase();
                    if (optionText.startsWith(key)) {
                        return i;
                    }
                }
                return -1;
            };

            let startIndex = this.selectedIndex + 1;
            if (startIndex >= options.length) {
                startIndex = 0;
            }

            const index = findOptionByLetter(startIndex);
            if (index !== -1) {
                this.selectedIndex = index;
            }
        });
    });
</script>

@endpush
<!-- <div class="form-group">
                        <h5>NIP</h5>
                        <input type="nip" class="form-control" name="nip" required>
                    </div>
                    <div class="form-group">
                        <h5>Kota</h5>
                        <input type="kota" class="form-control" name="kota" required>
                    </div>
                    <div class="form-group">
                        <h5>Tanggal Lahir</h5>
                        <input type="tgllahir" class="form-control" name="tgllahir" required>
                    </div>
                    <div class="form-group">
                        <h5>No Telepon</h5>
                        <input type="notelp" class="form-control" name="notelp" required>
                    </div>
                    <div class="form-group">
                        <h5>Alamat</h5>
                        <input type="alamat" class="form-control" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <h5>Jenis Kelamin</h5>
                        <input type="jk" class="form-control" name="jk" required>
                    </div>
                    <div class="form-group">
                        <h5>Status</h5>
                        <input type="status" class="form-control" name="status" required>
                    </div>
                    <div class="form-group">
                        <h5>Profile Photo</h5>
                        <input type="file" class="form-control-file" name="profile_photo">
                    </div> -->