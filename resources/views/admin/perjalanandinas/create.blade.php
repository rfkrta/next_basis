@extends('head')

@section('content')
    <div class="main">
        <div class="main-top1">
            <a href="{{ route('admin.perjalanandinas.index') }}"><i class="fa fa-angle-left"></i></a>
            <h3>Tambah Perjalanan Dinas</h3>
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
            <form action="{{ route('admin.perjalanandinas.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <h5>Perusahaan</h5>
                    <div class="form-group">
                        <select name="id_mitras" id="id_mitras" required class="form-control">
                            <option value="">
                                Pilih Perusahaan
                            </option>
                        @foreach ($mitra as $mitra)
                            <option value="{{ $mitra->id }}">{{ $mitra->nama_mitra }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Kota Keberangkatan</h5>
                            <div class="form-group1">
                                <select name="kota_keberangkatan" id="kota_keberangkatan" required class="form-control1">
                                    <option>
                                        Pilih Kabupaten / Kota...
                                    </option>
                                @foreach ($regencies as $kota)
                                    <option value="{{ $kota->id }}">{{ $kota->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <!-- <input type="text" name="kota" id="kota" class="date" placeholder="Tuliskan kota keberangkatan, di sini" value="{{ old('kota') }}"> -->
                        </div>
                        <div class="tgl1">
                            <h5>Komisi</h5>
                            <input type="number" name="komisi_dinas" id="komisi_dinas" class="date" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Tanggal Mulai</h5>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{ old('tanggal_mulai') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Tanggal Selesai</h5>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="date" value="{{ old('tanggal_selesai') }}">
                        </div>
                    </div>
                    <h5 class="tim1">Tim</h5>
                    <div class="tim">
                        <div class="form-group1">
                            <select name="id_anggota1" id="id_anggota1" required class="form-control1">
                                <option value="">
                                    Pilih anggota 1
                                </option>
                            @foreach ($karyawan as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group1">
                            <select name="id_anggota2" id="id_anggota2" required class="form-control1">
                                <option value="">
                                    Pilih anggota 2
                                </option>
                            @foreach ($karyawan1 as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                            @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <!-- <div class="button">
                        <button type="button" class="btnx btn-primary btn-block">
                            Tambah Anggota
                        </button>
                    </div> -->
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>PIC Perusahaan</h5>
                            <input type="text" name="nama_PIC_perusahaan" id="nama_PIC_perusahaan" class="date" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Jabatan PIC</h5>
                            <input type="text" name="jabatan_PIC" id="jabatan_PIC" class="date" readonly>
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" class="btny1 btn-primary btn-block">
                            Ajukan Dinas
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
<!-- <script type="text/javascript" src="{{ url('admin/js/jquery-1.10.2.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ url('admin/js/jquery-3.7.1.min.js') }}"></script> -->
<script type="text/javascript" src="{{ url('admin/js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#id_mitras').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ route('getPosisiById', ':id') }}".replace(':id', selectedValue),
                    type: 'GET',
                    success: function(data) {
                        // Update the gaji_posisi field value here
                        $('#komisi_dinas').val(data.komisi_dinas);
                        // $('#nama_PIC_perusahaan').val(data.nama_PIC_perusahaan);
                        // $('#jabatan_PIC').val(data.jabatan_PIC);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#id_mitras').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ route('getPosisiById1', ':id') }}".replace(':id', selectedValue),
                    type: 'GET',
                    success: function(data) {
                        // Update the gaji_posisi field value here
                        // $('#komisi_dinas').val(data.komisi_dinas);
                        $('#nama_PIC_perusahaan').val(data.nama_PIC_perusahaan);
                        // $('#jabatan_PIC').val(data.jabatan_PIC);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#id_mitras').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ route('getPosisiById2', ':id') }}".replace(':id', selectedValue),
                    type: 'GET',
                    success: function(data) {
                        // Update the gaji_posisi field value here
                        // $('#komisi_dinas').val(data.komisi_dinas);
                        // $('#nama_PIC_perusahaan').val(data.nama_PIC_perusahaan);
                        $('#jabatan_PIC').val(data.jabatan_PIC);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    });
</script>
@endpush