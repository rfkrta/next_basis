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
                    <div class="form1">
                        <div class="form-1">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" placeholder="Tuliskan nama, di sini" value="{{ $item->name }}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Tuliskan Email, di sini" value="{{$item->email}}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Tuliskan password, di sini" value="" readonly>
                        </div>
                        <div class="form-1">
                            <label for="nip">NIP</label>
                            <input type="nip" name="nip" id="nip" placeholder="Tuliskan NIP, di sini" value="{{ $item->nip }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="kota">Kota</label>
                            <input type="text" name="kota" id="kota" value="{{ $item->kota }}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat " placeholder="Tuliskan alamat, di sini" value="{{$item -> alamat }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="no_hp">No Telepon</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="Tuliskan no telp, di sini" value="{{ $item -> no_hp}}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input type="text" name="jenis_kelamin" id="jenis_kelamin" value="{{ $item->jenis_kelamin }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tuliskan no telp, di sini" value="{{ $item -> tanggal_lahir}}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="agama">Agama</label>
                            <input type="text" name="agama" id="agama" value="{{ $item->agama }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="id_positions">Posisi</label>
                            <select name="id_positions" id="id_positions" readonly>
                                @foreach ($positions as $position)
                                <option value="{{ $position->id }}" data-gaji="{{ $position->gaji_posisi }}" {{ $item->id_positions == $position->id ? 'selected' : '' }}>
                                    {{ $position->nama_posisi }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-1">
                            <label for="gaji_posisi">Gaji</label>
                            <input type="text" name="gaji_posisi" id="gaji_posisi" value="{{ $item->gaji_posisi }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="tanggal_mulai">Tanggal Mulai Kontrak Kerja</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{$item->tanggal_mulai }}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="tanggal_selesai">Tanggal Selesai Kontrak Kerja</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{$item->tanggal_selesai }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="role_id">Role</label>
                            <select name="role_id" readonly>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $item->role_id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-1">
                            <label for="jmlCuti">Jumlah Cuti tersedia</label>
                            <input type="text" name="jmlCuti" id="jmlCuti" value="{{$item -> jmlCuti}}" readonly>
                        </div>
                    </div>
                    <!-- Tambahkan field untuk menampilkan hasil gaji -->
                    <div class="form1">
                        <div class="form-1">
                            <label for="gaji_bulanan">Gaji Bulanan</label>
                            <input type="number" name="gaji_bulanan" id="gaji_bulanan" value="{{ isset($item->gaji_bulanan) ? $item->gaji_bulanan : 'Belum dihitung' }}" readonly>
                        </div>
                    </div>
                    <!-- <div>
                        <strong>Gaji Bulanan: </strong> {{ isset($item->gaji_bulanan) ? $item->gaji_bulanan : 'Belum dihitung' }}
                    </div> -->
                </div>
            </form>
            <!-- <form action="{{ route('admin.user.hitungGaji', ['id' => $item->id]) }}" method="POST" class="content1">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="button2">
                    <button type="submit" class="button-cong2">
                        Reset Cuti
                    </button>
                </div>
            </form> -->
            <form action="{{ route('admin.user.hitungGaji', ['id' => $item->id]) }}" method="POST" class="content1">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="button">
                    <button type="submit" class="button-cong">
                        Hitung Gaji
                    </button>
                </div>
                <!-- <button type="submit" class="btnc btn-primary">
                    Hitung Gaji
                </button> -->
            </form>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script type="text/javascript" src="{{ asset('admin/js/jquery-1.10.2.js') }}"></script>
@endpush