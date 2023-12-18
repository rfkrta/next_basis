@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <a href="{{ route('admin.absensi.index') }}"><i class="fa fa-angle-left"></i></a>
        <h3>Detail Absen {{ $item->nama }}</h3>
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
            @csrf
            <div class="content">
                <div class="nama">
                    <h5>Nama</h5>
                    <input type="text" name="nama" id="nama" class="input2" placeholder="Tuliskan nama karyawan, di sini" value="{{ $item->user->name }}" readonly>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal</h5>
                        <input type="text" name="tanggal_absensi" id="tanggal_absensi" class="date" value="{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}" readonly>
                    </div>
                    <div class="tgl1">
                        <h5>Kategori</h5>
                        <input type="text" name="kategori" id="kategori" class="date" value="{{$item->kategoriAbsensi->nama_kategori}}" readonly>
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Waktu Masuk</h5>
                        <input type="text" name="Waktu Masuk" id="Waktu Masuk" class="date" placeholder="Tuliskan NIP, di sini" value="{{ date('H:i', strtotime($item->waktu_mulai)) }}" readonly>
                    </div>
                    <div class="tgl1">
                        <h5>Waktu Pulang</h5>
                        <input type="text" name="Waktu Pulang" id="Waktu Pulang" class="date Waktu Pulang" readonly value="{{ date('H:i', strtotime($item->waktu_selesai)) }}">
                    </div>
                </div>
                <div class="tgl">
                    @if($item->kategoriAbsensi->nama_kategori === 'Absen Dinas')
                    <div class="tgl1">
                        <div class="tgl1">
                            <h5>Foto Absen Dinas</h5>
                            <!-- Displaying the image -->
                            <br>
                            <img src="{{ asset($item->file_img) }}" alt="Foto Absen Dinas"  style="width: 250px;">
                        </div>
                    </div>
                    @endif
                    <!-- Other fields or content -->
                </div>

            </div>
        </form>
    </div>
</div>
@endsection

@push('addon-script')
<script type="text/javascript" src="{{ asset('admin/js/jquery-1.10.2.js') }}"></script>
<script type="text/javascript">

</script>

@endpush