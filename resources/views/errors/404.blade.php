@extends('layouts.app')
@section('titulo', 'Página não encontrada')
@section('conteudo')
    <h1>404 · Página não encontrada</h1>
    <p>A página que procuras não existe. Tenta outro endereço ou atualiza a página.</p>
    <p><a href="{{ route('eventos.index') }}">Voltar aos eventos</a></p>
    <p><a href="{{ route('inicio') }}">Início</a></p>
@endsection