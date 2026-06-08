<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\SewaMobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SewaMobilController extends Controller {
    public function dashboardUser() {
        $daftarMobil = Mobil::where('status', 'tersedia')->get();
        return view('user.dashboard', compact('daftarMobil'));
    }
    public function tampilkanPembayaran(Request $request) {
        $request->validate([
            'mobil_id' => 'required',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
        ]);
        $mobil = Mobil::findOrFail($request->mobil_id);
        $tglSewa = Carbon::parse($request->tanggal_sewa);
        $tglKembali = Carbon::parse($request->tanggal_kembali);
        $durasiHari = $tglSewa->diffInDays($tglKembali);
        if ($durasiHari == 0) { $durasiHari = 1; }
        
        $totalHarga = $durasiHari * $mobil->harga_per_hari;
        $dataSewa = [
            'mobil_id' => $mobil->id,
            'nama_mobil' => $mobil->nama_mobil,
            'merek' => $mobil->merek,
            'plat_nomor' => $mobil->plat_nomor,
            'harga_per_hari' => $mobil->harga_per_hari,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'durasi_hari' => $durasiHari,
            'total_harga' => $totalHarga
        ];
        return view('user.pembayaran', compact('dataSewa'));
    }
    public function sewa(Request $request) {
        $request->validate([
            'mobil_id' => 'required',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'total_harga' => 'required|numeric',
        ]);
        $mobil = Mobil::findOrFail($request->mobil_id);
        SewaMobil::create([
            'user_id' => Auth::id(),
            'mobil_id' => $mobil->id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga' => $request->total_harga,
            'status_pembayaran' => 'belum_bayar'
        ]);
        $mobil->update(['status' => 'disewa']);
        return redirect('/user/dashboard')->with('sukses', 'Sewa berhasil diajukan! Silakan tunggu konfirmasi Admin.');
    }
}