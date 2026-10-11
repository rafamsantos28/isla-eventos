<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name') }}</title>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<tbody>
@forelse ($eventos as $evento)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $evento['titulo'] }}</td>
<td>{{ $evento['data'] }}</td>
<td>{{ $evento['vagas'] - $evento['inscritos'] }}</td>
</tr>
@empty
<tr><td colspan="4">Não há eventos para mostrar.</td></tr>
@endforelse
</tbody>
</html>