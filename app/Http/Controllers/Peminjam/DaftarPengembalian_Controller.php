<?php

namespace App\Http\Controllers\Peminjam;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DaftarPengembalian_Controller extends Controller
{
    public function daftar_pengembalian()
    {
        $data_pengembalian = Peminjaman::where([['users_id', Auth::user()->id], ['status', 2]])->get();
        return view('Back.Peminjam.DaftarPengembalian.daftar_pengembalian', compact('data_pengembalian'));
    }
}
