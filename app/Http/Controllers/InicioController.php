<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function index()
    {
        $proximos = DB::table('eventos')
            ->where('data', '>=', now()->toDateString())
            ->orderBy('data')
            ->limit(3)
            ->get();

        return view('inicio', ['proximos' => $proximos]);
    }
}