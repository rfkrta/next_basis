@extends('head')

@section('content')
    <div class="main">
        <div class="main-top">
            <h1>Dinas</h1>
        </div>
        <div class="view">
            <div class="search">
                <i class="fa fa-search"></i>
                <form id="searchForm" action="{{ route('searchByNameDinas') }}" method="GET">
                    <input type="text" class="input1" name="search" id="searchInput" placeholder="Cari berdasarkan nama" value="{{ $search }}">
                </form>
                <!-- <input type="text" name="" class="input1" placeholder="Search"> -->
            </div>
            <div class="plus">
                <i class="fa fa-plus"></i>
                <a href="{{ route('admin.perjalanandinas.create') }}">Perjalanan Dinas</a>
            </div>
        </div>

        <div class="filter">
            <ul class="filterx">
                <li class="{{ request()->input('status') === null ? 'activev' : '' }}">
                    <a href="{{ route('admin.perjalanandinas.index') }}">Semua</a>
                </li>
            </ul>
            <ul class="filterx">
                <li class="{{ request()->input('status') === 'Selesai' ? 'activev' : '' }}">
                    <a href="{{ route('admin.perjalanandinas.index', ['status' => 'Selesai']) }}">Selesai</a>
                </li>
            </ul>
            <ul class="filterx">
                <li class="{{ request()->input('status') === 'Berjalan' ? 'activev' : '' }}">
                    <a href="{{ route('admin.perjalanandinas.index', ['status' => 'Berjalan']) }}">Berjalan</a>
                </li>
            </ul>
            <ul class="filterx">
                <li class="{{ request()->input('status') === 'Tertunda' ? 'activev' : '' }}">
                    <a href="{{ route('admin.perjalanandinas.index', ['status' => 'Tertunda']) }}">Tertunda</a>
                </li>
            </ul>
        </div>
        <div class="line7"></div>
<<<<<<< Updated upstream
        <div class="cong-box">
            <div>
                <table class="box" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="lebarTabel">No</th>
                            <th>Perusahaan</th>
                            <th>Kota Keberangkatan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dinas as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->mitra->nama_mitra }}</td>
                                <td>{{ $item->regency->name }}</td>
                                <td>{{ $item->tanggal_mulai }}</td>
                                <td>{{ $item->tanggal_selesai }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.perjalanandinas.show', $item->id) }}" class="btn btn-danger">
                                            <i class="btn1 fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.perjalanandinas.edit', $item->id) }}" class="btn btn-danger">
                                            <i class="btn3 fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger">
                                            <i class="btn2 fa fa-print"></i>
                                        </a>
                                        <form id="formDiterima" method="POST" action="{{ route('admin.perjalanandinas.updateToDiterima', $item->id) }}" onsubmit="return confirm('Anda yakin ingin menerima pengajuan ini?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-dangger" id="btnDiterima">
                                                <i class="btn1 fa fa-check"></i>
                                            </button>
                                        </form>
                                        <!-- Form to update status to Ditolak -->
                                        <form id="formDitolak" method="POST" action="{{ route('admin.perjalanandinas.updateToDitolak', $item->id) }}" onsubmit="return confirm('Anda yakin ingin menolak pengajuan ini?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger" id="btnDitolak">
                                                <i class="btn2 fa fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            @if($dinas->isEmpty() && $status === null)
                            <tr>
                                <td colspan="7" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada perjalanan dinas</p>
                                </td>
                            </tr>
                            @elseif($dinas->isEmpty() && $status === 'Selesai')
                            <tr>
                                <td colspan="7" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada perjalanan dinas Selesai</p>
                                </td>
                            </tr>
                            @elseif($dinas->isEmpty() && $status === 'Berjalan')
                            <tr>
                                <td colspan="7" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada perjalanan dinas Berjalan</p>
                                </td>
                            </tr>
                            @elseif($dinas->isEmpty() && $status === 'Tertunda')
                            <tr>
                                <td colspan="7" class="text-center">
                                    <img src="{{ asset('img/1.png') }}" alt="none">
                                    <p>Tidak ada perjalanan dinas Tertunda</p>
                                </td>
                            </tr>
                            @endif
                        @endforelse
                    </tbody>
                </table>
            </div>
=======
        <div id="content">
        <!-- Content area goes here -->
            <table class="table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="lebarTabel">No</th>
                        <th>Perusahaan</th>
                        <th>Kota Keberangkatan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dinas as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->mitra->nama_mitra }}</td>
                            <td>{{ $item->regency->name }}</td>
                            <td>{{ $item->tanggal_mulai }}</td>
                            <td>{{ $item->tanggal_selesai }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.perjalanandinas.show', $item->id) }}" class="btn btn-danger">
                                        <i class="btn1 fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.perjalanandinas.edit', $item->id) }}" class="btn btn-danger">
                                        <i class="btn3 fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="btn2 fa fa-print"></i>
                                    </a>
                                    <form id="formDiterima" method="POST" action="{{ route('admin.perjalanandinas.updateToDiterima', $item->id) }}" onsubmit="return confirm('Anda yakin ingin menerima pengajuan ini?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-dangger" id="btnDiterima">
                                            <i class="btn1 fa fa-check"></i>
                                        </button>
                                    </form>
                                    <!-- Form to update status to Ditolak -->
                                    <form id="formDitolak" method="POST" action="{{ route('admin.perjalanandinas.updateToDitolak', $item->id) }}" onsubmit="return confirm('Anda yakin ingin menolak pengajuan ini?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger" id="btnDitolak">
                                            <i class="btn2 fa fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        @if($dinas->isEmpty() && $status === null)
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('img/1.png') }}" alt="none">
                                <p>Tidak ada perjalanan dinas</p>
                            </td>
                        </tr>
                        @elseif($dinas->isEmpty() && $status === 'Selesai')
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('img/1.png') }}" alt="none">
                                <p>Tidak ada perjalanan dinas yang Selesai</p>
                            </td>
                        </tr>
                        @elseif($dinas->isEmpty() && $status === 'Berjalan')
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('img/1.png') }}" alt="none">
                                <p>Tidak ada perjalanan dinas yang Berjalan</p>
                            </td>
                        </tr>
                        @elseif($dinas->isEmpty() && $status === 'Tertunda')
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('img/1.png') }}" alt="none">
                                <p>Tidak ada perjalanan dinas yang Tertunda</p>
                            </td>
                        </tr>
                        @elseif($noData)
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('img/1.png') }}" alt="none">
                                <p>Tidak ada perjalanan dinas</p>
                            </td>
                        </tr>
                        @endif
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <ul class="pagination">
                {{ $dinas->links() }}
            </ul>
>>>>>>> Stashed changes
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