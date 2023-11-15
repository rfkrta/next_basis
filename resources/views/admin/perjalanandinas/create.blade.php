@extends('head')

@section('content')
    <div class="main">
        <div class="main-top1">
            <a href="{{ route('admin.perjalanandinas.index') }}"><i class="fa fa-angle-left"></i></a>
            <h3>Tambah Perjalanan Dinas</h3>
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
            <form action="{{ route('admin.perjalanandinas.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <h5>Perusahaan</h5>
                    <div class="form-group">
                        <select name="id" id="id" required class="form-control">
                            <option value="">
                                Pilih Perusahaan
                            </option>
                        @foreach ($mitra as $mitra)
                            <option value="{{ $mitra->id }}">{{ $mitra->nama_mitra }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Kota Keberangkatan</h5>
                            <input type="text" name="kota" id="kota" class="date" placeholder="Tuliskan kota keberangkatan, di sini" value="{{ old('kota') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Komisi</h5>
                            <input type="text" name="komisi" id="komisi" class="date" placeholder="" value="{{ old('komisi') }}">
                        </div>
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
                    <h5 class="tim1">Tim</h5>
                    <div class="tim">
                        <div class="form-group1">
                            <select name="id" id="id" required class="form-control1">
                                <option value="">
                                    Pilih anggota 1
                                </option>
                            @foreach ($karyawan as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                            @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <!-- <div class="button">
                        <button type="button" class="btnx btn-primary btn-block">
                            Tambah Anggota
                        </button>
                    </div> -->
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>PIC Perusahaan</h5>
                            <input type="text" name="pic_perusahaan" id="pic_perusahaan" class="date" placeholder="Tuliskan PIC perusahaan, di sini" value="{{ old('pic_perusahaan') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Jabatan PIC</h5>
                            <input type="text" name="jabatan_pic" id="jabatan_pic" class="date" placeholder="Tuliskan jabatan PIC perusahaan, di sini" value="{{ old('jabatan_pic') }}">
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" class="btny1 btn-primary btn-block">
                            Ajukan Dinas
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection