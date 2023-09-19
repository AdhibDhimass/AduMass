<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use App\Http\Controllers\Controller;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();
        return view('Dashboards.pengaduan.index', ['pengaduan' => $pengaduan]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => now(), // Menggunakan Carbon untuk tanggal saat ini
            'nik' => auth()->user()->nik,
            'judul' => $data['judul'],
            'isi_laporan' => $data['isi_laporan'],
            'foto' => $data['foto'] ?? '',
            'status' => '0',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {

        $tanggapan = Tanggapan::where('pengaduan_id', $pengaduan->id)->first();
        $user = User::where('nik', $pengaduan->nik)->first();
        return view('Dashboards.pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   // Contoh implementasi dalam controller
    public function destroy($id)
    {
        // Hapus tanggapan terlebih dahulu
        Tanggapan::where('pengaduan_id', $id)->delete();

        // Kemudian, hapus pengaduan
        Pengaduan::destroy($id);

        // Tambahkan notifikasi ke dalam sesi flash
        session()->flash('status', 'Pengaduan berhasil dihapus');

        return redirect()->route('pengaduan.index');
    }

}
