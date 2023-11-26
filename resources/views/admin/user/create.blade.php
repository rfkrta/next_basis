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

    <div class="cong-box2">
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
                        <input type="text" name="kota" id="kota" class="date" placeholder="Tuliskan kota, di sini" value="">
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
                        <input type="jk" name="jk" id="jk" class="date" placeholder="Pilih Jenis Kelamin, di sini">
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
                    <button type="submit" class="btnc btn-primary btn-block">
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