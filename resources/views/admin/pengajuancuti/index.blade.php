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
                <a href="#">Ditolak</a>
            </li>
        </ul>
    </div>
    <div class="line5"></div>
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
                            <!-- <form id="formDiterima" method="POST" action="{{ route('admin.pengajuancuti.updateToDiterima', $item->id) }}" onsubmit="return showConfirmationModal('formDiterima', 'btnDiterima');"> -->
                            <form id="formDiterima" method="POST" action="{{ route('admin.pengajuancuti.updateToDiterima', $item->id) }}" onsubmit="return confirm('Anda yakin ingin menerima pengajuan ini?');"> 
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-dangger" id="btnDiterima">
                                    <i class="btn1 fa fa-check"></i>
                                </button>
                            </form>
                            <!-- Form to update status to Ditolak -->
                            <!-- <form id="formDitolak" method="POST" action="{{ route('admin.pengajuancuti.updateToDitolak', $item->id) }}" onsubmit="return showConfirmationModal('formDitolak', 'btnDitolak');"> -->
                            <form id="formDitolak" method="POST" action="{{ route('admin.pengajuancuti.updateToDitolak', $item->id) }}" onsubmit="return confirm('Anda yakin ingin menolak pengajuan ini?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger" id="btnDitolak">
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
<!-- Alert -->
    <div id="alertBox1" class="alert-container1" style="display:none;">
        <div class="alert-content">
            <p>Mohon isi semua field sebelum menambah pengajuan cuti!</p>
            <span class="close-button" onclick="closeAlertBox()">&times;</span>
        </div>
    </div>

<div id="confirmationModal" class="modal-container">
    <div class="confirmation-container">
        <!-- <h2>Keluar Halaman ?</h2> -->
        <p>Anda yakin ingin menerima pengajuan ini?</p>
        <div class="confirmation-buttons">
            <button type="button" class="cancel-button" data-dismiss="modal">Tidak</button>
            <button type="button" class="confirm-button" onclick="confirmAction()">Iya</button>
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

    // function showConfirmationModal(formDiterima, btnDiterima) {
    //     $('#confirmationModal').modal('show');

    //     // Store form and button information in data attributes of the modal
    //     $('#confirmationModal').data('formDiterima', formDiterima);
    //     $('#confirmationModal').data('btnDiterima', btnDiterima);

    //     return false; // Prevent form submission
    // }

    // function confirmAction() {
    //     // Get form and button information from data attributes
    //     var formDiterima = $('#confirmationModal').data('formDiterima');
    //     var btnDiterima = $('#confirmationModal').data('btnDiterima');

    //     // Disable the button immediately
    //     document.getElementById(btnDiterima).disabled = true;

    //     // Submit the form
    //     document.getElementById(formDiterima).submit();

    //     // Hide the modal
    //     $('#confirmationModal').modal('hide');
    // }

    document.getElementById('formDiterima').addEventListener('submit', function() {
        // Disable the "Terima" button after it's clicked
        document.getElementById('btnDiterima').disabled = true;
    });

    document.getElementById('formDitolak').addEventListener('submit', function() {
        // Disable the "Tolak" button after it's clicked
        document.getElementById('btnDitolak').disabled = true;
    });

    function closeAlertBox() {
        // Sembunyikan alert saat tombol close diklik
        document.getElementById('alertBox1').style.display = 'none';
    }
</script>
<!-- <script>
    document.getElementById('formDiterima').addEventListener('submit', function() {
        // Disable the "Terima" button after it's clicked
        document.getElementById('btnDiterima').disabled = true;
    });

    document.getElementById('formDitolak').addEventListener('submit', function() {
        // Disable the "Tolak" button after it's clicked
        document.getElementById('btnDitolak').disabled = true;
    });
</script> -->
@endsection