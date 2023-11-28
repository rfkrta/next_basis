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

    <div class="cong-box1">
        <form action="" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="content">
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Nama</h5>
                        <input type="text" name="name" id="name" class="date" placeholder="Tuliskan nama, di sini" value="{{ $item->name }}">
                    </div>
                    <!-- <div id="gaji"></div> -->
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
                    <!-- <div id="gaji"></div> -->
                    <div class="tgl1">
                        <h5>NIP</h5>
                        <input type="nip" name="nip" id="nip" class="date" placeholder="Tuliskan NIP, di sini" value="{{ $item->nip }}">
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
                <div class="button">
                    <button type="submit" class="btnc btn-primary btn-block">
                        Ubah User
                    </button>
                </div>
        </form>

        @endsection

        @push('addon-script')
        <script type="text/javascript" src="{{ asset('admin/js/jquery-1.10.2.js') }}"></script>
        <!-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script> -->
        <!-- <script type="text/javascript">
        $("#id_positions").change(function() {
            var id_positions = $("#id_positions").val();
            $.ajax({
                type: "GET",
                url: "/karyawan/ajax",
                data: "id_positions="+id_positions,
                cache: false,
                success: function(data){
                    $("#position").html(data);
                }
            });
        });
    </script> -->
        @endpush