@extends('head')

@section('content')
    <div class="main">
        <div class="main-top1">
            <a href="{{ route('admin.pengajuancuti.index') }}"><i class="fa fa-angle-left"></i></a>
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

        <div class="cong-box2">
            <form action="{{ route('admin.pengajuancuti.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <div class="tglx">
                    <div class="tgl1">
                            <h5>Nama</h5>
                            <!-- <input type="text" name="nama" id="nama" class="date" placeholder="Tuliskan nama, di sini" value="{{ old('nama') }}"> -->
                            <div class="form-group1">
                                <select name="id_nama" id="id_nama" required class="form-control1">
                                    <option value="">
                                        Pilih Nama Karyawan
                                    </option>
                                @foreach ($karyawan as $karyawan)
                                    <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
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
                    <div class="button">
                        <button type="submit" class="btn1 btn-primary btn-block">
                            Ajukan Cuti
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection