PL01
1. As rotas da aplicação web estão em routes/web.php
2. As views estão em resources /views. A view da página de boas-vindas chama-se welcome (welcome.blade.php)
3. O nome da base de dados está no ficheiro .env. Não vai para o GitHub porque contém dados sensíveis (palavras-passe, chaves) e configuraões específicas de cada máquina

B2
Com e(): a página mostra o texto literal «Olá, <h1>Ana!», porque o e() converte < e > em &lt; e &gt;.
Sem e(): o navegador interpretou o <h1> como HTML e mostrou «Ana» como título grande.
Perigo: o utilizador consegue injectar HTML e JavaScript na página (ataque XSS), que pode roubar sessões ou enganar outros utilizadores.

B5
Recebo um código de estado '404 Not Found'

B6
syntax error, unexpected token "}", expecting ";"
Código de estado 500

PL02
D4
/eventos/3 e /eventos/99 abrem um erro de estado 500 por ainda não haver uma rota definida e /eventos/abc não entra em ação pois já há dados em 'eventos' com id próprio

E
Sem whereNumber('id') e escrita antes de /eventos/proximos, a rota /eventos/{id}
apanharia o pedido, porque {id} aceita qualquer texto, incluindo "proximos". O Laravel
usa a primeira rota que corresponde, por isso /eventos/proximos nunca chegava a ser
executada e a página falhava. Com whereNumber('id') a rota {id} só aceita dígitos,
logo "proximos" não corresponde e passa para a rota seguinte. Mesmo assim, é boa
prática escrever as rotas fixas (/eventos/proximos) antes das dinâmicas (/eventos/{id}).

PL03
/eventos/tipo/{tipo} tem três segmentos (eventos, tipo, valor), enquanto
/eventos/{id} tem apenas dois (eventos, valor). O Laravel compara o endereço
segmento a segmento, por isso um pedido como /eventos/tipo/workshop nunca
corresponde a /eventos/{id}: este só aceita dois segmentos. Além disso, o
{id} tem whereNumber('id'), que só aceita dígitos.

PL04
E1
o {{ }} (e a forma curta de @section) escapa os caracteres especiais do HTML, e é isso que impede o XSS, porque o texto do utilizador é sempre mostrado como texto e nunca interpretado como código.

E2
além de aparecer o título, antes aparece o 'código' ({ !! UCFIRST($EVENTO['TIPO']) !! })

Desafio
@section/@yield servem para o conteúdo principal de cada página: o layout define um
@yield('conteudo') (ou 'titulo') e cada view preenche-o com @section. Cada secção tem um
só conteúdo, e se for escrita duas vezes a segunda substitui a primeira. Uso-os para o
título e para o corpo da página.

@push/@stack servem para acrescentar coisas a um sítio do layout a partir de várias
views, sem se substituírem: o layout define @stack('estilos') e cada página (ou
componente) faz @push('estilos') com os seus próprios estilos. Uso-os para CSS ou
scripts que só uma página precisa, como as cores das etiquetas na página inicial.