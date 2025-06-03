<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $mobils = Mobil::all();
        return view('kategori', compact('mobils'));
    }
}
