@extends('layouts.app')
@section('titulo', 'Eventos')
@section('conteudo')
    <h1>Eventos @if ($tipo) ({{ $tipo }}) @endif</h1>
    <p><a href="{{ route('inicio') }}">Início</a></p>
    <p>
        <a href="{{ route('eventos.index') }}">todos</a>
        @foreach ($tipos as $t)
            · <a href="{{ route('eventos.index', ['tipo' => $t->slug]) }}">{{ $t->nome }}</a>
        @endforeach
    </p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Evento</th>
                <th>Tipo</th>
                <th>Data</th>
                <th>Vagas livres</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($eventos as $evento)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('eventos.show', $evento->id) }}">{{ $evento->titulo }}</a></td>
                    <td>
    @if ($evento->tipo)
        <a href="{{ route('tipos.show', $evento->tipo->slug) }}">{{ $evento->tipo->nome }}</a>
    @endif
</td>
                    <td>{{ $evento->data->format('d/m/Y') }}</td>
                    <td>
                        @if ($evento->inscritos >= $evento->vagas)
                            <strong>Esgotado</strong>
                        @else
                            {{ $evento->vagas - $evento->inscritos }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Não há eventos para mostrar.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection