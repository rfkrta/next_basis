@extends('head')

@section('content')
    <div class="main">
        <div class="main-top1">
            <a href="{{ route('admin.mitra.index') }}"><i class="fa fa-angle-left"></i></a>
            <h3>Tambah Mitra Perusahaan</h3>
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
            <form action="{{ route('admin.mitra.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <div class="tglx">
                        <div class="tgl1">
                            <h5>Nama Perusahaan</h5>
                            <input type="text" name="nama_mitra" id="nama_mitra" class="date" placeholder="Tuliskan nama perusahaan, di sini" value="{{ old('nama_mitra') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Provinsi</h5>
                            <div class="form-group1">
                                <select name="provinsi" id="provinsi" required class="form-control1">
                                    <option>
                                        Pilih Provinsi...
                                    </option>
                                @foreach ($provinces as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <!-- <input type="text" name="provinsi" id="provinsi" class="date" placeholder="Tuliskan nama provinsi, di sini" value="{{ old('provinsi') }}"> -->
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Kabupaten / Kota</h5>
                            <div class="form-group1">
                                <select name="kota" id="kota" required class="form-control1">
                                    <option>
                                        Pilih Kabupaten / Kota...
                                    </option>
                                
                                </select>
                            </div>
                            <!-- <input type="text" name="kota" id="kota" class="date" placeholder="Tuliskan nama kabupaten atau kota, di sini" value="{{ old('kota') }}"> -->
                        </div>
                        <div class="tgl1">
                            <h5>Kecamatan</h5>
                            <div class="form-group1">
                                <select name="kecamatan" id="kecamatan" required class="form-control1">
                                    <option>
                                        Pilih Kecamatan...
                                    </option>
                                
                                </select>
                            </div>
                            <!-- <input type="text" name="kecamatan" id="kecamatan" class="date" placeholder="Tuliskan nama kecamatan, di sini" value="{{ old('kecamatan') }}"> -->
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Kelurahan</h5>
                            <div class="form-group1">
                                <select name="kelurahan" id="kelurahan" required class="form-control1">
                                    <option> 
                                        Pilih Kelurahan / Desa...
                                    </option>
                                
                                </select>
                            </div>
                            <!-- <input type="text" name="kelurahan" id="kelurahan" class="date" placeholder="Tuliskan nama kelurahan, di sini" value="{{ old('kelurahan') }}"> -->
                        </div>
                        <div class="tgl1">
                            <h5>Kode Pos</h5>
                            <input type="text" name="kode_pos" id="kode_pos" class="date" placeholder="Tuliskan kode pos, di sini" value="{{ old('kode_pos') }}">
                        </div>
                    </div>
                    <div class="keter">
                        <h5>Alamat Lengkap</h5>
                        <textarea name="alamat_lengkap" id="alamat_lengkap" cols="122" rows="5" placeholder="Tuliskan alamat lengkap, di sini">{{ old('alamat_lengkap') }}</textarea>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>PIC Perusahaan</h5>
                            <input type="text" name="nama_PIC_perusahaan" id="" class="date" placeholder="Tuliskan PIC perusahaan, di sini" value="{{ old('nama_PIC_perusahaan') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Jabatan PIC</h5>
                            <input type="text" name="jabatan_PIC" id="jabatan_PIC" class="date" placeholder="Tuliskan jabatan PIC, di sini" value="{{ old('jabatan_PIC') }}">
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Nomor PIC</h5>
                            <input type="text" name="nomer_telepon_PIC" id="nomer_telepon_PIC" class="date" placeholder="Tuliskan nomor PIC, di sini" value="{{ old('nomer_telepon_PIC') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Komisi Perjalanan Dinas</h5>
                            <input type="text" name="komisi_dinas" id="komisi_dinas" class="date" placeholder="Tuliskan komisi perjalanan dinas, di sini" value="{{ old('komisi_dinas') }}">
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" class="btny1x btn-primary btn-block">
                            Tambah Mitra
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script type="text/javascript" src="{{ url('admin/js/jquery-1.10.2.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function (){
                $('#provinsi').on('change',function(){
                    let id_provinsi = $('#provinsi').val();

                    $.ajax({
                        type : 'POST',
                        url : "{{ route('getkota') }}",
                        data : {id_provinsi:id_provinsi},
                        cache : false,

                        success : function(msg){
                            $('#kota').html(msg);
                            $('#kecamatan').html('');
                            $('#kelurahan').html('');
                        },
                        error : function(data){
                            console.log('error:',data)
                        },
                    })
                })
            })

            $(function (){
                $('#kota').on('change',function(){
                    let id_kota = $('#kota').val();

                    $.ajax({
                        type : 'POST',
                        url : "{{ route('getkecamatan') }}",
                        data : {id_kota:id_kota},
                        cache : false,

                        success : function(msg){
                            $('#kecamatan').html(msg);
                            $('#kelurahan').html('');
                        },
                        error : function(data){
                            console.log('error:',data)
                        },
                    })
                })
            })

            $(function (){
                $('#kecamatan').on('change',function(){
                    let id_kecamatan = $('#kecamatan').val();

                    $.ajax({
                        type : 'POST',
                        url : "{{ route('getkelurahan') }}",
                        data : {id_kecamatan:id_kecamatan},
                        cache : false,

                        success : function(msg){
                            $('#kelurahan').html(msg);
                        },
                        error : function(data){
                            console.log('error:',data)
                        },
                    })
                })
            })

        });
    </script>
@endpush