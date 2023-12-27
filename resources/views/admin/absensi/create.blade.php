@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <button type="button" class="btnclass btn-primary" onclick="openConfirmationModal()">
            <i class="fa fa-angle-left"></i>
        </button>
        <h3>Tambah Absensi</h3>
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

    <div class="cong-box2">
        <form action="{{ route('admin.absensi.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="form-group">
                    <div class="nama">
                        <h5>Nama</h5>
                        <div class="form-group">
                            <select name="nama" id="nama" required class="form-control">
                                <option value="" disabled selected>Pilih nama karyawan</option>
                                @foreach($users as $user)
                                @if($user->role_id === 3)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="nama1">
                        <h5>Posisi</h5>
                        <div class="form-group">
                            <select name="kategori_absen" id="kategori_absen" required class="form-control karyawan">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal</h5>
                        <div class="form-group">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                    </div>
                </div>
<<<<<<< Updated upstream
                <!-- Waktu Mulai -->
                <div class="tgl1">
                    <h5>Waktu Mulai</h5>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="date" value="{{ \Carbon\Carbon::parse($absen->waktu_mulai)->format('H:i') }}">
                </div>
                <!-- Waktu Selesai -->
                <div class="tgl1">
                    <h5>Waktu Selesai</h5>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="date" value="{{ \Carbon\Carbon::parse($absen->waktu_selesai)->format('H:i') }}">
=======
                <div class="tgl">
                    <!-- Waktu Mulai -->
                    <div class="tgl1">
                        <h5>Waktu Mulai</h5>
                        <input type="time" name="waktu_mulai" id="waktu_mulai" class="date" value="{{ isset($absen) ? \Carbon\Carbon::parse($absen->waktu_mulai)->format('H:i') : '' }}">
                    </div>
                    <!-- Waktu Selesai -->
                    <div class="tgl1">
                        <h5>Waktu Selesai</h5>
                        <input type="time" name="waktu_selesai" id="waktu_selesai" class="date" value="{{ isset($absen) ? \Carbon\Carbon::parse($absen->waktu_selesai)->format('H:i') : '' }}">
                    </div>
>>>>>>> Stashed changes
                </div>
                <div class="button">
                    <button type="submit" class="btnc btn-primary btn-block">
                        Tambah Absen
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

        document.addEventListener("DOMContentLoaded", function() {
            // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
            const today = new Date().toISOString().slice(0, 10);

            // Set nilai input tanggal menjadi tanggal hari ini
            document.getElementById('tanggal').value = today;
        });

        $(document).ready(function() {
            $('#id_positions').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ route('getGajiPosisiById', ':id') }}".replace(':id', selectedValue),
                    type: 'GET',
                    success: function(data) {
                        // Format the received salary as IDR before setting it in the input field
                        var formattedSalary = 'Rp.' + new Intl.NumberFormat('id-ID').format(data.gaji_posisi);

                        // Update the gaji_posisi field value here with the formatted salary
                        $('#gaji_posisi').val(formattedSalary);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#nama').on('change', function() {
                var selectedName = $(this).val();

                $.ajax({
                    url: "{{ route('getNIPByName', ':name') }}".replace(':name', selectedName),
                    type: 'GET',
                    success: function(data) {
                        // Update the nip field value here
                        $('#nip').val(data.nip);
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