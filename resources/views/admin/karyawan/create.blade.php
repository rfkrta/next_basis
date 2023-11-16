@extends('head')

@section('content')
<div class="main">
    <div class="main-top1">
        <a href="{{ route('admin.karyawan.index') }}"><i class="fa fa-angle-left"></i></a>
        <h3>Tambah Karyawan</h3>
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
        <form action="{{ route('admin.karyawan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="form-group">
                    <div class="nama">
                        <h5>Nama</h5>
                        <div class="form-group">
                            <select name="nama" id="nama" required class="form-control">
                                <option value="" disabled selected>Pilih nama karyawan</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->name }}">{{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="nama1">
                    <h5>Posisi</h5>
                    <div class="form-group">
                        <select name="id_positions" id="id_positions" required class="form-control karyawan">
                            <option value="">
                                Pilih Posisi Karyawan
                            </option>
                            @foreach ($position as $position)
                            <option value="{{ $position->id }}">{{ $position->nama_posisi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>NIP</h5>
                        <input type="number" name="nip" id="nip" class="date" placeholder="Tuliskan NIP, di sini" value="{{ old('nip') }}">
                    </div>
                    <!-- <div id="gaji"></div> -->

                    <div class="tgl1">
                        <h5>Gaji</h5>
                        <input type="text" name="gaji_posisi" id="gaji_posisi" class="date gaji_posisi">
                    </div>

                </div>
                <!-- <div id="position"></div> -->
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal Mulai Kontrak Kerja</h5>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="{{ old('tanggal_mulai') }}">
                    </div>
                    <div class="tgl1">
                        <h5>Tanggal Selesai Kontrak Kerja</h5>
                        <input type="date" name="tanggal_selesai" id="" class="date" value="{{ old('tanggal_selesai') }}">
                    </div>
                </div>
                <div class="button">
                    <button type="submit" class="btnc btn-primary btn-block">
                        Tambah Karyawan
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

        // $(function (){
        //     $('#id_positions').on('change',function(){
        //         var id = $('#id_positions').val();

        //         console.log(id);
        //         $.ajax({
        //             type : 'GET',
        //             url : "{{ route('admin.karyawan.getgaji1') }}",
        //             data : {'id':id},
        //             dataType : 'json',
        //             cache : false,

        //             success : function(msg){
        //                 $('#gaji_posisi').html(msg);
        //             },
        //             error : function(data){
        //                 console.log('error:',data)
        //             },
        //         });
        //     });
        // });

        // $(document).on('change','.karyawan',function () {
        //     var position_id=$(this).val();

        //     var a=$(this).parent();
        //     console.log(position_id);
        //     var op="";
        //     $.ajax({
        //         type: 'get',
        //         url: "{{ route('admin.karyawan.getgaji') }}",
        //         data: {'id':position_id},
        //         dataType: 'json',//return data will be json
        //         success:function(data){
        //             console.log("gaji_posisi");
        //             console.log(data.gaji_posisi);

        //             // here price is coloumn name in products table data.coln name

        //             a.find('.gaji_posisi').val(data.gaji_posisi);

        //         },
        //         error:function(){

        //         }
        //     });


        // });

        // $('#id_positions').on('change', (event) => {
        //     getGaji(event.target.value).then(position => {
        //         $('#gaji_posisi').val(position.gaji_posisi);
        //     });
        // });

        // async function getGaji(id) {
        //     let response = await fetch('{{ route("admin.karyawan.getgaji2") }}' + id)
        //     let data = await response.json();

        //     return data;
        // }

        // $(function (){
        //     $(document).on('change','.karyawan',function (){
        //         var id = $(this).val();

        //         var a=$(this).parent();
        //         console.log(id);
        //         var op="";
        //         $.ajax({
        //             type : 'GET',
        //             url : "{{ route('admin.karyawan.getgaji1') }}",
        //             data : {'id':id},
        //             dataType : 'json',
        //             cache : false,

        //             success : function(msg){
        //                 $('#gaji_posisi').html(msg);
        //                 console.log("gaji_posisi");
        //                 console.log(msg.gaji_posisi);

        //                 // here price is coloumn name in products table msg.coln name

        //                 // a.find('.gaji_posisi').val(msg.gaji_posisi);
        //             },
        //             error : function(data){
        //                 console.log('error:',data)
        //             },
        //         });
        //     });
        // });

        $(document).ready(function() {
            $('#id_positions').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: "{{ route('getGajiPosisiById', ':id') }}".replace(':id', selectedValue),
                    type: 'GET',
                    success: function(data) {
                        // Update the gaji_posisi field value here
                        $('#gaji_posisi').val(data.gaji_posisi);
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