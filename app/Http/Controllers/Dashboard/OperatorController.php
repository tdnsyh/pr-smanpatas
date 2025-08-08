<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class OperatorController extends Controller
{
    public function dashboardOperator()
    {
        return view("admin.index");
    }

}
