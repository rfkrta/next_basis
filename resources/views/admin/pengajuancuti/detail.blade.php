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

    <div class="cong-box">
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="form1">
                    <div class="form-1">
                        <label for="user_id">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ $item->user->name }}" readonly>
                    </div>
                    <div class="form-1">
                        <label for="id_kategori">Kategori Cuti</label>
                        <input type="text" name="kategori" id="kategori" value="{{ $item->kategori->nama_kategori }}" readonly>
                    </div>
                </div>
                <div class="form-ket">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" readonly>{{ $item->keterangan }}</textarea>
                </div>
                <div class="form1">
                    <div class="form-1">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ $item->tanggal_mulai }}" readonly>
                    </div>
                    <div class="form-1">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ $item->tanggal_selesai }}" readonly>
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