@extends('head')

@section('content')
    <div class="main">
        <div class="main-top">
            <h1>Router</h1>
        </div>
        <div class="view">
            <div class="search">
                <i class="fa fa-search"></i>
                <input type="text" name="" class="input1" placeholder="Search">
            </div>
            <div class="plus">
                <i class="fa fa-plus"></i>
                <!-- <a href="TambahRouter.html">Tambah Router</a> -->
                <button type="button" class="btnn btn-primary" id="tambahRouterBtn">
                    Tambah Router
                </button>
            </div>
        </div>

        <div class="cong-box">
            <div>
                <table  class="box" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>MAC Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($item as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama_router }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="TambahKontrak.html" class="btn btn-danger">
                                            <i class="btn1 fa fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger">
                                            <i class="btn3 fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger">
                                            <i class="btn2 fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada data Router</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="tambahRouterModal" class="modal1">
        <div class="modal-content1">
            <h2>Tambah Router</h2>
            <div class="linex"></div>
            <form id="formTambahRouter" action="{{ route('admin.dataperusahaan.router.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="nama_router">Nama Router :</label>
                <input type="text" id="nama_router" name="nama_router" placeholder="Masukkan Router" required>
                <div class="btn-groupx">
                    <button type="button" class="cancelbtn1" id="closeModal">Batal</button>
                    <button type="submit" class="addbtn1">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
<script type="text/javascript" src="{{ url('admin/js/jquery-1.10.2.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fungsi untuk memunculkan modal
        function showModal() {
        document.getElementById('tambahRouterModal').style.display = 'block';
        }

        // Fungsi untuk menyembunyikan modal
        function closeModal() {
        document.getElementById('tambahRouterModal').style.display = 'none';
        }

        // Menangani klik di luar modal untuk menutup modal
        window.onclick = function (event) {
        var modal = document.getElementById('tambahRouterModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
        };

        // Menangani klik tombol "Tambah Router"
        document.getElementById('tambahRouterBtn').onclick = function () {
        showModal();
        };

        // Menangani klik tombol "Tutup" di dalam modal
        document.getElementById('closeModal').onclick = function () {
        closeModal();
        };

        // Menangani submit form di dalam modal
        document.getElementById('formTambahRouter').onsubmit = function (event) {
        event.preventDefault();
        // Lakukan sesuatu dengan data yang diinput
        closeModal();
        };
    });
</script>
@endpush