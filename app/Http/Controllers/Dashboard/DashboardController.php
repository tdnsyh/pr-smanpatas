<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardOperator()
    {
        return view("admin.dashboard.operator");
    }

    public function dashboardBendahara()
    {
        return view("admin.dashboard.bendahara");
    }

    public function dashboardAlumni()
    {
        return view("admin.dashboard.alumni");
    }

    public function dashboardKehormatan()
    {
        return view("admin.dashboard.kehormatan");
    }

    public function dashboardMedia()
    {
        return view("admin.dashboard.media");
    }

    public function dashboardSekretaris()
    {
        return view("admin.dashboard.sekretaris");
    }
}
