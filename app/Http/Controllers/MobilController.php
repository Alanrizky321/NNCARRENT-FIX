<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::withTrashed()->get();
        return view('daftarmobiladmin', compact('mobils'));
    }
    

    public function create()
    {
        $kategoriList = Kategori::all();
        return view('mobil.create', compact('kategoriList'));
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
            'ID_Admin' => 'required|', //'required|exists:admin,ID_Admin',
            'Jumlah_Kursi' => 'required|integer',
            'Jenis_Transmisi' => 'required|string|in:manual,automatic',
        ]);

        $data = $request->all();

        if ($request->hasFile('Foto')) {
            $file = $request->file('Foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = 'public-storage/mobil';
            $file->move($path, $filename);
            $data['Foto'] = $path.'/'.$filename;
        }

        Mobil::create($data);

        return redirect()->route('daftarmobiladmin')->with('success', 'Data mobil berhasil ditambahkan.');
    }

    public function show($id)
{
    // Jika primary key di databasenya bernama ID_Mobil, override di Model-nya atau pakai:
    // $mobil = Mobil::where('ID_Mobil', $id)->firstOrFail();

    $mobil = Mobil::findOrFail($id);
    return view('detail', compact('mobil'));
}

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        $kategoriList = Kategori::all();
        return view('mobil.edit', compact('mobil', 'kategoriList'));
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
            // Hapus file lama jika ada
            if ($mobil->Foto && file_exists($mobil->Foto)) {
                unlink($mobil->Foto);
            }
            
            $file = $request->file('Foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = 'public-storage/mobil';
            $file->move($path, $filename);
            $data['Foto'] = $path.'/'.$filename;
        }
    
        $mobil->update($data);
    
        return redirect()->route('daftarmobiladmin')->with('success', 'Data mobil berhasil diupdate.');
    
    }

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->delete();
    
        return redirect()->route('daftarmobiladmin')->with('success', 'Data mobil berhasil dihapus!');
    }
    
    public function restore($id)
    {
        $mobil = Mobil::withTrashed()->findOrFail($id);
        $mobil->restore();
        return redirect()->route('daftarmobiladmin')->with('success', 'Mobil berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $mobil = Mobil::withTrashed()->findOrFail($id);

        // Hapus file foto jika ada
        if ($mobil->Foto && file_exists($mobil->Foto)) {
            unlink($mobil->Foto);
        }

        $mobil->forceDelete();
        return redirect()->route('daftarmobiladmin')->with('success', 'Mobil berhasil dihapus permanen.');
    }
}