@extends('head')

@section('content')
    <div class="main">
        <div class="main-top">
            <h1>Dinas</h1>
        </div>
        <div class="view">
            <div class="search">
                <i class="fa fa-search"></i>
                <input type="text" name="" class="input1" placeholder="Search">
            </div>
            <div class="plus">
                <i class="fa fa-plus"></i>
                <a href="{{ route('admin.perjalanandinas.create') }}">Perjalanan Dinas</a>
            </div>
        </div>

        <div class="filter">
            <ul class="filterx">
                <li class="activev">
                    <a href="#">Semua</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#">Selesai</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#">Berjalan</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#">Ditolak</a>
                </li>
            </ul>
        </div>
        <div class="line1"></div>
        <div class="cong-box">
            <div>
                <table class="box" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Perusahaan</th>
                            <th>Kota Keberangkatan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dinas_baru as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->mitra->nama_mitra }}</td>
                                <td>{{ $item->kota }}</td>
                                <td>{{ $item->tanggal_mulai }}</td>
                                <td>{{ $item->tanggal_selesai }}</td>
                                <!-- <td>{{ $item->status }}</td> -->
                                <td>
                                    <a href="{{ route('admin.perjalanandinas.show', $item->id) }}" class="btn btn-danger">
                                        <i class="btn1 fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.perjalanandinas.edit', $item->id) }}" class="btn btn-danger">
                                        <i class="btn3 fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="btn2 fa fa-print"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="btn1 fa fa-check"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="btn2 fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada perjalanan dinas</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection