<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\SewaMobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    // Halaman Dashboard Utama Admin
    public function dashboardAdmin()
    {
        $daftarMobil = Mobil::all();
        // Mengambil riwayat sewa lengkap dengan relasi data user dan mobilnya
        $daftarPenyewa = SewaMobil::with(['user', 'mobil'])->get();
        return view('admin.dashboard', compact('daftarMobil', 'daftarPenyewa'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required',
            'merek' => 'required',
            'plat_nomor' => 'required|unique:mobil',
            'harga_per_hari' => 'required|numeric',
        ]);

        Mobil::create($request->all());
        return redirect('/admin/dashboard')->with('sukses', 'Mobil baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('admin.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->update($request->all());
        return redirect('/admin/dashboard')->with('sukses', 'Data mobil berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Mobil::findOrFail($id)->delete();
        return redirect('/admin/dashboard')->with('sukses', 'Mobil berhasil dihapus!');
    }

    // Fitur Baru: Mengonfirmasi pengembalian mobil dan pelunasan
    public function selesaiSewa($id)
    {
        // 1. Cari data transaksi sewa berdasarkan ID
        $sewa = SewaMobil::findOrFail($id);
        
        // 2. Ubah status pembayaran menjadi lunas
        $sewa->update(['status_pembayaran' => 'lunas']);
        
        // 3. Cari mobil yang terkait, lalu ubah statusnya menjadi tersedia kembali
        $mobil = Mobil::findOrFail($sewa->mobil_id);
        $mobil->update(['status' => 'tersedia']);
        
        return redirect('/admin/dashboard')->with('sukses', 'Mobil ' . $mobil->nama_mobil . ' telah berhasil dikembalikan dan status pembayaran lunas!');
    }
}