<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function halaman_register()
    {
        return view('register');
    }
    public function user_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'alamat' => 'required',
            'nomor_telpon' => 'required',
            'nomor_sim' => 'required',
        ], [
            'name.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
            'email.email' => 'Harus berupa email @',
            'email.unique' => 'Email yang anda masukkan telah terdaftar',
            'password.required' => 'Wajib diisi',
            'password.min' => 'Minimal 8 karakter',
            'alamat.required' => 'Wajib diisi',
            'nomor_telpon.required' => 'Wajib diisi',
            'nomor_sim.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $user_register = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nomor_telpon' => $request->nomor_telpon,
                'nomor_sim' => $request->nomor_sim,
                'kode_pengguna' => 'PMJ-' . Str::random('32'),
                'password' => Hash::make($request->password),
                'role_id' => 2
            ]);

            if (!$user_register) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Register'
                ]);
            } else {
                return response()->json([
                    'status_berhasil' => 1,
                    'msg' => 'Berhasil Melakukan Registrasi',
                    'route' => route('Login')
                ]);
            }
        }
    }
}
