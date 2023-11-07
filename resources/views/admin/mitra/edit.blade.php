@include('head')
    <div class="container">
        @include('sidebar')
        <div class="main">
            <div class="main-top1">
                <a href="{{ route('admin.mitra.index') }}"><i class="fa fa-angle-left"></i></a>
                <h3>Ubah Mitra Perusahaan {{ $item->nama_mitra }}</h3>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="cong-box4">
                <form action="{{ route('admin.mitra.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="content">
                        <div class="tglx">
                            <div class="tgl1">
                                <h5>Nama Perusahaan</h5>
                                <input type="text" name="nama_mitra" id="nama_mitra" class="date" placeholder="Tuliskan nama perusahaan, di sini" value="{{ $item->nama_mitra }}">
                            </div>
                            <div class="tgl1">
                                <h5>Provinsi</h5>
                                <input type="text" name="provinsi" id="provinsi" class="date" placeholder="Tuliskan nama provinsi, di sini" value="{{ $item->provinsi }}">
                            </div>
                        </div>
                        <div class="tglx1">
                            <div class="tgl1">
                                <h5>Kabupaten / Kota</h5>
                                <input type="text" name="kota" id="kota" class="date" placeholder="Tuliskan nama kabupaten atau kota, di sini" value="{{ $item->kota }}">
                            </div>
                            <div class="tgl1">
                                <h5>Kecamatan</h5>
                                <input type="text" name="kecamatan" id="kecamatan" class="date" placeholder="Tuliskan nama kecamatan, di sini" value="{{ $item->kecamatan }}">
                            </div>
                        </div>
                        <div class="tglx1">
                            <div class="tgl1">
                                <h5>Kelurahan</h5>
                                <input type="text" name="kelurahan" id="kelurahan" class="date" placeholder="Tuliskan nama kelurahan, di sini" value="{{ $item->kelurahan }}">
                            </div>
                            <div class="tgl1">
                                <h5>Kode Pos</h5>
                                <input type="text" name="kode_pos" id="kode_pos" class="date" placeholder="Tuliskan kode pos, di sini" value="{{ $item->kode_pos }}">
                            </div>
                        </div>
                        <div class="keter">
                            <h5>Alamat Lengkap</h5>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" cols="122" rows="5" placeholder="Tuliskan alamat lengkap, di sini">{{ $item->alamat_lengkap }}</textarea>
                        </div>
                        <div class="tglx1">
                            <div class="tgl1">
                                <h5>PIC Perusahaan</h5>
                                <input type="text" name="nama_PIC_perusahaan" id="" class="date" placeholder="Tuliskan PIC perusahaan, di sini" value="{{ $item->nama_PIC_perusahaan }}">
                            </div>
                            <div class="tgl1">
                                <h5>Jabatan PIC</h5>
                                <input type="text" name="jabatan_PIC" id="jabatan_PIC" class="date" placeholder="Tuliskan jabatan PIC, di sini" value="{{ $item->jabatan_PIC }}">
                            </div>
                        </div>
                        <div class="tglx1">
                            <div class="tgl1">
                                <h5>Nomor PIC</h5>
                                <input type="text" name="nomer_telepon_PIC" id="nomer_telepon_PIC" class="date" placeholder="Tuliskan nomor PIC, di sini" value="{{ $item->nomer_telepon_PIC }}">
                            </div>
                            <div class="tgl1">
                                <h5>Komisi Perjalanan Dinas</h5>
                                <input type="text" name="komisi_dinas" id="komisi_dinas" class="date" placeholder="Tuliskan komisi perjalanan dinas, di sini" value="{{ $item->komisi_dinas }}">
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit" class="btny1x btn-primary btn-block">
                                Ubah Mitra
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('script')