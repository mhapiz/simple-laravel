<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminKamarController extends Controller
{
    private  $pageTitle = 'Data Kamar';
    public function index()
    {
        return view('pages.admin.kamar.index', [
            'pageTitle' => $this->pageTitle
        ]);
    }

    public function getData()
    {
        $data = Kamar::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.kamar.edit', $row->id_kamar);
                $deleteUrl = route('admin.kamar.delete', $row->id_kamar);

                return view('modules._formActions', compact('editUrl', 'deleteUrl'));
            })
            ->editColumn('harga_kamar', function ($row) {
                return 'Rp ' . number_format($row->harga_kamar, 0, ',', '.');
            })
            ->editColumn('ketersediaan', function ($row) {
                if ($row->ketersediaan == 'tersedia') {
                    return 'Kosong';
                } else {
                    return 'Ditempati';
                }
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('pages.admin.kamar.create', [
            'pageTitle' => $this->pageTitle
        ]);
    }

    public function store(Request $request)
    {
        $req = $request->validate([
            'nama_kamar' => 'required',
            'jenis_kamar' => 'required',
            'harga_kamar' => 'required',
        ]);

        $req['ketersediaan'] = 'tersedia';

        Kamar::create($req);

        Alert::toast('Data berhasil ditambahkan', 'success');
        return redirect()->route('admin.kamar.index');
    }

    public function edit($id)
    {
        $data = Kamar::find($id);
        return view('pages.admin.kamar.edit', [
            'pageTitle' => $this->pageTitle,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req = $request->validate([
            'nama_kamar' => 'required',
            'jenis_kamar' => 'required',
            'harga_kamar' => 'required',
        ]);

        $data = Kamar::find($id);

        $data->update($req);

        Alert::toast('Data berhasil diubah', 'success');
        return redirect()->route('admin.kamar.index');
    }

    public function delete($id)
    {
        $data = Kamar::find($id);
        $data->delete();

        Alert::toast('Data berhasil dihapus', 'info');
        return redirect()->route('admin.kamar.index');
    }
}
