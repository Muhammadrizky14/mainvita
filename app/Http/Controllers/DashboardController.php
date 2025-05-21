<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getWebsiteUsageData()
    {
        // Contoh data statis, ganti dengan data sebenarnya dari database
        $data = [
            ['date' => '2023-01-01', 'visits' => 100],
            ['date' => '2023-02-01', 'visits' => 150],
            ['date' => '2023-03-01', 'visits' => 200],
            ['date' => '2023-04-01', 'visits' => 180],
            ['date' => '2023-05-01', 'visits' => 220],
        ];

        return response()->json($data);
    }

    public function index()
    {
        $vouchers = Voucher::all();
        return view('dashboard', compact('vouchers'));
    }
}
