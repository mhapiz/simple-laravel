@extends('layouts.admin')
@section('title')
    {{ $pageTitle }}
@endsection


@section('content')
    <div class="table-box">
        <div class="table-title">
            <h4>{{ $pageTitle }}</h4>

            <a href="{{ route('admin.kamar.create') }}" class="btn btn-primary">
                Tambah
            </a>
        </div>
        <br>
        <table class="table-bordered" id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kamar</th>
                    <th>Jenis Kamar</th>
                    <th>Harga Kamar</th>
                    <th>Ketersediaan</th>
                    <th style="width: 200px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        {{-- <div class="pagination">
            <a href="#">
                <i class='bx bx-chevron-left'></i>
            </a>
            <a href="#">
                <i class='bx bx-chevron-right'></i>
            </a>
        </div> --}}
    </div>
@endsection

@push('tambahStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('tambahScript')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        function htmlDecode(data) {
            var txt = document.createElement('textarea');
            txt.innerHTML = data;
            return txt.value
        }

        $(document).ready(function() {
            $('#table').DataTable({
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json",
                    "sEmptyTable": "Tidak Ada Data"
                },
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.kamar.getData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_kamar',
                        name: 'nama_kamar'
                    },
                    {
                        data: 'jenis_kamar',
                        name: 'jenis_kamar'
                    },
                    {
                        data: 'harga_kamar',
                        name: 'harga_kamar'
                    },
                    {
                        data: 'ketersediaan',
                        name: 'ketersediaan'
                    },
                    {
                        data: "aksi",
                        render: function(data) {
                            return htmlDecode(data);
                        },
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });
    </script>
@endpush
