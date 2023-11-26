@extends('head')

@section('content')
    <div class="main">
        <div class="main-top1">
            <a href="{{ route('admin.perjalanandinas.index') }}"><i class="fa fa-angle-left"></i></a>
            <h3>Edit PVR Perjalanan Dinas {{ $item->mitra->nama_mitra }}</h3>
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

        <div class="cong-box1">
            <form action="{{ route('admin.perjalanandinas.update', $item->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="content">
                    <div class="tglx">
                        <div class="tgl1">
                            <h5>Biaya Hotel</h5>
                            <input type="text" name="nama_mitra" id="nama_mitra" class="date" placeholder="Tuliskan biaya untuk hotel, di sini" value="{{ old('nama_mitra') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Biaya Transportasi</h5>
                            <input type="text" name="nama_mitra" id="nama_mitra" class="date" placeholder="Tuliskan biaya untuk perusahaan, di sini" value="{{ old('nama_mitra') }}">
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Keterangan Hotel</h5>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" cols="58" rows="5" placeholder="Tuliskan keterangan untuk hotel, di sini">{{ old('alamat_lengkap') }}</textarea>
                        </div>
                        <div class="tgl1">
                            <h5>Keterangan Transportasi</h5>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" cols="58" rows="5" placeholder="Tuliskan keterangan untuk transportasi, di sini">{{ old('alamat_lengkap') }}</textarea>
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Biaya Konsumsi</h5>
                            <input type="text" name="nama_PIC_perusahaan" id="" class="date" placeholder="Tuliskan biaya untuk konsumsi, di sini" value="{{ old('nama_PIC_perusahaan') }}">
                        </div>
                        <div class="tgl1">
                            <h5>Biaya Keperluan Lain</h5>
                            <input type="text" name="jabatan_PIC" id="jabatan_PIC" class="date" placeholder="Tuliskan biaya untuk keperluan lainnya, di sini" value="{{ old('jabatan_PIC') }}">
                        </div>
                    </div>
                    <div class="tglx1">
                        <div class="tgl1">
                            <h5>Keterangan Konsumsi</h5>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" cols="58" rows="5" placeholder="Tuliskan keterangan untuk konsumsi, di sini">{{ old('alamat_lengkap') }}</textarea>
                        </div>
                        <div class="tgl1">
                            <h5>Keterangan Keperluan Lain</h5>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" cols="58" rows="5" placeholder="Tuliskan keterangan untuk keperluan lainnya, di sini">{{ old('alamat_lengkap') }}</textarea>
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" class="btny1 btn-primary btn-block">
                            Edit PVR
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