@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <a href="{{ route('admin.user.index') }}"><i class="fa fa-angle-left"></i></a>
        <h3>Detail User {{ $item->name }}</h3>
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
        <div class="base">
            <form action="" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="content">
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Nama</h5>
                            <input type="text" name="name" id="name" class="date" placeholder="Tuliskan nama, di sini" value="{{ $item->name }}" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Email</h5>
                            <input type="email" name="email" id="email" class="date" placeholder="Tuliskan Email, di sini" value="{{$item->email}}" readonly>
                        </div>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Password</h5>
                            <input type="password" name="password" id="password" class="date" placeholder="Tuliskan password, di sini" value="" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>NIP</h5>
                            <input type="nip" name="nip" id="nip" class="date" placeholder="Tuliskan NIP, di sini" value="{{ $item->nip }}" readonly>
                        </div>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Kota</h5>
                            <select name="kota" id="kota" class="date" readonly>
                                <option value="{{$item -> kota}}">{{$item->kota}}</option>
                                @foreach ($cities as $kota) <!-- Ganti $kotas sesuai dengan variabel yang berisi data kota -->
                                <option value="{{ $kota->name }}" id="option-{{ $kota->name }}">{{ $kota->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="tgl1">
                            <h5>Alamat</h5>
                            <input type="text" name="alamat" id="alamat " class="date" placeholder="Tuliskan alamat, di sini" value="{{$item -> alamat }}" readonly>
                        </div>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>No Telepon</h5>
                            <input type="text" name="no_hp" id="no_hp" class="date" placeholder="Tuliskan no telp, di sini" value="{{ $item -> no_hp}}" readonly>
                        </div>
                        <!-- <div id="gaji"></div> -->
                        <div class="tgl1">
                            <h5>Jenis Kelamin</h5>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="date" readonly>
                                <option value="{{$item -> jenis_kelamin}}">{{$item -> jenis_kelamin}}</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Tanggal Lahir</h5>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="date" placeholder="Tuliskan no telp, di sini" value="{{ $item -> tanggal_lahir}}" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Agama</h5>
                            <select name="agama" id="agama" class="date" readonly>
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
                            <h5>Posisi</h5>
                            <select name="id_positions" id="id_positions" class = "date" readonly>
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
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{$item->tanggal_mulai }}" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Tanggal Selesai Kontrak Kerja</h5>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="date" value="{{$item->tanggal_selesai }}" readonly>
                        </div>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Role</h5>
                            <select name="role_id" class="date" readonly>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $item->role_id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="tgl1">
                            <h5>Jumlah Cuti tersedia</h5>
                            <input type="text" value="{{$item -> jmlCuti}}" class="date" readonly>
                        </div>
                    </div>
                    <!-- Tambahkan field untuk menampilkan hasil gaji -->
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Gaji Bulanan</h5>
                            <input type="number" value="{{ isset($item->gaji_bulanan) ? $item->gaji_bulanan : 'Belum dihitung' }}" class="date" readonly>
                        </div>
                    </div>
                    <!-- <div>
                        <strong>Gaji Bulanan: </strong> {{ isset($item->gaji_bulanan) ? $item->gaji_bulanan : 'Belum dihitung' }}
                    </div> -->
                </div>
            </form>

            <form action="{{ route('admin.user.hitungGaji', ['id' => $item->id]) }}" method="POST" class="content1">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button type="submit" class="btnc btn-primary">
                    Hitung Gaji
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script type="text/javascript" src="{{ asset('admin/js/jquery-1.10.2.js') }}"></script>
@endpush