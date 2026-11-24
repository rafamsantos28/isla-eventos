@extends('layouts.app')
@section('titulo', 'Início')
@section('conteudo')
    <h1>Próximos eventos</h1>
    <p>    
    @foreach ($tipos as $t)
        <a href="{{ route('tipos.show', $t->slug) }}">{{ $t->nome }}</a> ({{ $t->eventos_count }})@if (! $loop->last) · @endif
    @endforeach
    </p>
    <div class="grelha">
        @forelse ($proximos as $evento)
            <x-cartao-evento :evento="$evento" />
        @empty
            <p>Não há eventos agendados.</p>
        @endforelse
    </div>
    <p><a href="{{ route('eventos.index') }}">Ver todos os eventos</a></p>
@endsection
@push('estilos')
<style>
    .etiqueta-workshop  { color: #1d5fa8; }
    .etiqueta-palestra  { color: #2e7d32; }
    .etiqueta-hackathon { color: #b45309; }
</style>
@endpush