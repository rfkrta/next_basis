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
                <a href="TambahKaryawan.html">Tambah Karyawan</a>
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
                            <th>Peran</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Budi Santoso</td>
                            <td>Admin</td>
                            <td>Manager Information Technology</td>
                            <td>Aktif</td>
                            <td>
                                <a href="DetailKaryawan.html" class="btn btn-danger">
                                    <i class="btn1 fa fa-eye"></i>
                                </a>
                                <a href="TambahKontrak.html" class="btn btn-danger">
                                    <i class="btn3 fa fa-pencil"></i>
                                </a>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('script')