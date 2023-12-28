<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Validator;

class PemilikMobil_Controller extends Controller
{
    public function data_mobil()
    {
        $data_mobil = Mobil::get();
        return view('Back.Mobil.data_mobil', compact('data_mobil'));
    }

    public function tambah_data_mobil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merek' => 'required',
            'model' => 'required',
            'nomor_plat' => 'required',
            'tarif_harian' => 'required'
        ], [
            'merek.required' => 'Nama Wajib diisi',
            'model.required' => 'Nama Wajib diisi',
            'nomor_plat.required' => 'Nama Wajib diisi',
            'tarif_harian.required' => 'Nama Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            Mobil::create([
                'merek' => $request->merek,
                'model' => $request->model,
                'nomor_plat' => $request->nomor_plat,
                'tarif_harian' => $request->tarif_harian,
                'status' => 0
            ]);

            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil menambahkan Mobil'
            ]);
        }
    }

    public function edit_data_mobil($nomor_plat)
    {
        $data_mobil = Mobil::where('nomor_plat', $nomor_plat)->first();
        return view('Back.Mobil.edit_mobil', compact('data_mobil'));
    }

    // public function proses_edit_data_mobil(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'merek' => 'required',
    //         'model' => 'required',
    //         'nomor_plat' => 'required',
    //         'tarif_harian' => 'required'
    //     ], [
    //         'merek.required' => 'Nama Wajib diisi',
    //         'model.required' => 'Nama Wajib diisi',
    //         'nomor_plat.required' => 'Nama Wajib diisi',
    //         'tarif_harian.required' => 'Nama Wajib diisi',
    //     ]);

    //     if (!$validator->passes()) {
    //         return response()->json([
    //             'status_form_kosong' => 1,
    //             'error' => $validator->errors()->toArray()
    //         ]);
    //     } else {
    //         // $data_mobil = Mobil
    //         Mobil::create([
    //             'merek' => $request->merek,
    //             'model' => $request->model,
    //             'nomor_plat' => $request->nomor_plat,
    //             'tarif_harian' => $request->tarif_harian,
    //             'status' => 0
    //         ]);

    //         return response()->json([
    //             'status_berhasil_daftar' => 1,
    //             'msg' => 'Berhasil Melakukan Registrasi',
    //             'route' => route('Login')
    //         ]);
    //     }
    // }

    public function data_peminjaman()
    {
        $data_peminjam = Peminjaman::with('peminjam_relasi', 'mobil_relasi')->where('status', 1)->get();
        return view('Back.Mobil.peminjam', compact('data_peminjam'));
    }
}
