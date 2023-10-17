@include('head')
    <div class="container">
        @include('sidebar')
        <div class="main">
            <div class="main-top1">
                <a href="PengajuanCuti.html"><i class="fa fa-angle-left"></i></a>
                <h3>Pengajuan Cuti</h3>
            </div>
            <div class="cong-box2">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="content">
                        <div class="tglx">
                            <div class="tgl1">
                                <h5>Cuti</h5>
                                <div class="form-group1">
                                    <select name="status" required class="form-control1">
                                        <option value="">
                                            Pilih Kategori Cuti
                                        </option>
                                        <option value="">Cuti Tahunan</option>
                                        <option value="">Cuti Kehamilan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tgl1">
                                <h5>Nama</h5>
                                <div class="form-group1">
                                    <select name="status" required class="form-control1">
                                        <option value="">
                                            Pilih Nama Karyawan
                                        </option>
                                        <option value="">Budi</option>
                                        <option value="">Yanto</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="keter">
                            <h5>Keterangan</h5>
                            <textarea name="keterangan" id="keterangan" placeholder="Tuliskan Keterangan atau alasan mengambil cuti, di sini"></textarea>
                            <!-- cols="122" rows="5" -->
                        </div>
                        <div class="tgl">
                            <div class="tgl1">
                                <h5>Tanggal Mulai</h5>
                                <input type="date" name="" id="" class="date">
                            </div>
                            <div class="tgl1">
                                <h5>Tanggal Selesai</h5>
                                <input type="date" name="" id="" class="date">
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit" class="btn1 btn-primary btn-block">
                                Ajukan Cuti
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('script')