@extends('head')

@section('content')
<div class="main">
    <div class="main-top">
        <h1>User</h1>
    </div>
    <div class="view">
        <div class="search">
            <i class="fa fa-search"></i>
            <form id="searchForm" action="{{ route('searchByNameUser') }}" method="GET">
                <input type="text" class="input1" name="search" id="searchInput" placeholder="Cari berdasarkan nama" value="{{ $search }}">
            </form>
            <!-- <input type="text" name="" class="input1" placeholder="Search"> -->
        </div>
        <div class="plus">
            <i class="fa fa-plus"></i>
            <a href="{{ route('admin.user.create') }}">Tambah User</a>
        </div>
    </div>
    <div class="filter">
        <ul class="filterx">
            <li class="{{ request()->input('status') === null ? 'activev' : '' }}">
                <a href="{{ route('admin.user.index') }}">Semua</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="{{ request()->input('status') === 'Aktif' ? 'activev' : '' }}">
                <a href="{{ route('admin.user.index', ['status' => 'Aktif']) }}">Aktif</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="{{ request()->input('status') === 'Tidak Aktif' ? 'activev' : '' }}">
                <a href="{{ route('admin.user.index', ['status' => 'Tidak Aktif']) }}">Tidak Aktif</a>
            </li>
        </ul>
    </div>
    <div class="line2"></div>
    <div id="content">
        <!-- Content area goes here -->
        <table class="table" cellspacing="0">
            <thead>
                <tr>
                    <th class="lebarTabel">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Profile Img</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <!-- Display the user's profile image -->
                            @if($item->foto_profil)
                                <img src="{{ asset($item->foto_profil) }}" alt="Profile Image" style="width: 32px; height: 32px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <!-- <div class="btn-group"> -->
                                <a href="{{ route('admin.user.edit', ['id' => $item->id]) }}" class="btn btn-danger">
                                    <i class="btn3 fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('admin.user.show', ['id' => $item->id]) }}" class="btn btn-danger">
                                    <i class="btn1 fa fa-eye"></i>
                                </a>
                            <!-- </div> -->
                        </td>
                    </tr>
                @empty
                    @if($user->isEmpty() && $status === null)
                    <tr>
                        <td colspan="6" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada data user</p>
                        </td>
                    </tr>
                    @elseif($user->isEmpty() && $status === 'Aktif')
                    <tr>
                        <td colspan="6" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada data user Aktif</p>
                        </td>
                    </tr>
                    @elseif($user->isEmpty() && $status === 'Tidak Aktif')
                    <tr>
                        <td colspan="6" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada data user Tidak Aktif</p>
                        </td>
                    </tr>
                    @elseif($noData)
                    <tr>
                        <td colspan="6" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada data user</p>
                        </td>
                    </tr>
                    @endif
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <ul class="pagination">
            {{ $user->links() }}
        </ul>
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
    });

    document.getElementById('searchInput').addEventListener('input', function() {
        // Mengirim permintaan pencarian saat input berubah
        document.getElementById('searchForm').submit();
    });
</script>
@endpush