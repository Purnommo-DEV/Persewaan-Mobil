<?php

namespace App\Http\Controllers\Peminjam;

use App\Models\Mobil;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DaftarPeminjaman_Controller extends Controller
{
    public function daftar_peminjaman()
    {
        $daftar_peminjaman = Peminjaman::where('users_id', Auth::user()->id)->get();
        return view('Back.Peminjam.DaftarPeminjaman.daftar_peminjaman', compact('daftar_peminjaman'));
    }

    public function proses_pengembalian_mobil(Request $request)
    {
        $data_peminjaman = Peminjaman::where('id', $request->id)->first();
        $data_mobil = Mobil::where('id', $data_peminjaman->mobil_id)->first();

        $data_mobil->update([
            'status' => 0
        ]);

        $data_peminjaman->update([
            'status' => 2
        ]);
        return redirect()->route('peminjam.HalamanDaftarPengembalian');
    }
}
