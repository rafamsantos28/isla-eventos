@extends('layouts.app')

@section('titulo', $tipo->nome)

@section('conteudo')
   @if ($evento->tipo)
        <p>Tipo: <a href="{{ route('tipos.show', $evento->tipo->slug) }}">{{ $evento->tipo->nome }}</a></p>
    @endif

    <div class="grelha">
        @forelse ($eventos as $evento)
            <x-cartao-evento :evento="$evento" />
        @empty
            <x-alerta>Ainda não há eventos deste tipo.</x-alerta>
        @endforelse
    </div>

    <p><a href="{{ route('eventos.index') }}">Voltar aos eventos</a></p>
@endsection