<div class="sidebar">
    <h1 class="logo">Next<span>Basis</span></h1>
    <i class="fa fa-chevron-left menu-icon"></i>
    <ul class="sidenav">
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.dashboard.index') }}';">
            <i class="fa fa-home"></i> <a>Beranda</a>
        </li>
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.pengajuancuti.index') }}';">
            <i class="fa fa-file-text"></i> <a>Cuti</a>
        </li>
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.perjalanandinas.index') }}';">
            <i class="fa fa-plane"></i> <a >Perjalanan Dinas</a>
        </li>
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.absensi.index') }}';">
            <i class="fa fa-users"></i> <a >Absensi</a>
        </li>
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.mitra.index') }}';">
            <i class="fa fa-building"></i> <a>Mitra Perusahaan</a>
        </li>
        <li>
            <i class="fa fa-folder-open"></i>
            <a href="#">Data Perusahaan</a>
            <span class="span4"><i class="fa fa-angle-right"></i></span>
        </li>
        <ul class="dropdown3">
            <li style="cursor: pointer;" onclick="window.location='{{ route('admin.dataperusahaan.inventaris.index') }}';">
            <a ><span class="dot4"></span> Inventaris</a></li>
            <li style="cursor: pointer;" onclick="window.location='{{ route('admin.dataperusahaan.router.index') }}';">
            <a ><span class="dot4"></span> Router</a></li>
        </ul>
        <li style="cursor: pointer;" onclick="window.location='{{ route('admin.user.index') }}';">
            <i class="fa fa-key"></i> <a>User</a>
        </li>
    </ul>
    <div class="admin">
        <div class="out">
            <img src="{{ asset('img/avatar.svg') }}" alt="">
            <div class="admin1">
            <a href="#">{{ auth()->user()->name }}</a>
                <h6>Admin</h6>
            </div>
            <div class="admin2">
                <a href="{{ route('logout') }}" class="btn-danger">
                    <i class="fa fa-sign-out"></i>
                </a>
            </div>
        </div>
    </div>
</div>