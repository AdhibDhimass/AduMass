<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Controllers;

class DashboardController extends Controller
{
    public function index() {
        $petugas = User::where('role', 'petugas')->count();
        $masyarakat = User::where('role', 'masyarakat')->count();

        $proses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        return view('Dashboards.dash', ['petugas' => $petugasCount, 'masyarakat' => $masyarakatCount, 'proses' => $proses, 'selesai' => $selesai]);
    }

}
