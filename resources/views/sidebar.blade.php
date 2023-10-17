<div class="sidebar">
    <h1 class="logo">Next<span>Basis</span></h1>
    <i class="fa fa-chevron-left menu-icon"></i>
    <ul class="sidenav">
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.dashboard.index') }}';">
            <i class="fa fa-home"></i> Beranda
        </li>
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.pengajuancuti.index') }}';">
            <i class="fa fa-file-text"></i> Cuti
        </li>
        <!-- <ul class="dropdown">
                    <li><a href="PengajuanCuti.html"><span class="dot1"></span> Pengajuan Cuti</a></li>
                    <li><a href="ApprovalCuti.html"><span class="dot1"></span> Persetujuan Cuti</a></li>
                </ul> -->
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.perjalanandinas.index') }}';">
            <i class="fa fa-plane"></i> Perjalanan Dinas
        </li>
        <!-- <ul class="dropdown1">
                    <li><a href="Dinas.html"><span class="dot2"></span> Dinas</a></li>
                    <li><a href="#"><span class="dot2"></span> Laporan</a></li>
                </ul> -->
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.karyawan.index') }}';">
            <i class="fa fa-users"></i> Karyawan
        </li>
        <!-- <ul class="dropdown2">
                    <li><a href="Karyawan.html"><span class="dot3"></span> Daftar Karyawan</a></li>
                    <li><a href="Kontrak.html"><span class="dot3"></span> Kontrak Kerja</a></li>
                </ul> -->
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.mitra.index') }}';">
            <i class="fa fa-building"></i> Mitra Perusahaan
        </li>
        <li>
            <i class="fa fa-folder-open"></i>
            <a href="#"> Data Perusahaan</a>
            <span class="span4"><i class="fa fa-angle-right"></i></span>
        </li>
        <ul class="dropdown3">
            <li style="cursor: pointer;" onclick="window.location='{{ route('admin.dataperusahaan.inventaris.index') }}';">
            <a ><span class="dot4"></span> Inventaris</a></li>
            <li style="cursor: pointer;" onclick="window.location='{{ route('admin.dataperusahaan.router.index') }}';">
            <a ><span class="dot4"></span> Router</a></li>
        </ul>
        <li>
            <i class="fa fa-key"></i>
            <a href="#"> Privilege</a>
        </li>
    </ul>
    <div class="admin">
        <div class="out">
            <img src="{{ asset('img/avatar.svg') }}" alt="">
            <div class="admin1">
                <a href="#">Budi Santoso</a>
                <h6>Admin</h6>
            </div>
            <div class="admin2">
                <a href="{{ route('logout') }}" class="btn-danger">
                    <i class="fa fa-sign-out"></i>
                </a>
            </div>
            <!-- <span class="span3"><i class="fa fa-sign-out"></i></span> -->
        </div>
    </div>
</div>