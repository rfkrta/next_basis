@extends('head')

@section('content')
<div class="main">
    <div class="main-top">
        <h1>Karyawan</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <div class="notif">
                <div class="notifikasi">
                    <div class="check">
                        <i class="cent fa fa-check"></i>
                    </div>
                    <p class="isi">Berhasil membuat karyawan baru</p>
                    <i class="silang fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    @endif

    <div class="view">
        <div class="search">
            <i class="fa fa-search"></i>
            <input type="text" name="" class="input1" placeholder="Search">
        </div>
        <div class="plus">
            <i class="fa fa-plus"></i>
            <a href="{{ route('admin.karyawan.create') }}">Tambah Karyawan</a>
        </div>
    </div>
    <!-- Filter Section -->
    <div class="filter">
        <ul class="filterx">
            <li class="{{ request()->input('filter') === null ? 'activev' : '' }}">
                <a href="{{ route('admin.karyawan.index') }}">Semua</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="{{ request()->input('filter') === 'Aktif' ? 'activev' : '' }}">
                <a href="{{ route('admin.karyawan.index', ['filter' => 'Aktif']) }}">Aktif</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="{{ request()->input('filter') === 'Tidak Aktif' ? 'activev' : '' }}">
                <a href="{{ route('admin.karyawan.index', ['filter' => 'Tidak Aktif']) }}">Tidak Aktif</a>
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
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($kry_baru->isEmpty() && $filter === null)
                    <tr>
                        <td colspan="5" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada data karyawan</p>
                        </td>
                    </tr>
                    @elseif ($kry_baru->isEmpty() && ($filter === 'Aktif' || $filter === 'Tidak Aktif'))
                    <tr>
                        <td colspan="5" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            @if ($filter === 'Aktif')
                            <p>Tidak ada data karyawan</p>
                            @elseif ($filter === 'Tidak Aktif')
                            <p>Tidak ada data karyawan</p>
                            @endif
                        </td>
                    </tr>
                    @else
                    @foreach ($kry_baru as $item)
                    <tr>
                        <!-- Table rows for each employee -->
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->position->nama_posisi }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('admin.karyawan.show', $item->id) }}" class="btn btn-danger">
                                <i class="btn1 fa fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.karyawan.edit', $item->id) }}" class="btn btn-danger">
                                <i class="btn3 fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>


            </table>
        </div>
    </div>
</div>
@endsection