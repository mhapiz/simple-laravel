@extends('layouts.admin')

@section('title')
    {{ $pageTitle }}
@endsection


@section('content')
    <div class="form-box">
        <h4> {{ $pageTitle }}
        </h4>
        <br>
        <form action="{{ route('admin.sewa-kamar.storeCheckout2', $data->id_sewa_kamar) }}" method="POST">
            @csrf
            @method('PUT')
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
                    <th style="width: 300px">Terlambat Check Out</th>
                    <td>{{ $selisihHari }} Hari</td>
                </tr>
            </table>

            <div class="input-group">
                <label>Biaya Denda</label>
                <input type="text" name="biaya_denda" class="form-control" placeholder="Biaya Denda"
                    value="{{ $data->biaya_denda }}">
                <small>
                    <span>*</span>
                    Biaya Denda = (Harga Kamar Per Malam + 50.000) x Jumlah hari terlambat
                </small>
                @error('biaya_denda')
                    <small>
                        <span>*</span>
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="input-group">

                <div class="input-group">
                    <label>Biaya Tambahan</label>
                    <input type="text" name="biaya_tambahan" class="form-control" placeholder="Biaya Tambahan"
                        value="{{ $data->biaya_tambahan }}">

                    @error('biaya_tambahan')
                        <small>
                            <span>*</span>
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="input-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" rows="4" class="form-control">{{ $data->keterangan }}</textarea>
                    @error('keterangan')
                        <small>
                            <span>*</span>
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                {{-- <div class="input-group">
                    <label>Total Bayar</label>
                    <input type="text" name="total_bayar" class="form-control" placeholder="Total Bayar"
                        value="{{ $data->total_bayar }}">
                    @error('total_bayar')
                        <small>
                            <span>*</span>
                            {{ $message }}
                        </small>
                    @enderror
                </div> --}}

                <br>
                <button type="submit" class="btn btn-primary">
                    Selanjutnya
                </button>
        </form>
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
