<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $totalProduk = Produk::count();
            $produkDiskon = Produk::where('diskon', '>', 0)->count();
            $totalUser = User::count();
            $totalPelanggan = User::where('role', 'pelanggan')->count();
            
            $produkDiscounted = Produk::where('diskon', '>', 0)->latest()->take(6)->get();
            $produkTerbaru = Produk::latest()->take(6)->get();
        } catch (\Exception $e) {
            $totalProduk = 0;
            $produkDiskon = 0;
            $totalUser = 0;
            $totalPelanggan = 0;
            $produkDiscounted = collect();
            $produkTerbaru = collect();
        }

        return view('dashboard', compact(
            'totalProduk',
            'produkDiskon',
            'totalUser',
            'totalPelanggan',
            'produkDiscounted',
            'produkTerbaru'
        ));
    }
}
