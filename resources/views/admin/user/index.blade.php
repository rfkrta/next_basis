@extends('head')

@section('content')
<div class="main">
    <div class="main-top">
        <h1>User</h1>
    </div>
    <div class="view">
        <div class="search">
            <i class="fa fa-search"></i>
            <input type="text" name="" class="input1" placeholder="Search">
        </div>
        <div class="plus">
            <i class="fa fa-plus"></i>
            <a href="{{ route('admin.user.create') }}">Tambah User</a>
        </div>
    </div>
    <div class="filter">
        <ul class="filterx">
            <li class="{{ request()->input('filter') === null ? 'activev' : '' }}">
                <a href="{{ route('admin.user.index') }}">Semua</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="{{ request()->input('filter') === 'Aktif' ? 'activev' : '' }}">
                <a href="{{ route('admin.user.index', ['filter' => 'Aktif']) }}">Aktif</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="{{ request()->input('filter') === 'Tidak Aktif' ? 'activev' : '' }}">
                <a href="{{ route('admin.user.index', ['filter' => 'Tidak Aktif']) }}">Tidak Aktif</a>
            </li>
        </ul>
    </div>

    <div class="line2">
    </div>
    <div class="cong-box">
        <div>
            <table class="box" cellspacing="0">
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
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                            <!-- Display the user's profile image -->
                            @if($user->foto_profil)
                            <img src="{{ asset($user->foto_profil) }}" alt="Profile Image" style="width: 32px; height: 32px;">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.karyawan.edit', ['id' => $user->id]) }}" class="btn btn-danger">
                                <i class="btn3 fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>

                    @endforeach
                    @if($users->isEmpty() && $filter === 'Aktif')
                    <tr>
                        <td colspan="6" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada user yang active</p>
                        </td>
                    </tr>
                    @elseif($users->isEmpty() && $filter === 'Tidak Aktif')
                    <tr>
                        <td colspan="6" class="text-center">
                            <img src="{{ asset('img/1.png') }}" alt="none">
                            <p>Tidak ada user</p>
                        </td>
                    </tr>
                    @else
                    {{-- Your table rows for displaying users --}}
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection