@extends('head')

@section('content')
<div class="main">
    <div class="main-top">
        <h1>Absensi</h1>
    </div>
    <div class="view">
        <div class="search">
            <i class="fa fa-search"></i>
            <input type="text" name="" class="input1" placeholder="Search">
        </div>
        <div class="plus">
            <i class="fa fa-plus"></i>
            <a href="{{ route('admin.absensi.create') }}">Tambah Absensi</a>
        </div>
    </div>
    <!-- Filter Section -->
    <div class="filter">
        <ul class="filterx">
            <li class="{{ request()->input('filter') === null ? 'activev' : '' }}">
                <a href="{{ route('admin.absensi.index') }}">Semua</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="{{ request()->input('filter') === 'Aktif' ? 'activev' : '' }}">
                <a href="{{ route('admin.absensi.index', ['filter' => 'Aktif']) }}">Dinas</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="{{ request()->input('filter') === 'Tidak Aktif' ? 'activev' : '' }}">
                <a href="{{ route('admin.absensi.index', ['filter' => 'Tidak Aktif']) }}">Kantor</a>
            </li>
        </ul>
    </div>

    <div class="line2"></div>
    <div class="cong-box">
        <div>
            <table class="box" cellspacing="0">
                <thead>
                    <tr>
                        <th class="lebarTabel">No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Pulang</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @forelse ($absensis as $absen)
                    <tr>
                        <td>{{ $absen->id }}</td>
                        <td>{{ $absen->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal_mulai)->format('d-m-Y') }}</td>
<<<<<<< Updated upstream
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal_mulai)->format('H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal_selesai)->format('H:i') }}</td>
=======
                        <td>{{ \Carbon\Carbon::parse($absen->waktu_mulai)->format('H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->waktu_selesai)->format('H:i') }}</td>
>>>>>>> Stashed changes
                        <td>{{ $absen->kategoriAbsensi->nama_kategori }}</td>
                        <td>
                            <a href="{{ route('admin.absensi.show', ['id' => $absen->id]) }}" class="btn btn-danger">
                                <i class="btn3 fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
<<<<<<< Updated upstream
                            <p>Tidak ada data pengajuan cuti</p>
=======
                            <p>Tidak ada data Absensi</p>
>>>>>>> Stashed changes
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection