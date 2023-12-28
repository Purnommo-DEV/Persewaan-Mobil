<?php

namespace App\Http\Controllers\Peminjam;

use Carbon\Carbon;
use App\Models\Mobil;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PeminjamDataMobil_Controller extends Controller
{
    public function daftar_mobil()
    {
        $data_mobil = Mobil::get();
        return view('Back.Peminjam.Mobil.daftar_mobil', compact('data_mobil'));
    }

    public function proses_pesan_mobil(Request $request)
    {
        $data_mobil = Mobil::where('nomor_plat', $request->nomor_plat)->first();
        $tgl_mulai = new Carbon($request->tanggal_mulai);
        $tgl_akhir = new Carbon($request->tanggal_akhir);
        $durasi = Carbon::parse($tgl_mulai)->diffInDays($tgl_akhir);
        $total_biaya_sewa = $data_mobil->tarif_harian * $durasi;
        $data_mobil->update([
            'status' => 1
        ]);
        Peminjaman::create([
            'users_id' => Auth::user()->id,
            'mobil_id' => $data_mobil->id,
            'tanggal_mulai' => $tgl_mulai,
            'tanggal_akhir' => $tgl_akhir,
            'durasi' => $durasi,
            'total_biaya_sewa' => $total_biaya_sewa,
            'status' => 1
        ]);

        return redirect()->route('peminjam.HalamanDaftarPeminjaman');
    }
}
