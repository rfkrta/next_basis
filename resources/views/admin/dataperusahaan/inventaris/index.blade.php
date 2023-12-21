@extends('head')

@section('content')
    <div class="main">
        <div class="main-top">
            <h1>Inventaris</h1>
        </div>
        <div class="view">
            <div class="search">
                <i class="fa fa-search"></i>
                <input type="text" name="" class="input1" placeholder="Search">
            </div>
            <div class="plus">
                <i class="fa fa-plus"></i>
                <a href="{{ route('admin.dataperusahaan.inventaris.create') }}">Tambah Inventaris</a>
            </div>
        </div>

        <div class="filter">
            <ul class="filterx">
                <li class="{{ request()->input('Kategori') === null ? 'activev' : '' }}">
                    <a href="{{ route('admin.dataperusahaan.inventaris.index') }}">Semua</a>
                </li>
            </ul>
            <ul class="filterx">
                <li class="{{ request()->input('Kategori') === 'Gedung' ? 'activev' : '' }}">
                    <a href="{{ route('admin.dataperusahaan.inventaris.index', ['Kategori' => 'Gedung']) }}">Gedung</a>
                </li>
            </ul>
            <ul class="filterx">
                <li class="{{ request()->input('Kategori') === 'Kendaraan' ? 'activev' : '' }}">
                    <a href="{{ route('admin.dataperusahaan.inventaris.index', ['Kategori' => 'Kendaraan']) }}">Kendaraan</a>
                </li>
            </ul>
        </div>
        <div class="line6"></div>
        <div class="cong-box">
            <div>
                <table class="box" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Kategori</th>
                            <th>Tanggal Diperoleh</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inventarisWith as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->Kode }}</td>
                            <td>{{ $item->Nama_Barang }}</td>
                            <td>{{ $item->Jumlah }}</td>
                            <td>{{ $item->Kategori }}</td>
                            <td>{{ $item->Tanggal_Diperoleh }}</td>
                            <td>
                                <a href="{{ route('admin.dataperusahaan.inventaris.show', $item->id) }}" class="btn btn-danger">
                                    <i class="btn1 fa fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.dataperusahaan.inventaris.edit', $item->id) }}" class="btn btn-danger">
                                    <i class="btn3 fa fa-pencil"></i>
                                </a>
                                <!-- <a href="#" class="btn btn-danger">
                                    <i class="btn2 fa fa-trash"></i>
                                </a> -->
                            </td>
                        </tr>
                        @empty
                        <!-- <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('img/1.png') }}" alt="none">
                                <p>Tidak ada data Inventaris</p>
                            </td>
                        </tr> -->
                        @if($inventarisWith->isEmpty() && $kategori === null)
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('img/1.png') }}" alt="none">
                                <p>Tidak ada data Inventaris</p>
                            </td>
                        </tr>
                        @elseif($inventarisWith->isEmpty() && $kategori === 'Gedung')
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('img/1.png') }}" alt="none">
                                <p>Tidak ada data Inventaris Gedung</p>
                            </td>
                        </tr>
                        @elseif($inventarisWith->isEmpty() && $kategori === 'Kendaraan')
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('img/1.png') }}" alt="none">
                                <p>Tidak ada data Inventaris Kendaraan</p>
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

@push('addon-script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filterLinks = document.querySelectorAll(".filterx a");
            const rows = document.querySelectorAll("tr");

            filterLinks.forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();

                    const selectedCategory = this.getAttribute("data-kategori");

                    rows.forEach(row => {
                        const dataKategori = row.getAttribute("data-kategori");
                        const shouldShow = selectedCategory === "semua" || selectedCategory === dataKategori ||
                            (selectedCategory === "inventaris" && dataKategori !== "gedung" && dataKategori !== "kendaraan");
                            (selectedCategory === "gedung")

                        row.style.display = shouldShow ? "table-row" : "none";
                    });
                });
            });
        });
    </script>
@endpush