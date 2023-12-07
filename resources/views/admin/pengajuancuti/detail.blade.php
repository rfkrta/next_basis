@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <a href="{{ route('admin.pengajuancuti.index') }}"><i class="fa fa-angle-left"></i></a>
        <h3>Pengajuan Cuti {{ $item->user->name }}</h3>
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
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="tglx">
                    <div class="tgl1">
                        <h5>Nama</h5>
                        <input type="text" name="nama" id="nama" class="date" placeholder="Tuliskan nama, di sini" value="{{ $item->user->name }}">
                        <!-- <div class="form-group1">
                                <select name="status" required class="form-control1">
                                    <option value="">
                                        Pilih Nama Karyawan
                                    </option>
                                    <option value="">Budi</option>
                                    <option value="">Yanto</option>
                                </select>
                            </div> -->
                    </div>
                    <div class="tgl1">
                        <h5>Kategori Cuti</h5>
                        <input type="text" name="kategori" id="kategori" class="date" placeholder="Tuliskan kategori, di sini" value="{{ $item->kategori->nama_kategori }}">
                        <!-- <div class="form-group1">
                                <select name="status" required class="form-control1">
                                    <option value="">
                                        Pilih Kategori Cuti
                                    </option>
                                    <option value="">Cuti Tahunan</option>
                                    <option value="">Cuti Kehamilan</option>
                                </select>
                            </div> -->
                    </div>
                </div>
                <div class="keter">
                    <h5>Keterangan</h5>
                    <textarea name="keterangan" id="keterangan" placeholder="Tuliskan Keterangan atau alasan mengambil cuti, di sini">{{ $item->keterangan }}</textarea>
                    <!-- cols="122" rows="5" -->
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal Mulai</h5>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{ $item->tanggal_mulai }}">
                    </div>
                    <div class="tgl1">
                        <h5>Tanggal Selesai</h5>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="date" value="{{ $item->tanggal_selesai }}">
                    </div>
                </div>
                @if($item->file_surat)
                <div class="file-info">
                    <h5>File Surat</h5>
                    <a href="{{ Storage::url('public/surat/' . $item->file_surat) }}" target="_blank">Lihat Surat</a>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection