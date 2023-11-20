@extends('head')

@section('content')
    <div class="main">
        <div class="main-top1">
            <a href="{{ route('admin.karyawan.index') }}"><i class="fa fa-angle-left"></i></a>
            <h3>Detail Karyawan {{ $item->nama }}</h3>
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
            <form action="{{ route('admin.karyawan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <div class="nama">
                        <h5>Nama</h5>
                        <input type="text" name="nama" id="nama" class="input2" placeholder="Tuliskan nama karyawan, di sini" value="{{ $item->nama }}" readonly>
                    </div>
                    <div class="nama1">
                        <h5>Posisi</h5>
                        <input type="text" name="position" id="position" class="input2" placeholder="Tuliskan position karyawan, di sini" value="{{ $item->position->nama_posisi }}" readonly>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>NIP</h5>
                            <input type="number" name="nip" id="nip" class="date" placeholder="Tuliskan NIP, di sini" value="{{ $item->nip }}" readonly>
                        </div>
                        <!-- <div id="position"></div> -->
                        <div class="tgl1">
                            <h5>Gaji</h5>
                            <input type="number" name="gaji" id="gaji" class="date"
                                placeholder="Tuliskan gaji karyawan, di sini" value="{{ $item->gaji_posisi }}" readonly>
                        </div>
                    </div>
                    <!-- <div id="position"></div> -->
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Tanggal Mulai Kontrak Kerja</h5>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{ $item->tanggal_mulai }}" readonly>
                        </div>
                        <div class="tgl1">
                            <h5>Tanggal Selesai Kontrak Kerja</h5>
                            <input type="date" name="tanggal_selesai" id="" class="date" value="{{ $item->tanggal_selesai }}" readonly>
                        </div>
                    </div>
                    <div class="tgl">
                        <div class="tgl1">
                            <h5>Jumlah Cuti</h5>
                            <input type="number" name="nip" id="nip" class="date" placeholder="Tuliskan NIP, di sini" value="{{ $item->jmlCuti }}" readonly>
                        </div>
                        <!-- <div id="position"></div> -->
                        <div class="tgl1">
                            <h5>Status</h5>
                            <input type="text" name="status" id="status" class="date"
                                placeholder="Tuliskan status karyawan, di sini" value="{{ $item->status }}" readonly>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
    
@push('addon-script')
    <script type="text/javascript" src="{{ asset('admin/js/jquery-1.10.2.js') }}"></script>
    <!-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script> -->
    <!-- <script type="text/javascript">
        $("#id_positions").change(function() {
            var id_positions = $("#id_positions").val();
            $.ajax({
                type: "GET",
                url: "/karyawan/ajax",
                data: "id_positions="+id_positions,
                cache: false,
                success: function(data){
                    $("#position").html(data);
                }
            });
        });
    </script> -->
@endpush