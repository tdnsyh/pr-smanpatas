<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class RiwayatController extends Controller
{
    public function riwayatIndex()
    {
        $donasi = Donasi::with('campaign') // kalau mau ikut nama campaign
            ->where('user_id', FacadesAuth::id())
            ->latest()
            ->get();

        return view('admin.riwayat.index', compact('donasi'));
    }
}
