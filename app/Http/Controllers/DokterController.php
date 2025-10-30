<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function index()
    {
        $dokterId = Auth::user()->dokter->id;

        // Total Pasien Sudah Diperiksa
        $totalSelesai = Periksa::whereHas('jadwal', function ($q) use ($dokterId) {
            $q->where('dokter_id', $dokterId);
        })->where('status', 'selesai')->count();

        // Total Pasien Belum Diperiksa
        $totalBelum = Periksa::whereHas('jadwal', function ($q) use ($dokterId) {
            $q->where('dokter_id', $dokterId);
        })->where('status', '!=', 'selesai')->count();

        // Total Pemeriksaan (Jumlah Pasien Sudah dan Belum Diperiksa)
        $totalPemeriksaan = $totalSelesai + $totalBelum;

        // Data untuk Chart (Contoh: Jumlah per hari)
        $dokterData = Periksa::whereHas('jadwal', function ($q) use ($dokterId) {
            $q->where('dokter_id', $dokterId);
        })
            ->selectRaw('DATE(updated_at) as date, count(*) as count') // Menggunakan DATE untuk mendapatkan tanggal lengkap
            ->groupBy('date') // Mengelompokkan berdasarkan tanggal
            ->orderBy('date', 'desc') // Mengurutkan berdasarkan tanggal
            ->get();

        return view('dokter.dashboard', compact('totalSelesai', 'totalBelum', 'totalPemeriksaan', 'dokterData'));
    }

    // === Tampilkan Daftar Pemeriksaan (untuk dokter yang login) ===
    public function showPeriksa()
    {
        $dokterId = auth()->user()->dokter->id;

        // Ambil pasien yang masih menunggu (belum diperiksa dan tidak dilewati)
        $antrianSekarang = Periksa::with(['pasien', 'jadwal.dokter', 'jadwal.poli'])
            ->whereHas('jadwal', fn($q) => $q->where('dokter_id', $dokterId))
            ->where('status', 'menunggu')
            ->orderBy('nomor_antrian', 'asc')
            ->first();

        // Semua pasien untuk tabel (supaya tetap bisa ditampilkan)
        $periksa = Periksa::with(['pasien', 'jadwal.dokter', 'jadwal.poli'])
            ->whereHas('jadwal', fn($q) => $q->where('dokter_id', $dokterId))
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        $obats = Obat::all();

        return view('dokter.periksa', compact('antrianSekarang', 'periksa', 'obats'));
    }


    // === Tampilkan Form Edit Pemeriksaan ===
    public function editPeriksa($id)
    {
        $periksa = Periksa::with(['pasien', 'jadwal.dokter'])->findOrFail($id);

        if ($periksa->jadwal->dokter->user_id !== Auth::id()) {
            abort(403);
        }

        $obats = Obat::all();

        return view('dokter.periksaEdit', compact('periksa', 'obats'));
    }

    // === Simpan Update Pemeriksaan ===
    public function updatePeriksa(Request $request, $id)
    {
        $request->validate([
            'catatan_dokter' => 'nullable|string',
            'biaya_periksa' => 'required|integer|min:0',
            'obats' => 'nullable|array',
            'obats.*' => 'exists:obats,id',
        ]);

        $periksa = Periksa::with('jadwal.dokter')->findOrFail($id);

        if ($periksa->jadwal->dokter->user_id !== Auth::id()) {
            abort(403);
        }

        $periksa->update([
            'catatan_dokter' => $request->catatan_dokter,
            'biaya_periksa' => $request->biaya_periksa,
            'status' => 'selesai',
        ]);

        $periksa->obats()->sync($request->obats ?? []);

        return redirect()->route('periksaDokter')->with('success', 'Pemeriksaan berhasil diperbarui.');
    }
    public function nextAntrian(Request $request)
    {
        $dokterId = auth()->user()->dokter->id;

        // Ambil pasien aktif yang sedang menunggu
        $antrianSekarang = Periksa::whereHas('jadwal', fn($q) => $q->where('dokter_id', $dokterId))
            ->where('status', 'menunggu')
            ->orderBy('nomor_antrian', 'asc')
            ->first();

        if ($antrianSekarang) {
            // Tandai pasien ini sebagai "tidak hadir"
            $antrianSekarang->update(['status' => 'tidak hadir']);
        }

        // Ambil pasien berikutnya (status = menunggu, nomor antrian lebih besar)
        $nextAntrian = Periksa::whereHas('jadwal', fn($q) => $q->where('dokter_id', $dokterId))
            ->where('status', 'menunggu')
            ->where('nomor_antrian', '>', $antrianSekarang->nomor_antrian ?? 0)
            ->orderBy('nomor_antrian', 'asc')
            ->first();

        // Jika tidak ada pasien berikutnya, berarti antrian habis
        if (!$nextAntrian) {
            // Reset semua status ke 'menunggu' agar bisa berulang dari awal
            Periksa::whereHas('jadwal', fn($q) => $q->where('dokter_id', $dokterId))
                ->whereIn('status', ['selesai', 'tidak hadir'])
                ->update(['status' => 'menunggu']);

            return redirect()->route('periksaDokter')->with('info', 'Antrian telah selesai, memulai dari awal lagi.');
        }

        return redirect()->route('periksaDokter')->with('info', 'Pasien dilewati. Menampilkan antrian berikutnya.');
    }



    // === CRUD Obat ===
    public function showObat()
    {
        $obats = Obat::latest()->get();
        return view('dokter.obat', compact('obats'));
    }

    public function storeObat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:69',
            'harga' => 'required|integer',
        ]);

        Obat::create($request->all());
        return redirect()->route('obatDokter');
    }

    public function updateObat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:69',
            'harga' => 'required|integer',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->all());
        return redirect()->route('obatDokter');
    }

    public function deleteObat($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->route('obatDokter');
    }

    // === Profil Dokter ===
    public function editProfile()
    {
        $dokter = Dokter::with('user')->where('user_id', Auth::id())->firstOrFail();
        $polis = Poli::all();

        return view('dokter.profile', compact('dokter', 'polis'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $dokter = Dokter::where('user_id', Auth::id())->firstOrFail();
        $user = $dokter->user;

        // Update tabel dokters
        $dokter->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]);

        // Update tabel users
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('dokter.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }



    // === Riwayat Semua Pasien yang Pernah Diperiksa oleh Dokter ===


    public function riwayatPasien()
    {
        $dokterUserId = Auth::id();

        $riwayat = Periksa::with(['pasien', 'jadwal.dokter']) // wajib include 'pasien'
            ->where('status', 'selesai')
            ->whereHas('jadwal.dokter', function ($q) use ($dokterUserId) {
                $q->where('user_id', $dokterUserId);
            })
            ->orderByDesc('tgl_periksa')
            ->get();

        return view('dokter.riwayat', compact('riwayat'));
    }



    // === Detail Riwayat Pasien: Hanya yang Diperiksa oleh Dokter yang Login ===
    public function riwayatPasienDetail($idPasien)
    {
        $dokterId = Auth::user()->dokter->id;

        $riwayat = Periksa::with(['pasien', 'jadwal.dokter.user', 'obats'])
            ->where('id_pasien', $idPasien)
            ->whereHas('jadwal', function ($q) use ($dokterId) {
                $q->where('dokter_id', $dokterId);
            })
            ->orderByDesc('tgl_periksa')
            ->get();

        $namaPasien = optional($riwayat->first()->pasien)->nama ?? 'Pasien';
        $totalKunjungan = $riwayat->count();


        return view('dokter.riwayatDetail', compact('riwayat', 'namaPasien', 'totalKunjungan'));
    }
}
