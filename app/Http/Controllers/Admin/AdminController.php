<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\SewaKamar;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function test()
    {
        return view('pages.auth.login');
    }

    public function index()
    {
        $pageTitle = 'Dashboard';
        $totalKamar = Kamar::count();
        $totalKamarTersedia = Kamar::where('ketersediaan', 'tersedia')->count();
        $totalTamuSaatIni = SewaKamar::where('tgl_cekout', NULL)->count();
        $totalTamu = SewaKamar::count();

        $oldGuests = SewaKamar::with('kamar')->whereNot('tgl_cekout', NULL)->orderBy('tgl_cekout', 'DESC')->limit(5)->get();

        return view('pages.admin.dashboard', [
            'pageTitle' => $pageTitle,
            'totalKamar' => $totalKamar,
            'totalKamarTersedia' => $totalKamarTersedia,
            'totalTamuSaatIni' => $totalTamuSaatIni,
            'totalTamu' => $totalTamu,
            'oldGuests' => $oldGuests,
        ]);
    }
}
