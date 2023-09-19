<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Controllers;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahLaporan = Pengaduan::count();
        return view('user.landing',  ['jumlahLaporan' => $jumlahLaporan]);
    }

    public function login(Request $request)
    {
        $nama = User::where('nama', $request->nama)->first();

        if (!$nama) {
            return redirect()->back()->with(['pesan' => 'nama tidak terdaftar']);
        }

        $password = Hash::check($request->password, $nama->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        if (Auth::guard('user')->attempt(['nama' => $request->nama, 'password' => $request->password])) {
            // Jika autentikasi berhasil, periksa peran pengguna
            $user = Auth::guard('user')->user();

            if ($user->role === 'admin') {
                // Jika peran adalah admin, arahkan ke halaman admin dashboard
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'petugas') {
                // Jika peran adalah petugas, arahkan ke halaman petugas dashboard
                return redirect()->route('petugas.dashboard');
            } else {
                // Jika peran adalah masyarakat, arahkan ke halaman masyarakat dashboard
                return redirect()->route('masyarakat.dashboard');
            }
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }


    public function formRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['required'],
            'nama' => ['required'],
            'password' => ['required'],
            'telp' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $email = User::where('email', $request->email)->first();

        if ($email) {
            return redirect()->back()->with(['pesan' => 'email sudah terdaftar']);
        }

        User::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
        ]);

        return redirect()->route('user.landing');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();

        return redirect()->back();
    }

    public function storePengaduan(Request $request)
    {
        if (!auth()->user()->role == 'masyarakat') {
            return redirect()->back()->with(['pesan' => 'Login dibutuhkan!'])->withInput();
        }

        $data = $request->all();

        $validate = Validator::make($data, [
            'judul' => ['required'],
            'isi_laporan' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        date_default_timezone_set('Asia/Bangkok');

        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d h:i:s'),
            'nik' => auth()->user()->nik,
            'judul' => $data['judul'],
            'isi_laporan' => $data['isi_laporan'],
            'foto' => $data['foto'] ?? '',
            'status' => '0',
        ]);

        if ($pengaduan) {
            return redirect()->route('pekat.laporan', 'me')->with(['pengaduan' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pengaduan' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }

    public function laporan($siapa = '')
{
    $terverifikasi = Pengaduan::where([['nik', auth()->user()->nik], ['status', '!=', '0']])->get()->count();
    $proses = Pengaduan::where([['nik', auth()->user()->nik], ['status', 'proses']])->get()->count();
    $selesai = Pengaduan::where([['nik', auth()->user()->nik], ['status', 'selesai']])->get()->count();

    $hitung = [$terverifikasi, $proses, $selesai];

    if ($siapa == 'me') {
        $pengaduan = Pengaduan::where('nik', auth()->user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();
    } else {
        // Hapus kondisi ini untuk menampilkan semua laporan
        $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();
    }

    return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
}


    public function profile()
    {
        return view('User.profile');
    }

    public function editProfile(Request $request)
    {

    }
}
