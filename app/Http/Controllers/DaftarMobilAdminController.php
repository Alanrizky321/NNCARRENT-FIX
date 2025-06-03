<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;

class DaftarMobilAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Mobil::withTrashed();

        // Pencarian berdasarkan merek atau model
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('Merek', 'like', "%{$search}%")
                  ->orWhere('Model', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status
        if ($status = $request->input('status')) {
            if ($status === '1') {
                $query->where('Status_Ketersediaan', 1);
            } elseif ($status === '0') {
                $query->where('Status_Ketersediaan', 0);
            } elseif ($status === 'maintenance') {
                $query->onlyTrashed();
            }
        }

        // Filter berdasarkan merek
        if ($merek = $request->input('merek')) {
            $query->where('Merek', $merek);
        }

        // Filter berdasarkan tahun
        if ($tahun = $request->input('tahun')) {
            $query->where('Tahun', $tahun);
        }

        $mobils = $query->paginate(6); // Pagination dengan 6 item per halaman
        return view('daftarmobiladmin', compact('mobils'));
    }

    public function create()
    {
        $kategoriList = Kategori::all();
        return view('daftarmobiladmin.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Merek' => 'required|string|max:255',
            'Model' => 'required|string|max:255',
            'Tahun' => 'required|integer',
            'Harga_Sewa' => 'required|numeric',
            'Status_Ketersediaan' => 'required|boolean',
            'Kategori_ID' => 'required|exists:kategori,id',
            'ID_Admin' => 'required',
            'Jumlah_Kursi' => 'required|integer',
            'Jenis_Transmisi' => 'required|string|in:manual,automatic',
        ]);

        $data = $request->all();

        if ($request->hasFile('Foto')) {
            $file = $request->file('Foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'public-storage/mobil';
            $file->move($path, $filename);
            $data['Foto'] = $path . '/' . $filename;
        }

        Mobil::create($data);

        return redirect()->route('daftarmobiladmin.index')->with('success', 'Data mobil berhasil ditambahkan.');
    }

    public function show($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('daftarmobiladmin.show', compact('mobil'));
    }

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        $kategoriList = Kategori::all();
        return view('daftarmobiladmin.edit', compact('mobil', 'kategoriList'));
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        $request->validate([
            'Merek' => 'required|string|max:255',
            'Model' => 'required|string|max:255',
            'Tahun' => 'required|integer',
            'Harga_Sewa' => 'required|numeric',
            'Status_Ketersediaan' => 'required|boolean',
            'Kategori_ID' => 'required|exists:kategori,id',
            'ID_Admin' => 'required',
            'Jumlah_Kursi' => 'required|integer',
            'Jenis_Transmisi' => 'required|string|in:manual,automatic',
        ]);

        $data = $request->all();

        if ($request->hasFile('Foto')) {
            if ($mobil->Foto && file_exists($mobil->Foto)) {
                unlink($mobil->Foto);
            }

            $file = $request->file('Foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'public-storage/mobil';
            $file->move($path, $filename);
            $data['Foto'] = $path . '/' . $filename;
        }

        $mobil->update($data);

        return redirect()->route('daftarmobiladmin.index')->with('success', 'Data mobil berhasil diupdate.');
    }

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->delete();

        return redirect()->route('daftarmobiladmin.index')->with('success', 'Data mobil berhasil dihapus!');
    }

    public function restore($id)
    {
        $mobil = Mobil::withTrashed()->findOrFail($id);
        $mobil->restore();
        return redirect()->route('daftarmobiladmin.index')->with('success', 'Mobil berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $mobil = Mobil::withTrashed()->findOrFail($id);

        if ($mobil->Foto && file_exists($mobil->Foto)) {
            unlink($mobil->Foto);
        }

        $mobil->forceDelete();
        return redirect()->route('daftarmobiladmin.index')->with('success', 'Mobil berhasil dihapus permanen.');
    }
}