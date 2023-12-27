@extends('head')

@section('content')
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

        <div class="cong-box">
            <form action="{{ route('admin.mitra.update', $item->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="content">
                    <div class="form1">
                        <div class="form-1">
                            <label for="nama_mitra">Nama Perusahaan</label>
                            <input type="text" name="nama_mitra" id="nama_mitra" placeholder="Tuliskan nama perusahaan, di sini" value="{{ $item->nama_mitra }}">
                        </div>
                        <div class="form-1">
                            <label for="provinsi">Provinsi</label>
                            <select name="provinsi" id="provinsi" required>
                                <option value="{{ $item->province->id }}">
                                    <!-- Pilih Provinsi... -->
                                    {{ $item->province->name }}
                                </option>
                            @foreach ($provinces as $provinsi)
                                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="kota">Kabupaten / Kota</label>
                            <select name="kota" id="kota" required>
                                <option value="{{ $item->regency->id }}">
                                    <!-- Pilih Kabupaten / Kota... -->
                                    {{ $item->regency->name }}
                                </option>
                            
                            </select>
                        </div>
                        <div class="form-1">
                            <label for="kecamatan">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" required>
                                <option value="{{ $item->district->id }}">
                                    <!-- Pilih Kecamatan... -->
                                    {{ $item->district->name }}
                                </option>
                            
                            </select>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="kelurahan">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" required>
                                <option value="{{ $item->village->id }}"> 
                                    <!-- Pilih Kelurahan / Desa... -->
                                    {{ $item->village->name }}
                                </option>
                            
                            </select>
                        </div>
                        <div class="form-1">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" placeholder="Tuliskan kode pos, di sini" value="{{ $item->kode_pos }}">
                        </div>
                    </div>
                    <div class="form-ket">
                        <label for="alamat_lengkap">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" id="alamat_lengkap" placeholder="Tuliskan alamat lengkap, di sini">{{ $item->alamat_lengkap }}</textarea>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="nama_PIC_perusahaan">PIC Perusahaan</label>
                            <input type="text" name="nama_PIC_perusahaan" id="" placeholder="Tuliskan PIC perusahaan, di sini" value="{{ $item->nama_PIC_perusahaan }}">
                        </div>
                        <div class="form-1">
                            <label for="jabatan_PIC">Jabatan PIC</label>
                            <input type="text" name="jabatan_PIC" id="jabatan_PIC" placeholder="Tuliskan jabatan PIC, di sini" value="{{ $item->jabatan_PIC }}">
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="nomer_telepon_PIC">Nomor PIC</label>
                            <input type="text" name="nomer_telepon_PIC" id="nomer_telepon_PIC" placeholder="Tuliskan nomor PIC, di sini" value="{{ $item->nomer_telepon_PIC }}">
                        </div>
                        <div class="form-1">
                            <label for="komisi_dinas">Komisi Perjalanan Dinas</label>
                            <input type="text" name="komisi_dinas" id="komisi_dinas" placeholder="Tuliskan komisi perjalanan dinas, di sini" value="{{ $item->komisi_dinas }}">
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <h5>Status</h5>
                            <select value='status' name="status" id="status">
                                <option value="{{ $item->status }}">
                                    {{ $item->status }}
                                </option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" class="button-cong">
                            Ubah Mitra
                        </button>
                    </div>
                    <!-- <div class="button">
                        <button type="submit" class="btny1x btn-primary btn-block">
                            Ubah Mitra
                        </button>
                    </div> -->
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