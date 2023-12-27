@extends('head')

@section('content')
    <div class="main">
        <div class="main-top">
            <h1>Beranda</h1>
        </div>
        <!-- <div class="search">
            <i class="fa fa-search"></i>
            <input type="text" name="" class="input1" placeholder="Search">
        </div> -->
        <div class="watch">
            <div class="sass">
                <div class="robo">
                    <div class="dish">
                        <div class="place">
                            <h5>Cuti Pending</h5>
                        </div>
                        <div class="hire">
                            <h5>{{ $cuti }}</h5>
                        </div>
                    </div>
                </div>
                <div class="robo">
                    <div class="dish">
                        <div class="place">
                            <h5>Dinas Pending</h5>
                        </div>
                        <div class="hire">
                            <h5>{{ $dinas }}</h5>
                        </div>
                    </div>
                </div>
                <div class="robo">
                    <div class="dish">
                        <div class="place">
                            <h5>Karyawan Aktif</h5>
                        </div>
                        <div class="hire">
                            <h5>{{ $user }}</h5>
                        </div>
                    </div>
                </div>
                <div class="robo">
                    <div class="dish">
                        <div class="place">
                            <h5>Mitra Aktif</h5>
                        </div>
                        <div class="hire">
                            <h5>{{ $mitra }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection