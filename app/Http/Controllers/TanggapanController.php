<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TanggapanController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pengaduan_id' => 'required',
            'tanggapan' => 'required',
            'status' => 'required|in:0,proses,selesai', // Sesuaikan dengan status yang diperbolehkan
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        Tanggapan::create([
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan,
            'user_id' => $user->id,
            'pengaduan_id' => $request->pengaduan_id,
            'status' => $request->status,
        ]);

        $pengaduan = Pengaduan::where('id', $request->pengaduan_id)->first();
        $pengaduan->update([
            'status' => $request->status,
        ]);

        // Redirect ke halaman yang sesuai
        return redirect()->route('pengaduan.show', ['pengaduan' => $request->pengaduan_id])->with('status', 'Tanggapan berhasil disimpan');
    }

    public function update(Request $request, $tanggapan_id)
    {
        $validator = Validator::make($request->all(), [
            'tanggapan' => 'required',
            'status' => 'required|in:0,proses,selesai', // Sesuaikan dengan status yang diperbolehkan
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $tanggapan = Tanggapan::find($tanggapan_id);

        if (!$tanggapan) {
            return redirect()->back()->with('error', 'Tanggapan tidak ditemukan');
        }

        // Periksa otorisasi di sini, misalnya dengan menggunakan kebijakan (policies).

        $tanggapan->update([
            'tanggapan' => $request->tanggapan,
        ]);

        $pengaduan = $tanggapan->pengaduan;
        $pengaduan->update([
            'status' => $request->status,
        ]);

        // Redirect ke halaman yang sesuai
        return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan->id])->with('status', 'Tanggapan berhasil diperbarui');
    }




    public function destroy(Tanggapan $tanggapan)
    {
        if (!$tanggapan) {
            return redirect()->back()->with('error', 'Tanggapan tidak ditemukan');
        }

        // Periksa apakah pengguna yang sedang masuk adalah pemilik tanggapan atau admin/petugas
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'admin' || $role === 'petugas' || $tanggapan->user_id === $user->id) {
            $tanggapan->delete();

            return redirect()->back()->with('status', 'Tanggapan berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus tanggapan ini');
        }
    }




}
