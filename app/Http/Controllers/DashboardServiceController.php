<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.service.index', [
            'services' => Service::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'harga' => 'required|numeric|min:4',
            'waktu' => 'required|numeric',
            'image' => 'image|file|max:1024',
            'deskripsi' => 'required'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images-service');
        }

        Service::create($validatedData);

        return redirect('/dashboard/service')->with('success', 'Service Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('dashboard.service.edit', [
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $rules = [
            'name' => 'required|max:255',
            'harga' => 'required|numeric|min:4',
            'waktu' => 'required|numeric',
            'image' => 'image|file|max:1024',
            'deskripsi' => 'required'
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images-service');
        }

        Service::where('id', $service->id)->update($validatedData);
        return redirect('/dashboard/service')->with('success', 'Post Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::delete($service->image);
        }
        Service::destroy($service->id);
        return redirect('/dashboard/service')->with('success', 'Service Berhasil Dihapus!!');
    }
}
