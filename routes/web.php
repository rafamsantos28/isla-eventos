<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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