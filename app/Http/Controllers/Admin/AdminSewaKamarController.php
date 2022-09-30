<?php

namespace App\Http\Controllers\Admin;

use App\Models\SewaKamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminSewaKamarController extends Controller
{
    private  $pageTitle = 'Data Sewa Kamar';
    public function index()
    {
        return view('pages.admin.sewa-kamar.index', [
            'pageTitle' => $this->pageTitle
        ]);
    }

    public function getData(Request $request)
    {
        if ($request->statusOrder == 'Sedang Berjalan') {
            $data = SewaKamar::with('kamar')->whereNull('tgl_cekout')->latest();
        } elseif ($request->statusOrder == 'Selesai') {
            $data = SewaKamar::with('kamar')->whereNot('tgl_cekout',  NULL)->latest();
        } else {
            $data = SewaKamar::with('kamar')->orderBy('tgl_cekout', 'asc')->latest();
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $id = $row->id_sewa_kamar;
                if ($row->tgl_cekout) {
                    $status = 'selesai';
                } else {
                    $status = 'berjalan';
                }
                return view('modules._formActions2', compact('id', 'status'));
            })
            ->editColumn('tgl_cekin', function ($row) {
                return Carbon::parse($row->tgl_cekin)->isoFormat('D MMMM Y');
            })
            ->editColumn('lama_menginap', function ($row) {
                return $row->lama_menginap . ' malam';
            })
            ->editColumn('status', function ($row) {
                if ($row->tgl_cekout) {
                    return 'Selesai';
                } else {
                    return 'Sedang Berjalan';
                }
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $kamar = Kamar::where('ketersediaan', 'tersedia')->get();
        return view('pages.admin.sewa-kamar.create', [
            'pageTitle' => $this->pageTitle,
            'kamar' => $kamar
        ]);
    }

    public function store(Request $request)
    {
        $req = $request->validate([
            'nama_pemesan' => 'required',
            'alamat_pemesan' => 'required',
            'kamar_id' => 'required',
            'tgl_cekin' => 'required',
            'lama_menginap' => 'required',
        ]);

        SewaKamar::create($req);

        $kamar = Kamar::find($req['kamar_id']);

        $kamar->update([
            'ketersediaan' => 'isi'
        ]);

        Alert::toast('Data berhasil ditambahkan', 'success');
        return redirect()->route('admin.sewa-kamar.index');
    }

    public function edit($id)
    {
        $data = SewaKamar::find($id);
        $kamar = Kamar::where([['ketersediaan', 'tersedia']])->get();
        return view('pages.admin.sewa-kamar.edit', [
            'pageTitle' => $this->pageTitle,
            'kamar' => $kamar,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req = $request->validate([
            'nama_pemesan' => 'required',
            'alamat_pemesan' => 'required',
            'kamar_id' => 'required',
            'tgl_cekin' => 'required',
            'lama_menginap' => 'required',
        ]);

        $data = SewaKamar::find($id);

        if ($req['kamar_id'] != $data->kamar_id) {
            $kamarOld = Kamar::find($data->kamar_id);

            $kamarOld->update([
                'ketersediaan' => 'tersedia'
            ]);
            //
            $kamarNew = Kamar::find($req['kamar_id']);

            $kamarNew->update([
                'ketersediaan' => 'isi'
            ]);
        }

        $data->update($req);


        Alert::toast('Data berhasil diubah', 'success');
        return redirect()->route('admin.sewa-kamar.index');
    }

    public function checkout1($id)
    {
        $data = SewaKamar::with(['kamar'])->find($id);

        return view('pages.admin.sewa-kamar.checkout1', [
            'pageTitle' => $this->pageTitle,
            'data' => $data,
        ]);
    }

    public function storeCheckout1(Request $request, $id)
    {
        $req = $request->validate([
            'tgl_cekout' => 'required',
        ]);

        $data = SewaKamar::with(['kamar'])->find($id);

        $cekIn = Carbon::parse($data->tgl_cekin);
        $harusCheckout = $cekIn->addDays($data->lama_menginap);
        $cekOut = Carbon::parse($req['tgl_cekout']);

        if ($cekOut > $harusCheckout) {
            $selisihHari = $cekOut->diffInDays($harusCheckout);
            $req['biaya_denda'] = ($selisihHari * ($data->kamar->harga_kamar + 50000));
            $req['total_bayar'] = ($data->kamar->harga_kamar * $data->lama_menginap) + $req['biaya_denda'];
            $req['keterangan'] = "Denda telat checkout " . $selisihHari . " hari sebesar " . $req['biaya_denda'];
        } else {
            $req['total_bayar'] = ($data->kamar->harga_kamar * $data->lama_menginap);
        }

        $data->update($req);

        return redirect()->route('admin.sewa-kamar.checkout2', $id,);
    }


    public function checkout2($id)
    {
        $data = SewaKamar::with(['kamar'])->find($id);

        $cekIn = Carbon::parse($data->tgl_cekin);
        $harusCheckout = $cekIn->addDays($data->lama_menginap);
        $cekOut = Carbon::parse($data->tgl_cekout);

        $selisihHari = $cekOut->diffInDays($harusCheckout);

        if ($selisihHari < 0) {
            $selisihHari = 0;
        }

        return view('pages.admin.sewa-kamar.checkout2', [
            'pageTitle' => $this->pageTitle,
            'data' => $data,
            'selisihHari' => $selisihHari,
        ]);
    }


    public function storeCheckout2(Request $request, $id)
    {
        $req = $request->validate([
            'biaya_denda' => 'nullable',
            'biaya_tambahan' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        $data = SewaKamar::with(['kamar'])->find($id);

        if ($req['biaya_denda'] != null && $req['biaya_tambahan'] != null) {
            $req['total_bayar'] = $data->total_bayar + $req['biaya_tambahan'];
        }

        $kamar = Kamar::find($data->kamar_id);

        $kamar->update([
            'ketersediaan' => 'tersedia'
        ]);

        $data->update($req);

        Alert::toast('Berhasil Checkout', 'success');
        return redirect()->route('admin.sewa-kamar.detail', $id);
    }

    public function detail($id)
    {
        $data = SewaKamar::with(['kamar'])->find($id);

        return view('pages.admin.sewa-kamar.detail', [
            'pageTitle' => $this->pageTitle,
            'data' => $data,
        ]);
    }

    public function delete($id)
    {
        $data = SewaKamar::find($id);
        $data->delete();

        Alert::toast('Data berhasil dihapus', 'info');
        return redirect()->route('admin.sewa-kamar.index');
    }
}
