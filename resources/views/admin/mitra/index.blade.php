@include('head')
<div class="container">
    @include('sidebar')
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
                <li class="activev">
                    <a href="#">Semua</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#">Aktif</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#">Tidak Aktif</a>
                </li>
            </ul>
        </div>
        <div class="line2"></div>
        <div class="cong-box">
            <div>
                <table class="box" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Kota</th>
                            <th>PIC</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama_mitra }}</td>
                                <td>{{ $item->kota }}</td>
                                <td>{{ $item->nama_PIC_perusahaan }}</td>
                                <!-- <td>{{ $item->id }}</td> -->
                                <td>
                                    <!-- <a href="DetailMitra.html" class="btn btn-danger">
                                        <i class="btn1 fa fa-eye"></i>
                                    </a> -->
                                    <a href="{{ route('admin.mitra.edit', $item->id) }}" class="btn btn-danger">
                                        <i class="btn3 fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada mitra perusahaan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('script')