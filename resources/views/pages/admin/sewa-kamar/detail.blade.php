@extends('layouts.admin')

@section('title')
    {{ $pageTitle }}
@endsection


@section('content')
    <div class="form-box">
        <h4> {{ $pageTitle }}
        </h4>
        <br>
        <table class="tableku text-start">
            <tr>
                <th style="width: 300px">Nama Pemesan</th>
                <td>{{ $data->nama_pemesan }}</td>
            </tr>
            <tr>
                <th style="width: 300px">Alamat Pemesan</th>
                <td>{{ $data->alamat_pemesan }}</td>
            </tr>
            <tr>
                <th style="width: 300px">Kamar</th>
                <td>{{ $data->kamar->nama_kamar }}</td>
            </tr>
            <tr>
                <th style="width: 300px">Jenis Kamar</th>
                <td>{{ $data->kamar->jenis_kamar }}</td>
            </tr>
            <tr>
                <th style="width: 300px">Harga Kamar Permalam</th>
                <td>Rp {{ number_format($data->kamar->harga_kamar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th style="width: 300px">Tanggal Check In</th>
                <td>{{ Carbon\Carbon::parse($data->tgl_cekin)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <th style="width: 300px">Lama Menginap</th>
                <td>{{ $data->lama_menginap }} Malam</td>
            </tr>
            <tr>
                <th style="width: 300px">Tanggal Check Out</th>
                <td>{{ Carbon\Carbon::parse($data->tgl_cekout)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <th style="width: 300px">Biaya Kamar x Lama Menginap</th>
                <td>Rp {{ number_format($data->kamar->harga_kamar * $data->lama_menginap, 0, ',', '.') }}</td>
            </tr>
            @php
                $cekIn = Carbon\Carbon::parse($data->tgl_cekin);
                $harusCheckout = $cekIn->addDays($data->lama_menginap);
                $cekOut = Carbon\Carbon::parse($data->tgl_cekout);
                $selisihHari = $cekOut->diffInDays($harusCheckout);
            @endphp
            <tr>
                <th style="width: 300px">Terlambat Check Out</th>
                <td>{{ $selisihHari }} Hari</td>
            </tr>
            <tr>
                <th style="width: 300px">Biaya Denda</th>
                <td>Rp {{ number_format($data->biaya_denda, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th style="width: 300px">Biaya Tambahan</th>
                <td>Rp {{ number_format($data->biaya_tambahan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th style="width: 300px">Keterangan</th>
                <td>
                    <p style="white-space: pre-line">{!! $data->keterangan !!}</p>
                </td>
            </tr>
            <tr>
                <th style="width: 300px">Total Semua</th>
                <td>Rp {{ number_format($data->total_bayar, 0, ',', '.') }}</td>
            </tr>

        </table>
        <br>
        <a href="{{ route('admin.sewa-kamar.index') }}" class="" style="font-size: 48px">
            <i class='bx bx-chevron-left'></i>
        </a>

    </div>
@endsection

@push('tambahStyle')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush


@push('tambahScript')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script>
        $('#select2').select2({
            placeholder: "Pilih ...",
        });

        flatpickr.localize(flatpickr.l10ns.id);
        $('#tgl_cekout, #tgl_cekin').flatpickr({
            allowInput: true,
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
        });
    </script>
@endpush
