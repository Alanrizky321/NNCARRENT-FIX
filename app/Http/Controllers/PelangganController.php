<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ratingUlasan;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function ulasan(Request $request)
    {
        $request->validate([
            'ratingBintang' => 'required|string',
            'ulasan' => 'required|string',

        ]);
        $user = auth()->user();
        $pesananUser = $user->pesanan()->where('status', 'finished')->get();
        if ($pesananUser->isNotEmpty()) {
            dd('Sudah Memesan');
            $rating = (float) $request->ratingBintang;
            ratingUlasan::create([
                'ulasan' => $request->ulasan,
                'rating' => $rating,
                'user_id' => Auth::id(),
            ]);
            return redirect()->back()->with('kirimUlasanSuccess', 'Ulasan Anda Berhasil Dikirim');
        } else {
            return redirect()->back()->with('kirimUlasanFailed', 'Ulasan Anda Berhasil Dikirim');
        };
    }

}
