@extends('head')

@section('content')
    <div class="main">
        <div class="main-top">
            <h1>Router</h1>
        </div>
        <div class="view">
            <div class="search">
                <i class="fa fa-search"></i>
                <form id="searchForm" action="{{ route('searchByNameRouter') }}" method="GET">
                    <input type="text" class="input1" name="search" id="searchInput" placeholder="Cari berdasarkan nama" value="{{ $search }}">
                </form>
                <!-- <input type="text" name="" class="input1" placeholder="Search"> -->
            </div>
            <div class="plus">
                <i class="fa fa-plus"></i>
                <!-- <a href="TambahRouter.html">Tambah Router</a> -->
                <button type="button" class="btnn btn-primary" id="tambahRouterBtn">
                    Tambah Router
                </button>
            </div>
        </div>
        <div id="content">
        <!-- Content area goes here -->
            <table class="table" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>MAC Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($router as $item)
                        <tr>
                            <td>{{ $item->kode_router }}</td>
                            <td>{{ $item->nama_router }}</td>
                            <td>
                                <!-- <div class="btn-group"> -->
                                    <a class="btn btn-danger btn-edit" data-id="{{ $item->id }}">
                                        <i class="btn3 fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger btn-delete" data-id="{{ $item->id }}">
                                        <i class="btn2 fa fa-trash"></i>
                                    </a>
                                <!-- </div> -->
                            </td>
                        </tr>
                    @empty
                    @if($router->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada data Router</p>
                        </td>
                    </tr>
                    @elseif($noData)
                    <tr>
                        <td colspan="3" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada data Router</p>
                        </td>
                    </tr>
                    @endif
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <ul class="pagination">
                {{ $router->links() }}
            </ul>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div id="tambahRouterModal" class="modal1">
        <div class="modal-content1">
            <h2>Tambah Router</h2>
            <div class="linex"></div>
            <form id="formTambahRouter">
                @csrf
                <label for="kode_router">Kode Router :</label>
                <input type="text" id="kode_router" name="kode_router" value="{{ $kode_router }}" readonly>
                <label for="nama_router">Nama Router :</label>
                <input type="text" id="nama_router" name="nama_router" placeholder="Masukkan Router" required>
                <div class="btn-groupx">
                    <button type="button" class="cancelbtn1" id="closeModal">Batal</button>
                    <button type="submit" class="addbtn1">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editRouterModal" class="modal1">
        <div class="modal-content1">
            <h2>Edit Router</h2>
            <!-- Menampilkan ID dan Nama Router -->
            <p>Kode Router: <span id="displayRouterId"></span></p>
            <p>Nama Router: <span id="displayNamaRouter"></span></p>
            <div class="linex"></div>
            <form id="formEditRouter" action="{{ route('update-router', ['id' => '__router_id__']) }}" method="post">
                @csrf
                @method('PUT')
                <label for="nama_router">Nama Router :</label>
                <input type="text" id="nama_router" name="nama_router" placeholder="Masukkan Router" required>
                <div class="btn-groupx">
                    <input type="hidden" id="editRouterId" name="editRouterId">
                    <button type="button" class="cancelbtn1" id="closeModalEdit">Batal</button>
                    <button type="submit" class="addbtn1">Ubah</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
<!-- <script type="text/javascript" src="{{ url('admin/js/jquery-1.10.2.js') }}"></script> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

            // Mengambil data dari formulir
            var nama_router = document.getElementById('nama_router').value;

            // Validasi data, misalnya memastikan nama router tidak kosong
            if (!nama_router.trim()) {
                alert('Nama router tidak boleh kosong!');
                return;
            }

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.dataperusahaan.router.store') }}", // Sesuaikan dengan rute simpan data di server
                    data: {
                    nama_router: nama_router,
                },
                success: function (response) {
                    // Sukses, lakukan sesuatu jika diperlukan
                    // loadRouterData();
                    closeModal();
                },
                error: function (error) {
                    // Kesalahan, lakukan sesuatu jika diperlukan
                    console.error('Terjadi kesalahan:', error);
                },
            });
        // Lakukan sesuatu dengan data yang diinput
        // closeModal();
        };

        // Fungsi untuk memuat data router dan memperbarui tampilan
        function loadRouterData() {
            // Anda perlu menyesuaikan rute berikut sesuai dengan kebutuhan proyek Anda
            $.ajax({
                type: 'GET',
                url: '/load-router-data',
                success: function (data) {
                // Sukses, perbarui tampilan dengan data baru
                updateViewWithData(data);
                },
                error: function (error) {
                console.error('Terjadi kesalahan saat memuat data router:', error);
                },
            });
        }

        // Fungsi untuk memperbarui tampilan dengan data baru
        function updateViewWithData(data) {
        // Lakukan sesuatu dengan data, misalnya mengganti isi tabel dengan data baru
        console.log('Data router baru:', data);
        }

        // Menangani klik tombol edit
        $(document).on('click', '.btn-edit', function () {
            var routerId = $(this).data('id');

            // Mengambil data router berdasarkan ID
            $.ajax({
                type: 'GET',
                url: '/get-router/' + routerId, // Sesuaikan dengan rute untuk mendapatkan data router
                success: function (data) {
                    // Mengisi data pada modal edit
                    $('#nama_router').val(data.nama_router);
                    $('#editRouterId').val(data.id);

                    // Menetapkan nilai ID dan Nama Router pada elemen span di modal
                    $('#displayRouterId').text(data.kode_router);
                    $('#displayNamaRouter').text(data.nama_router);

                    // Mengubah action pada form untuk menyertakan ID router yang sedang diedit
                    var formAction = $('#formEditRouter').attr('action');
                    formAction = formAction.replace('__router_id__', data.id);
                    $('#formEditRouter').attr('action', formAction);

                    // Menampilkan modal edit
                    $('#editRouterModal').show();
                },
                error: function (error) {
                    console.error('Terjadi kesalahan:', error);
                },
            });
        });

        // Menangani tombol close pada modal
        $(document).on('click', '#closeModalEdit', function () {
            // Menutup modal edit
            $('#editRouterModal').hide();
        });

        // Menangani klik di luar modal untuk menutup modal
        window.onclick = function (event) {
            var modal = document.getElementById('tambahRouterModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };

        // Menangani klik di luar modal untuk menutup modal
        window.onclick = function (event) {
            var modal = document.getElementById('editRouterModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };

        // Menangani klik tombol hapus
        $(document).on('click', '.btn-delete', function () {
            var routerId = $(this).data('id');

            // Minta konfirmasi pengguna sebelum menghapus
            if (confirm('Apakah Anda yakin ingin menghapus router ini?')) {
                // Kirim permintaan DELETE ke rute delete-router
                $.ajax({
                    type: 'DELETE',
                    url: '/delete-router/' + routerId,
                    success: function () {
                        // Refresh halaman setelah penghapusan berhasil
                        location.reload();
                    },
                    error: function (error) {
                        console.error('Terjadi kesalahan:', error);
                    },
                });
            }
        });

        document.getElementById('searchInput').addEventListener('input', function() {
            // Mengirim permintaan pencarian saat input berubah
            document.getElementById('searchForm').submit();
        });
    });
</script>
@endpush