@extends('layouts.admin')

@section('title')
    {{ $pageTitle }}
@endsection


@section('content')
    <div class="form-box">
        <h4> {{ $pageTitle }}
        </h4>
        <form action="{{ route('admin.sewa-kamar.update', $data->id_sewa_kamar) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-group">
                <label>Nama Pemesan</label>
                <input type="text" name="nama_pemesan" class="form-control" placeholder="Nama Pemesan"
                    value="{{ $data->nama_pemesan }}">
                @error('nama_pemesan')
                    <small>
                        <span>*</span>
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="input-group">
                <label>Alamat Pemesan</label>
                <textarea name="alamat_pemesan" rows="4" class="form-control">{{ $data->alamat_pemesan }}</textarea>
                @error('alamat_pemesan')
                    <small>
                        <span>*</span>
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="input-group">
                <label>Kamar</label>
                <select name="kamar_id" class="form-control" id="select2">
                    <option></option>
                    <option value="{{ $data->kamar_id }}" selected>
                        {{ App\Models\Kamar::find($data->kamar_id)->nama_kamar }}</option>
                    @foreach ($kamar as $k)
                        <option value="{{ $k->id_kamar }}">
                            {{ $k->nama_kamar }}</option>
                    @endforeach
                </select>
                @error('kamar_id')
                    <small>
                        <span>*</span>
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="input-group">
                <label>Tanggal Check In</label>
                <input type="text" name="tgl_cekin" class="form-control" placeholder="Tanggal Check In" id="tgl_cekin"
                    value="{{ $data->tgl_cekin }}">
                @error('tgl_cekin')
                    <small>
                        <span>*</span>
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="input-group">
                <label>Lama Menginap (Malam)</label>
                <input type="text" name="lama_menginap" class="form-control" placeholder="Lama Menginap (Malam)"
                    value="{{ $data->lama_menginap }}">
                @error('lama_menginap')
                    <small>
                        <span>*</span>
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-primary">
                Submit
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
