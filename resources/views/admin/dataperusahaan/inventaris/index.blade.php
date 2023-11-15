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
                <a href="TambahInventaris.html">Tambah Inventaris</a>
            </div>
        </div>

        <div class="filter">
            <ul class="filterx">
                <li class="activev">
                    <a href="#" data-kategori="semua">Semua</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#" data-kategori="inventaris">Inventaris</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#" data-kategori="gedung">Gedung</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#" data-kategori="kendaraan">Kendaraan</a>
                </li>
            </ul>
        </div>
        <div class="line3"></div>
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
                        @foreach ($inventaris as $item)
                        @php
                        $kategori = strtolower(str_replace(' ', '', $item['Kategori']));
                        @endphp

                        <tr data-kategori="{{ $kategori }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['Kode'] }}</td>
                            <td>{{ $item['Nama_Barang'] }}</td>
                            <td>{{ $item['Jumlah'] }}</td>
                            <td>{{ $item['Kategori'] }}</td>
                            <td>{{ $item['Tanggal_Diperoleh'] }}</td>
                            <td>
                                <a href="DetailInventaris.html" class="btn btn-danger">
                                    <i class="btn1 fa fa-eye"></i>
                                </a>
                                <a href="UbahInventaris.html" class="btn btn-danger">
                                    <i class="btn3 fa fa-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-danger">
                                    <i class="btn2 fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

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