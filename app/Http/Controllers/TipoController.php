<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\View\View;

class TipoController extends Controller
{
    public function show(Tipo $tipo): View
    {
        $eventos = $tipo->eventos()
            ->with('tipo')
            ->orderBy('data')
            ->get();

        return view('tipos.show', [
            'tipo' => $tipo,
            'eventos' => $eventos,
        ]);
    }
}