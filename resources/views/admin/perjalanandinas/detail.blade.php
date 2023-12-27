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

        <div class="cong-box">
            <form action="{{ route('admin.perjalanandinas.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <div class="form-1">
                        <label for="id_mitras">Perusahaan</label>
                        <input type="text" name="id_mitras" id="id_mitras" value="{{ $item->mitra->nama_mitra }}" readonly>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="kota_keberangkatan">Kota Keberangkatan</label>
                            <input type="text" name="kota_keberangkatan" id="kota_keberangkatan" value="{{ $item->regency->name }}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="komisi_dinas">Komisi</label>
                            <input type="number" name="komisi_dinas" id="komisi_dinas" value="{{ $item->komisi_dinas }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ $item->tanggal_mulai }}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ $item->tanggal_selesai }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="id_anggota1">Anggota 1</label>
                            <input type="text" name="id_anggota1" id="id_anggota1" value="{{ $item->user->name }}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="id_anggota2">Anggota 2</label>
                            <input type="text" name="id_anggota2" id="id_anggota2" value="{{ $item->user1->name }}" readonly>
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="id_anggota3">Anggota 3</label>
                            <input type="text" name="id_anggota3" id="id_anggota3" value="{{ $item->user2->name ?: 'Belum diisi' }}" readonly>
                            @if ($item->user2->wasRecentlyCreated)
                                <p>Anggota 3 belum diisi.</p>
                            @endif
                        </div>
                        <div class="form-1">
                            <label for="id_anggota4">Anggota 4</label>
                            <input type="text" name="id_anggota4" id="id_anggota4" value="{{ $item->user3->name ?: 'Belum diisi' }}" readonly>
                            @if ($item->user3->wasRecentlyCreated)
                                <p>Anggota 4 belum diisi.</p>
                            @endif
                        </div>
                    </div>
                    <div class="form1">
                        <div class="form-1">
                            <label for="nama_PIC_perusahaan">PIC Perusahaan</label>
                            <input type="text" name="nama_PIC_perusahaan" id="nama_PIC_perusahaan" value="{{ $item->nama_PIC_perusahaan }}" readonly>
                        </div>
                        <div class="form-1">
                            <label for="jabatan_PIC">Jabatan PIC</label>
                            <input type="text" name="jabatan_PIC" id="jabatan_PIC" value="{{ $item->jabatan_PIC }}" readonly>
                        </div>
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
                        <input type="text" name="id_anggota1" id="id_anggota1" class="date" value="{{ $item->user->name }}" readonly>
                    </div>
                    <div class="tgl1">
                        <h5>Anggota 2</h5>
                        <input type="text" name="id_anggota2" id="id_anggota2" class="date" value="{{ $item->user1->name }}" readonly>
                    </div>
                </div>
                <div class="tglx1">
                    <div class="tgl1">
                        <h5>Anggota 3</h5>
                        <input type="text" name="id_anggota3" id="id_anggota3" class="date" value="{{ $item->user2->name ?: 'Belum diisi' }}" readonly>
                        @if ($item->user2->wasRecentlyCreated)
                        <p>Anggota 3 belum diisi.</p>
                        @endif
                    </div>
                    <div class="tgl1">
                        <h5>Anggota 4</h5>
                        <input type="text" name="id_anggota4" id="id_anggota4" class="date" value="{{ $item->user3->name ?: 'Belum diisi' }}" readonly>
                        @if ($item->user3->wasRecentlyCreated)
                        <p>Anggota 4 belum diisi.</p>
                        @endif
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
            <div class="tgl">
                <div class="tgl1">
                    @if ($item->berita_acara)
                    <p>Berita Acara:</p>
                    <a href="{{ asset('storage/uploads/berita_acara/' . basename($item->berita_acara)) }}" target="_blank">Download Berita Acara</a>
                    @endif
                </div>
                <div class="tgl1">
                    @if ($item->bukti_surat)
                    <p>Surat:</p>
                    <a href="{{ asset('storage/uploads/bukti_surat/' . basename($item->bukti_surat)) }}" target="_blank">Download Surat</a>
                    @endif
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
                    @if ($item->biayaDinas)
                        <tr>
                            <td>
                                {{ $item->biayaDinas->id }}
                            </td>
                            <td>{{ $item->biayaDinas->biaya_hotel }}</td>
                            <td>{{ $item->biayaDinas->biaya_transportasi }}</td>
                            <td>{{ $item->biayaDinas->biaya_konsumsi }}</td>
                            <td>{{ $item->biayaDinas->biaya_lain }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="5" class="text-center">
                                <p>Biaya Dinas belum diisi.</p>
                            </td>
                        </tr>
                    @endif
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