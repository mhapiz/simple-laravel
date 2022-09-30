@extends('layouts.admin')

@section('title')
    Home
@endsection


@section('content')
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Kamar</div>
                <div class="number">{{ $totalKamar }}</div>
            </div>
            <i class='bx bxs-hotel cart'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Kamar Tersedia</div>
                <div class="number">{{ $totalKamarTersedia }}</div>
            </div>
            <i class='bx bxs-hotel cart'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Tamu Saat Ini</div>
                <div class="number">{{ $totalTamuSaatIni }}</div>
            </div>
            <i class='bx bxs-user cart'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Tamu</div>
                <div class="number">{{ $totalTamu }}</div>
            </div>
            <i class='bx bxs-user cart'></i>
        </div>
    </div>

    <div class="sales-boxes">
        <div class="recent-sales box">
            <div class="title">Baru Checkout</div>
            <div class="sales-details" style="margin-top: 20px">
                <ul class="details">
                    <li class="topic">Tanggal Check Out</li>
                    @foreach ($oldGuests as $g)
                        <li>{{ Carbon\Carbon::parse($g->tgl_cekout)->isoFormat('D MMMM Y') }}</li>
                    @endforeach

                </ul>
                <ul class="details">
                    <li class="topic">Nama Tamu</li>
                    @foreach ($oldGuests as $g)
                        <li>{{ $g->nama_pemesan }}</li>
                    @endforeach

                </ul>
                <ul class="details">
                    <li class="topic">Kamar</li>
                    @foreach ($oldGuests as $g)
                        <li>{{ $g->kamar->nama_kamar }}</li>
                    @endforeach

                </ul>
                <ul class="details">
                    <li class="topic">Total Bayar</li>
                    @foreach ($oldGuests as $g)
                        <li>Rp {{ number_format($g->total_bayar, 0, ',', '.') }}</li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
@endsection
