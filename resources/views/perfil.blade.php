<h1>{{ $nome }}</h1>
<p>Curso: {{ $curso }} · {{ $ano }}.º ano</p>

@if ($ano == 2)
    <p>Estás no último ano do CTeSP.</p>
@endif

<h2>Interesses ({{ count($interesses) }})</h2>
<ul>
    @foreach ($interesses as $item)
        <li>{{ $item }}</li>
    @endforeach
</ul>