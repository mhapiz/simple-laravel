@extends('layouts.admin')

@section('title')
    {{ $pageTitle }}
@endsection


@section('content')
    <div class="table-box">
        <div class="table-title">
            <h4>{{ $pageTitle }}</h4>
            <a href="{{ route('admin.sewa-kamar.create') }}" class="btn btn-primary">
                Tambah
            </a>
        </div>
        <br>
        <div class="table-title" style="width: 25%; gap: 4px">
            <select name="statusOrder" id="statusOrder" class="form-control" style="margin-top: 0">
                <option value="Sedang Berjalan">Sedang Berjalan</option>
                <option value="Selesai">Selesai</option>
                <option value="Semua">Semua</option>
            </select>
            <a href="javascript:void()" id="filterBtn" class="btn btn-info">
                <i class='bx bx-filter' style="margin-right: 4px"></i>
                Filter
            </a>
        </div>
        <br>
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pemesan</th>
                    <th>Nama Kamar</th>
                    <th>Jenis Kamar</th>
                    <th>Lama Menginap</th>
                    <th>Tgl Check In</th>
                    <th>Status</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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
        $(document).ready(function() {

            function htmlDecode(data) {
                var txt = document.createElement('textarea');
                txt.innerHTML = data;
                return txt.value
            }

            loadData();

            function loadData(statusOrder = 'Sedang Berjalan') {
                $(document).ready(function() {
                    $('#table').DataTable({
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json",
                            "sEmptyTable": "Tidak Ada Data"
                        },
                        processing: true,
                        serverside: true,
                        ajax: {
                            url: "{{ route('admin.sewa-kamar.getData') }}",
                            data: {
                                statusOrder: statusOrder,
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'nama_pemesan',
                                name: 'nama_pemesan'
                            },
                            {
                                data: 'kamar.nama_kamar',
                                name: 'kamar.nama_kamar'
                            },
                            {
                                data: 'kamar.jenis_kamar',
                                name: 'kamar.jenis_kamar'
                            },
                            {
                                data: 'lama_menginap',
                                name: 'lama_menginap'
                            },
                            {
                                data: 'tgl_cekin',
                                name: 'tgl_cekin'
                            },
                            {
                                data: 'status',
                                name: 'status'
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
            }

            $('#filterBtn').click(function() {
                var statusOrder = $('#statusOrder').val();
                if (statusOrder != '') {
                    $('#table').DataTable().destroy();
                    loadData(statusOrder);
                } else {
                    $('#table').DataTable().destroy();
                    loadData();
                }
            });
        });
    </script>
@endpush
