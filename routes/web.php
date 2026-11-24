<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\DB;
use App\Models\Tipo;
use App\Http\Controllers\TipoController;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::get('ola', function() {
    return 'Olá, DWDM!';
});

Route::get('/sobre', function() {
    return view('sobre');
});

Route::get('/ola/{nome}', function(string $nome) {
    return 'Olá, ' . e($nome) . '!';
});

Route::get('/aluno/{nome}/{curso}', function (string $nome, string $curso) {
    return e($nome) . ' está no curso ' . e($curso) . '.';
});

Route::get('/saudacao/{nome?}', function (?string $nome = null) {
    return 'Bem-vindo, ' . e($nome ?? 'visitante') . '!';
});

Route::get('/dobro/{numero}', function (int $numero) {
    return 'O dobro de ' . $numero . ' é ' . ($numero * 2) . '.';
})->whereNumber('numero');

$interesses = ['Laravel', 'MySQL', 'Git'];
Route::get('/perfil', function () use ($interesses) {
return view('perfil', [
'nome' => 'Rafael Santos',
'curso' => 'DWDM',
'ano' => 2,
'interesses' => $interesses,
]);
});

Route::get('/perfil/{interesse}', function (string $interesse) use ($interesses) {
    if (in_array($interesse, $interesses)) {
        return e($interesse) . ' está na minha lista de interesses.';
    }

    return e($interesse) . ' não está na minha lista de interesses.';
});

Route::get('/eventos', [EventoController::class, 'index'])
    ->name('eventos.index');

Route::get('/eventos/proximos', function () {
    $proximos = Evento::with('tipo')
        ->where('data', '>=', now()->toDateString())
        ->orderBy('data')
        ->get();

    return view('eventos.index', [
        'eventos' => $proximos,
        'tipo' => null,
        'tipos' => Tipo::orderBy('nome')->get(),
    ]);
});

Route::get('/eventos/{evento}', [EventoController::class, 'show'])
    ->whereNumber('evento')
    ->name('eventos.show');

Route::get('/eventos/tipo/{tipo}', [EventoController::class, 'porTipo'])
    ->name('eventos.tipo');

Route::get('/tipos/{tipo:slug}', [TipoController::class, 'show'])->name('tipos.show');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});