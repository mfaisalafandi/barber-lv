<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.karyawan.index', [
            'karyawans' => Karyawan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.karyawan.create', [
            'cabangs' => Cabang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'jk' => 'required',
            'telp' => 'required|max:15|min:10',
            'alamat' => 'required',
            'cabang_id' => 'required',
            'email' => 'required|email:dns|unique:users',
            'image' => 'image|file|max:1024'
        ]);

        $validatedDataUser = $request->validate([
            'email' => 'required|email:dns|unique:users',
        ]);

        $validatedDataKaryawan = $request->validate([
            'name' => 'required|max:255',
            'jk' => 'required',
            'telp' => 'required|max:15|min:10',
            'alamat' => 'required',
            'image' => 'image|file|max:1024',
            'cabang_id' => 'required',
        ]);

        $validatedDataUser['password'] = Hash::make("password");
        $validatedDataUser['level'] = 1;

        $user = User::create($validatedDataUser);

        if ($request->file('image')) {
            $validatedDataKaryawan['image'] = $request->file('image')->store('images-karyawan');
        }

        $validatedDataKaryawan['user_id'] = $user->id;

        Karyawan::create($validatedDataKaryawan);

        $request = session();
        return redirect('/dashboard/karyawan')->with('success', 'Karyawan Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('dashboard.karyawan.edit', [
            'karyawan' => $karyawan,
            'cabangs' => Cabang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        if ($karyawan->image) {
            Storage::delete($karyawan->image);
        }
        Karyawan::destroy($karyawan->id);
        return redirect('/dashboard/karyawan')->with('success', 'Karyawan Berhasil Dihapus!!');
    }
}
