@extends('head')

@section('content')
    <div class="main">
        <div class="main-top">
            <h1>Mitra Perusahaan</h1>
        </div>
        <div class="view">
            <div class="search">
                <i class="fa fa-search"></i>
                <input type="text" name="" class="input1" placeholder="Search">
            </div>
            <div class="plus">
                <i class="fa fa-plus"></i>
                <a href="{{ route('admin.mitra.create') }}">Tambah Mitra</a>
            </div>
        </div>
        <div class="filter">
            <ul class="filterx">
                <li class="{{ request()->input('status') === null ? 'activev' : '' }}">
                    <a href="{{ route('admin.mitra.index') }}">Semua</a>
                </li>
            </ul>
            <ul class="filterx">
                <li class="{{ request()->input('status') === 'Aktif' ? 'activev' : '' }}">
                    <a href="{{ route('admin.mitra.index', ['status' => 'Aktif']) }}">Aktif</a>
                </li>
            </ul>
            <ul class="filterx">
                <li class="{{ request()->input('status') === 'Tidak Aktif' ? 'activev' : '' }}">
                    <a href="{{ route('admin.mitra.index', ['status' => 'Tidak Aktif']) }}">Tidak Aktif</a>
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
                            <th>Nama Perusahaan</th>
                            <th>Kota</th>
                            <th>PIC</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mitra as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama_mitra }}</td>
                                <td>{{ $item->regency->name }}</td>
                                <td>{{ $item->nama_PIC_perusahaan }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('admin.mitra.show', $item->id) }}" class="btn btn-danger">
                                        <i class="btn1 fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.mitra.edit', $item->id) }}" class="btn btn-danger">
                                        <i class="btn3 fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            @if($mitra->isEmpty() && $status === null)
                            <tr>
                                <td colspan="6" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada data mitra perusahaan</p>
                                </td>
                            </tr>
                            @elseif($mitra->isEmpty() && $status === 'Aktif')
                            <tr>
                                <td colspan="6" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada data mitra perusahaan Aktif</p>
                                </td>
                            </tr>
                            @elseif($mitra->isEmpty() && $status === 'Tidak Aktif')
                            <tr>
                                <td colspan="6" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada data mitra perusahaan Tidak Aktif</p>
                                </td>
                            </tr>
                            @endif
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection