<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistributorController extends Controller
{
    /**
     * Tampilkan semua data Distributor.
     */
    public function index()
    {
        return view('distributor.index', [
            'title' => 'Distributor',
            'datas' => Distributor::all()
        ]);
    }

    /**
     * Form tambah Distributor baru.
     */
    public function create()
    {
        return view('distributor.create', [
            'title' => 'Distributor'
        ]);
    }

    /**
     * Simpan data Distributor baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_distributor' => 'required|string|max:255',
            'alamat_distributor' => 'required|string|max:255',
            'notelpon_distributor' => 'required|string|max:20',
        ]);

        // Normalisasi (hapus spasi & ubah ke huruf kecil agar lebih akurat)
        $nama = trim(strtolower($data['nama_distributor']));
        $alamat = trim(strtolower($data['alamat_distributor']));
        $notelp = trim($data['notelpon_distributor']);

        // Cek duplikat kombinasi nama + alamat + no telp
        $exists = DB::table('distributors')
            ->whereRaw('LOWER(nama_distributor) = ?', [$nama])
            ->whereRaw('LOWER(alamat_distributor) = ?', [$alamat])
            ->where('notelpon_distributor', $notelp)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('duplikat', 'Distributor "' . $data['nama_distributor'] .
                    '" dengan alamat "' . $data['alamat_distributor'] .
                    '" dan nomor "' . $data['notelpon_distributor'] . '" sudah ada di database!');
        }

        Distributor::create($data);

        return redirect()->route('distributor.index')
            ->with('simpan', 'Data Distributor "' . $data['nama_distributor'] . '" berhasil disimpan!');
    }

    /**
     * Form edit Distributor.
     */
    public function edit(string $id)
    {
        return view('distributor.edit', [
            'title' => 'Distributor',
            'data' => Distributor::findOrFail($id)
        ]);
    }

    /**
     * Update data Distributor.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_distributor' => 'required|string|max:255',
            'alamat_distributor' => 'required|string|max:255',
            'notelpon_distributor' => 'required|string|max:20',
        ]);

        // Normalisasi data untuk cek duplikat
        $nama = trim(strtolower($data['nama_distributor']));
        $alamat = trim(strtolower($data['alamat_distributor']));
        $notelp = trim($data['notelpon_distributor']);

        // Cek apakah data dengan kombinasi yang sama sudah ada (selain dirinya sendiri)
        $exists = DB::table('distributors')
            ->whereRaw('LOWER(nama_distributor) = ?', [$nama])
            ->whereRaw('LOWER(alamat_distributor) = ?', [$alamat])
            ->where('notelpon_distributor', $notelp)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('duplikat', 'Distributor "' . $data['nama_distributor'] .
                    '" dengan alamat "' . $data['alamat_distributor'] .
                    '" dan nomor "' . $data['notelpon_distributor'] . '" sudah ada di database!');
        }

        $distributor = Distributor::findOrFail($id);
        $distributor->update($data);

        return redirect()->route('distributor.index')
            ->with('ubah', 'Data Distributor "' . $data['nama_distributor'] . '" berhasil diperbarui!');
    }

    /**
     * Hapus data Distributor.
     */
    public function destroy($id)
    {
        $distributor = Distributor::findOrFail($id);
        $nama = $distributor->nama_distributor;

        $distributor->delete();

        return redirect()->route('distributor.index')
            ->with('hapus', 'Data Distributor "' . $nama . '" berhasil dihapus!');
    }
}
