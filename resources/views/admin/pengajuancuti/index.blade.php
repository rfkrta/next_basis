@include('head')
    <div class="container">
        @include('sidebar')
        <div class="main">
            <div class="main-top">
                <h1>Pengajuan Cuti</h1>
            </div>
            <div class="view">
                <div class="search">
                    <i class="fa fa-search"></i>
                    <input type="text" name="" class="input1" placeholder="Search">
                </div>
                <div class="plus">
                    <i class="fa fa-plus"></i>
                    <a href="TambahCuti.html">Permohonan Cuti</a>
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
                        <a href="#">Diterima</a>
                    </li>
                </ul>
                <ul class="filterx">
                    <li>
                        <a href="#">Tertunda</a>
                    </li>
                </ul>
                <ul class="filterx">
                    <li>
                        <a href="#">Dibatalkan</a>
                    </li>
                </ul>
            </div>
            <div class="line"></div>
            <div class="cong-box">
                <div>
                    <table class="box" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Budi Susanto</td>
                                <td>Cuti Tahunan</td>
                                <td>2023-08-24</td>
                                <td>2023-08-28</td>
                                <td>Diterima</td>
                                <td>
                                    <a href="#" class="btn btn-danger">
                                        <i class="btn1 fa fa-check"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="btn2 fa fa-times"></i>
                                    </a>
                                    <a href="DetailCuti.html" class="btn btn-danger">
                                        <i class="btn3 fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('script')