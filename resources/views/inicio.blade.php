@extends('layouts.app')
@section('titulo', 'Início')
@section('conteudo')
    <h1>Próximos eventos</h1>
    <ul>
        @forelse ($proximos as $evento)
            <li>
                <a href="{{ route('eventos.show', $evento['id']) }}">
                    {{ $evento['titulo'] }}
                </a>
            </li>
        @empty
            <li>Não há eventos agendados.</li>
        @endforelse
    </ul>
    <p><a href="{{ route('eventos.index') }}">Ver todos os eventos</a></p>
@endsection