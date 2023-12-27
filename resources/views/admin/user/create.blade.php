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

    <div class="cong-box">
        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="form1">
                    <div class="form-1">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" placeholder="Tuliskan nama, di sini" value="{{ old('name') }}">
                    </div>
                    <div class="form-1">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Tuliskan Email, di sini" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form1">
                    <div class="form-1">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Tuliskan password, di sini" value="{{ old('password') }}">
                    </div>
                    <div class="form-1">
                        <label for="nip">NIP</label>
                        <input type="nip" name="nip" id="nip" placeholder="Tuliskan NIP, di sini" value="{{ old('nip') }}">
                    </div>
                </div>
                <div class="form1">
                    <div class="form-1">
                        <label for="kota">Kota</label>
                        <select name="kota" id="kota" required>
                            <option>Pilih Kota...</option>
                            @foreach ($cities as $kota) <!-- Ganti $kotas sesuai dengan variabel yang berisi data kota -->
                            <option value="{{ $kota->name }}" id="option-{{ $kota->id }}">{{ $kota->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-1">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" placeholder="Tuliskan alamat, di sini" value="{{ old('alamat') }}">
                    </div>
                </div>
                <div class="form1">
                    <div class="form-1">
                        <label for="no_hp">No Telepon</label>
                        <input type="text" name="no_hp" id="no_hp" placeholder="Tuliskan no telp, di sini" value="{{ old('no_hp') }}">
                    </div>
                    <div class="form-1">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tuliskan no telp, di sini" value="{{ old('tanggal_lahir') }}">
                    </div>
                </div>
                <div class="form1">
                    <div class="form-1">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="form-1">
                        <label for="agama">Agama</label>
                        <select name="agama" id="agama">
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
                <div class="form1">
                    <div class="form-1">
                        <label for="id_positions">Posisi</label>
                        <select name="id_positions" id="id_positions" required>
                            <option value="">
                                Pilih Posisi Karyawan
                            </option>
                            @foreach ($position as $position)
                            <option value="{{ $position->id }}">{{ $position->nama_posisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-1">
                        <label for="gaji_posisi">Gaji</label>
                        <input type="text" name="gaji_posisi" id="gaji_posisi" readonly>
                    </div>
                </div>
                <div class="form1">
                    <div class="form-1">
                        <label for="tanggal_mulai">Tanggal Mulai Kontrak Kerja</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                    </div>
                    <div class="form-1">
                        <label for="tanggal_selesai">Tanggal Selesai Kontrak Kerja</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                    </div>
                </div>
                <div class="form1">
                    <div class="form-1">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="button">
                    <button type="submit" class="button-cong">
                        Tambah Karyawan
                    </button>
                </div>
                <!-- <div class="button">
                    <button type="submit" class="btnc btn-primary btn-block">
                        Tambah Karyawan
                    </button>
                </div> -->
            </div>
        </form>
    </div>
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