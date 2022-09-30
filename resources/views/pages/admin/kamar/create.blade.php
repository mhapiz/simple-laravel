@extends('layouts.admin')

@section('title')
    {{ $pageTitle }}
@endsection


@section('content')
    <div class="form-box">
        <h4> {{ $pageTitle }}
        </h4>
        <form action="{{ route('admin.kamar.store') }}" method="POST">
            @csrf
            <div class="input-group">
                <label>Nama Kamar</label>
                <input type="text" name="nama_kamar" class="form-control" placeholder="Nama Kamar">
                @error('nama_kamar')
                    <small>
                        <span>*</span>
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="input-group">
                <label>Jenis Kamar</label>
                <input type="text" name="jenis_kamar" class="form-control" placeholder="Jenis Kamar">
                @error('jenis_kamar')
                    <small>
                        <span>*</span>
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="input-group">
                <label>Harga Kamar Per Malam</label>
                <input type="text" name="harga_kamar" class="form-control" placeholder="Harga Kamar Per Malam">
                @error('harga_kamar')
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
