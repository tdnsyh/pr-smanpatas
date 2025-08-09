<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Simpan URL redirect_to kalau ada di query string
            if ($request->has('redirect_to')) {
                session(['redirect_to' => $request->redirect_to]);
            }
            return route('login');
        }
    }

}
