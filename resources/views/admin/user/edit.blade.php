@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <a href="{{ route('admin.user.index') }}"><i class="fa fa-angle-left"></i></a>
        <h3>Ubah User {{ $item->nama }}</h3>
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
        <form action="" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="content">
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Nama</h5>
                        <input type="text" name="name" id="name" class="date" placeholder="Tuliskan nama, di sini" value="{{ $item->name }}">
                    </div>
                    <div class="tgl1">
                        <h5>Email</h5>
                        <input type="email" name="email" id="email" class="date" placeholder="Tuliskan Email, di sini" value="{{$item->email}}">
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Password</h5>
                        <input type="password" name="password" id="password" class="date" placeholder="Tuliskan password, di sini" value="">
                    </div>
                    <div class="tgl1">
                        <h5>NIP</h5>
                        <input type="nip" name="nip" id="nip" class="date" placeholder="Tuliskan NIP, di sini" value="{{ $item->nip }}">
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Kota</h5>
                        <select name="kota" id="kota" required class="form-control1">
                            <option value="{{$item -> jenis_kelamin}}">{{$item->kota}}</option>
                            @foreach ($cities as $kota) <!-- Ganti $kotas sesuai dengan variabel yang berisi data kota -->
                            <option value="{{ $kota->name }}" id="option-{{ $kota->name }}">{{ $kota->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="tgl1">
                        <h5>Alamat</h5>
                        <input type="text" name="alamat" id="alamat " class="date" placeholder="Tuliskan alamat, di sini" value="{{$item -> alamat }}">
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>No Telepon</h5>
                        <input type="text" name="no_hp" id="no_hp" class="date" placeholder="Tuliskan no telp, di sini" value="{{ $item -> no_hp}}">
                    </div>
                    <!-- <div id="gaji"></div> -->
                    <div class="tgl1">
                        <h5>Jenis Kelamin</h5>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="date">
                            <option value="{{$item -> jenis_kelamin}}">{{$item -> jenis_kelamin}}</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal Lahir</h5>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="date" placeholder="Tuliskan no telp, di sini" value="{{ $item -> tanggal_lahir}}">
                    </div>
                    <div class="tgl1">
                        <h5>Agama</h5>
                        <select name="agama" id="agama" class="date">
                            <option value="{{$item -> agama}}">{{$item -> agama}}</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="tgl">
                    <div>
                        <label for="id_positions">Posisi:</label>
                        <select name="id_positions" id="id_positions">
                            @foreach ($positions as $position)
                            <option value="{{ $position->id }}" data-gaji="{{ $position->gaji_posisi }}" {{ $item->id_positions == $position->id ? 'selected' : '' }}>
                                {{ $position->nama_posisi }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="tgl1">
                        <h5>Gaji</h5>
                        <input type="text" name="gaji_posisi" id="gaji_posisi" class="date gaji_posisi" value="{{ $item->gaji_posisi }}" readonly>
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal Mulai Kontrak Kerja</h5>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{$item->tanggal_mulai }}">
                    </div>
                    <div class="tgl1">
                        <h5>Tanggal Selesai Kontrak Kerja</h5>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="date" value="{{$item->tanggal_selesai }}">
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Role</h5>
                        <select name="role_id" class="date">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="tgl1">
                        <h5>Jumlah Cuti tersedia</h5>
                        <input type="text" value="{{$item -> jmlCuti}}" class="date" readonly>
                    </div>
                </div>
                <div class="button">
                    <button type="submit" class="btnc btn-primary btn-block">
                        Ubah User
                    </button>
                </div>
        </form>

        @endsection

        @push('addon-script')
        <script type="text/javascript" src="{{ asset('admin/js/jquery-1.10.2.js') }}"></script>
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).ready(function() {
                    $('#id_positions').on('change', function() {
                        var selectedGaji = $(this).find(':selected').data('gaji');

                        // Format the salary as Indonesian Rupiah
                        var formattedSalary = 'Rp.' + selectedGaji.toLocaleString('id-ID');

                        // Update the salary value in the input field
                        $('#gaji_posisi').val(formattedSalary);

                        // Additionally, update a hidden field with the selected ID if required
                        var selectedID = $(this).val();
                        $('#hidden_position_id').val(selectedID);
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