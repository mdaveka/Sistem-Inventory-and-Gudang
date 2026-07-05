<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();

        return response()->json([
            'message' => 'Selamat datang di Dashboard Admin',
            'total_barang' => $totalBarang,
        ]);
    }
}
