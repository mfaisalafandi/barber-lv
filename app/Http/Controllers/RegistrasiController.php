<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('proses.registrasi');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'jk' => 'required',
            'telp' => 'required|max:15|min:10',
            'alamat' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255|'
        ]);

        $validatedDataUser = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255|'
        ]);

        $validatedDataPelanggan = $request->validate([
            'name' => 'required|max:255',
            'jk' => 'required',
            'telp' => 'required|max:15|min:10',
            'alamat' => 'required',
        ]);

        $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
        $validatedDataUser['level'] = 0;

        $user = User::create($validatedDataUser);

        $validatedDataPelanggan['user_id'] = $user->id;

        Pelanggan::create($validatedDataPelanggan);

        $request = session();
        // $request->session()->flash('success', 'Registration Success!');
        return redirect('/login')->with('success', 'Registrasi Berhasil');
    }
}
