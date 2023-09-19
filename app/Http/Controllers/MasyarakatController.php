<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Dashboards.masyarakat.index', [
            'masyarakat' => User::where('role', 'masyarakat')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password = Hash::make($request->input('password'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('Dashboards.masyarakat.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $masyarakat = User::findOrFail($id);
        return view('Dashboards.masyarakat.edit', ['masyarakat' => $masyarakat]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $masyarakat = User::findOrFail($id);
    $data = $request->validate([
        'nama' => 'required|string',
        'telp' => 'required',
        'password' => 'required|min:8',
        // ... tambahkan validasi lainnya sesuai kebutuhan
    ]);

    // Periksa apakah password baru diisi
    if ($request->has('password')) {
        $data['password'] = Hash::make($request->input('password'));
    }

    $masyarakat->update($data);

    // Tambahkan notifikasi flash
    return redirect('/masyarakat')->with('status', 'Data Masyarakat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $masyarakat = User::findOrFail($id);
    $masyarakat->delete();

    return redirect('/masyarakat')->with('status', 'Data Masyarakat berhasil dihapus');
}

}
