@extends('head')

@section('content')
    <div class="main">
        <div class="main-top1">
            <a href="{{ route('admin.perjalanandinas.index') }}"><i class="fa fa-angle-left"></i></a>
            <h3>Detail Perjalanan Dinas {{ $item->mitra->nama_mitra }}</h3>
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
                    <div class="nama">
                        <h5>Nama Perusahaan</h5>
                        <input type="text" name="id_mitras" id="id_mitras" class="input2" value="{{ $item->mitra->nama_mitra }}" readonly>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Kota Keberangkatan</h5>
                            <input type="text" name="kota_keberangkatan" id="kota_keberangkatan" class="date" value="{{ $item->regency->name }}" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Komisi</h5>
                            <input type="number" name="komisi_dinas" id="komisi_dinas" class="date" value="{{ $item->komisi_dinas }}" readonly>
                        </div>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Tanggal Mulai</h5>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{ $item->tanggal_mulai }}" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Tanggal Selesai</h5>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="date" value="{{ $item->tanggal_selesai }}" readonly>
                        </div>
                    </div>
                    <h5 class="tim1">Tim</h5>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Anggota 1</h5>
                            <input type="text" name="id_anggota1" id="id_anggota1" class="date" value="{{ $item->id_anggota1 }}" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Anggota 2</h5>
                            <input type="text" name="id_anggota2" id="id_anggota2" class="date" value="{{ $item->id_anggota2 }}" readonly>
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Anggota 3</h5>
                            <input type="text" name="id_anggota3" id="id_anggota3" class="date" value="{{ $item->id_anggota3 }}" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Anggota 4</h5>
                            <input type="text" name="id_anggota4" id="id_anggota4" class="date" value="{{ $item->id_anggota4 }}" readonly>
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>PIC Perusahaan</h5>
                            <input type="text" name="nama_PIC_perusahaan" id="nama_PIC_perusahaan" class="date" value="{{ $item->nama_PIC_perusahaan }}" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Jabatan PIC</h5>
                            <input type="text" name="jabatan_PIC" id="jabatan_PIC" class="date" value="{{ $item->jabatan_PIC }}" readonly>
                        </div>
                    </div>
                </div>
            </form>

            <!-- <h5>Biaya Estimasi</h5> -->
            <table class="box" cellspacing="0">
                <thead>
                    <tr>
                        <th class="lebarTabel">No</th>
                        <th>Biaya Hotel</th>
                        <th>Biaya Transportasi</th>
                        <th>Biaya Konsumsi</th>
                        <th>Biaya Lainnya</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $item->biayaDinas->id }}</td>
                        <td>{{ $item->biayaDinas->biaya_hotel }}</td>
                        <td>{{ $item->biayaDinas->biaya_transportasi }}</td>
                        <td>{{ $item->biayaDinas->biaya_konsumsi }}</td>
                        <td>{{ $item->biayaDinas->biaya_lain }}</td>
                    </tr>
                </tbody>
            </table>

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