@include('head')
<div class="container">
    @include('sidebar')
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
                <a href="TambahDinas.html">Perjalanan Dinas</a>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>PT Sido Muncul</td>
                            <td>Surabaya</td>
                            <td>2023-08-24</td>
                            <td>2023-08-28</td>
                            <td>Sedang Berjalan</td>
                            <td>
                                <a href="DetailDinas.html" class="btn btn-danger">
                                    <i class="btn1 fa fa-eye"></i>
                                </a>
                                <a href="EditPVR.html" class="btn btn-danger">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('script')