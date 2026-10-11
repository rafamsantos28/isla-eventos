<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
<main class="container">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Data</th>
                <th>Vagas livres</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($eventos as $evento)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $evento['titulo'] }}</td>
                    <td>{{ date('d/m/Y', strtotime($evento['data'])) }}</td>
                    <td>
                        @if ($evento['inscritos'] >= $evento['vagas'])
                            <strong>Esgotado</strong>
                        @else
                            {{ $evento['vagas'] - $evento['inscritos'] }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Não há eventos para mostrar.</td></tr>
            @endforelse
        </tbody>
    </table>
</main>
</body>
</html>