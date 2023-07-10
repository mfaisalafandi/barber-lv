<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class DashboardCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.cabang.index', [
            'cabangs' => Cabang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.cabang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'telp' => 'required|max:15|min:9',
            'alamat' => 'required',
        ]);

        Cabang::create($validatedData);

        return redirect('/dashboard/cabang')->with('success', 'Cabang Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabang $cabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang)
    {
        return view('dashboard.cabang.edit', [
            'cabang' => $cabang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang)
    {
        $rules = [
            'name' => 'required|max:255',
            'telp' => 'required|max:15|min:9',
            'alamat' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Cabang::where('id', $cabang->id)->update($validatedData);
        return redirect('/dashboard/cabang')->with('success', 'Cabang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
        Cabang::destroy($cabang->id);
        return redirect('/dashboard/cabang')->with('success', 'Cabang Berhasil Dihapus!!');
    }
}
