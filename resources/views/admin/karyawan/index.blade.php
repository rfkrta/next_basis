@include('head')
<div class="container">
    @include('sidebar')
    <div class="main">
        <div class="main-top">
            <h1>Karyawan</h1>
        </div>
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
                            <th>Nama</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kry_baru as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->position->nama_posisi }}</td>
                                <td></td>
                                <!-- <td>{{ $item->st }}</td> -->
                                <td>
                                    <!-- <a href="{{ route('admin.karyawan.show', $item->id) }}" class="btn btn-danger">
                                        <i class="btn1 fa fa-eye"></i>
                                    </a> -->
                                    <a href="{{ route('admin.karyawan.edit', $item->id) }}" class="btn btn-danger">
                                        <i class="btn3 fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada karyawan yang tidak aktif</p>
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