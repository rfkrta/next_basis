@extends('head')

@section('content')
<div class="main">
    <div class="main-top">
        <h1>Pengajuan Cuti</h1>
    </div>
    <div class="view">
        <div class="search">
            <i class="fa fa-search"></i>
            <input type="text" name="" class="input1" placeholder="Search">
        </div>
        <div class="plus">
            <i class="fa fa-plus"></i>
            <a href="{{ route('admin.pengajuancuti.create') }}">Permohonan Cuti</a>
        </div>
    </div>
    <div class="filter">
        <ul class="filterx">
            <li class="activev">
                <a href="#">Semua</a>
            </li>
        </ul>
        <ul class="filterx">
            <li>
                <a href="#">Diterima</a>
            </li>
        </ul>
        <ul class="filterx">
            <li>
                <a href="#">Tertunda</a>
            </li>
        </ul>
        <ul class="filterx">
            <li>
                <a href="#">Dibatalkan</a>
            </li>
        </ul>
    </div>
    <div class="line"></div>
    <div class="cong-box">
        <div>
            <table class="box" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cuti_baru as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->karyawan->nama }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <!-- Update status buttons -->
                            <form method="POST" action="{{ route('admin.pengajuancuti.updateToDiterima', $item->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-dangger">
                                    <i class="btn1 fa fa-check"></i>
                                </button>
                            </form>
                            <!-- Form to update status to Ditolak -->
                            <form method="POST" action="{{ route('admin.pengajuancuti.updateToDitolak', $item->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">
                                    <i class="btn2 fa fa-times"></i>
                                </button>
                            </form>
                            <a href="{{ route('admin.pengajuancuti.show', $item->id) }}" class="btn btn-danger">
                                <i class="btn3 fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada pengajuan cuti yang pending</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Add this script block at the end of your Blade template -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.updateStatus').on('click', function(e) {
            e.preventDefault(); // Prevent the default behavior of the anchor tag

            var cutiId = $(this).data('id');

            // Send AJAX request
            $.ajax({
                type: 'PUT',
                url: '/admin/pengajuancuti/' + cutiId + '/updateToDiterima',
                success: function(response) {
                    console.log('Status updated successfully');
                    location.reload(); // Reload the page after successful update
                },
                error: function(error) {
                    console.error('Error updating status:', error);
                }
            });
        });
    });
</script>
@endsection