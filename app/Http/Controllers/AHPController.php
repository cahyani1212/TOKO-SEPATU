<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\PerbandinganKriteria; // Pastikan model ini ada
use Illuminate\Http\Request;

class AHPController extends Controller
{
    // Menampilkan halaman utama untuk AHP
    public function index()
    {
        // Mendapatkan data kriteria atau data lainnya yang diperlukan
        $kriteria = Kriteria::all();

        // Mengirim data ke view
        return view('tpk.ahp', compact('kriteria'));
    }

    // Hitung bobot kriteria dengan AHP
    public function calculateAHP()
    {
        $kriteria = Kriteria::all();
        $n = $kriteria->count();

        if ($n <= 1) {
            return redirect()->back()->with('error', 'Jumlah kriteria tidak cukup untuk perhitungan AHP.');
        }

        // Matriks perbandingan
        $matriks = [];
        foreach ($kriteria as $row) {
            foreach ($kriteria as $col) {
                // Periksa apakah nilai perbandingan kriteria ada
                $nilai = PerbandinganKriteria::where('kriteria_1', $row->id)
                    ->where('kriteria_2', $col->id)
                    ->value('nilai');

                // Jika tidak ada, tetapkan nilai default 1 untuk perbandingan diri sendiri
                if (is_null($nilai) && $row->id == $col->id) {
                    $nilai = 1;
                }
                // Jika nilai perbandingan kriteria tidak ditemukan, defaultkan ke 1
                if (is_null($nilai)) {
                    $nilai = 1;
                }

                $matriks[$row->id][$col->id] = $nilai;
            }
        }

        // Normalisasi dan hitung bobot
        $totalKolom = array_fill(0, $n, 0);
        foreach ($matriks as $row) {
            foreach ($row as $key => $value) {
                $totalKolom[$key] += $value;
            }
        }

        $bobot = [];
        foreach ($matriks as $rowId => $row) {
            $bobotRow = 0;
            foreach ($row as $colId => $value) {
                $normalized = $value / $totalKolom[$colId];
                $bobotRow += $normalized;
            }
            $bobot[$rowId] = $bobotRow / $n;
        }

        // Simpan bobot ke tabel Kriteria
        foreach ($bobot as $kriteriaId => $value) {
            Kriteria::where('id', $kriteriaId)->update(['bobot' => $value]);
        }

        return redirect()->back()->with('status', 'Bobot kriteria berhasil dihitung!');
    }

    // Menyimpan perbandingan kriteria
    public function store(Request $request)
    {
        $request->validate([
            'kriteria_1' => 'required|exists:kriteria,id',
            'kriteria_2' => 'required|exists:kriteria,id',
            'nilai' => 'required|numeric|min:1',
        ]);

        // Simpan data perbandingan
        PerbandinganKriteria::create([
            'kriteria_1' => $request->kriteria_1,
            'kriteria_2' => $request->kriteria_2,
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Perbandingan kriteria berhasil disimpan!');
    }
}
