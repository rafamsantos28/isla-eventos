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

PL05
A3
'SQLSTATE[42S02]: Base table or view not found: 1146 Table 'isla_eventos.sessions' doesn't exist'
O Laravel guarda as sessões na base de dados (o `SESSION_DRIVER` está em `database`), por isso procura a tabela `sessions`. Como a base `isla_eventos` era nova e ainda não tinha corrido nenhuma migration, essa tabela nunca tinha sido criada.

A4
9. O db:show dá erro no XAMPP (MariaDB) por faltar performance_schema.session_status, contei as tabelas com o tinker e o phpMyAdmin.

B2
tipo 'título': varchar(150)
tipo 'data': date
tipo 'vagas': smallint(5)

B3
No `migrate:status`, a migration `create_eventos_table` ficou no lote 2, porque correu depois das migrations iniciais do Laravel (lote 1).
No `migrate:rollback`, a tabela `eventos` desapareceu do phpMyAdmin (as outras ficaram). O rollback desfaz o último lote e chamou o método `down()` da migration, que faz `Schema::dropIfExists('eventos')`. Depois o `php artisan migrate` voltou a criá-la, chamando o `up()`.

C2
Workshop de Laravel: id 1
Palestra: Carreiras em Cibersegurança: id 2
Hackathon ISLA 24h: id 3
Git e GitHub para iniciantes: id 4
Conversa com antigos alunos DWDM: id 5

C3
O `migrate:fresh --seed` fez, por ordem: 1) apagou todas as tabelas da base de dados; 2) voltou a criar a tabela `migrations`; 3) correu todas as migrations do início; 4) correu o `DatabaseSeeder`, que chama o `EventoSeeder` e insere os 5 eventos.
Nunca o correria num servidor com inscrições reais porque apaga todas as tabelas e os dados que lá estão, e o seeder só volta a pôr os dados de exemplo. Perdiam-se as inscrições reais, sem forma de as recuperar.

D3
'Cannot use object of type stdClass as array'

D4
/ -> 200
/eventos -> 200
/eventos?tipo=workshop -> 200
/eventos?tipo=xpto -> 200
/eventos/2 -> 200
/eventos/99 -> 404
/eventos/tipo/xpto -> 404

D5
Ao abrir `/eventos?tipo=' OR '1'='1` apareceram 0 eventos (apareceu o alerta de que não há eventos para mostrar).
O SQL gerado é ``select * from `eventos` where `tipo` = ?``. O `?` é um marcador (binding): a consulta é enviada à base de dados com o `?` e o valor que o utilizador escreveu vai separado, como dados. Por isso o texto `' OR '1'='1` é comparado como um tipo qualquer, e não é executado como SQL. Isto impede a injeção de SQL.

Desafio
Não deve correr sempre porque cada execução acrescenta mais 20 eventos inventados e diferentes, sem verificar os que já existem. A base de dados enchia-se de lixo, os resultados deixavam de ser repetíveis, e num servidor real misturava dados falsos com eventos verdadeiros. Serve só para testar com muitos dados, e por isso corre-se à mão, com --class.

PL06
A2
Tabela eventos, se o modelo se chamasse 'Local' e a tabela 'locais' o 'php artisan tinker' iria pensar que a tabela se chama 'locals' e teríamos de resolver com '#[Table('locais')]' por cima da classe.

B3
O `TipoSeeder` tem de correr antes do `EventoSeeder` porque cada evento guarda o `tipo_id` de um tipo, e esses ids só existem depois de os tipos serem inseridos. O `EventoSeeder` começa por `Tipo::pluck('id', 'slug')`, que com a tabela `tipos` vazia devolve uma lista vazia, e o `$tipos['workshop']` falhava. Além disso, a chave estrangeira não aceita um `tipo_id` que ainda não exista na tabela `tipos`.

C2
Sem `with`, o ciclo fez 6 consultas; com `with('tipo')`, fez 2.
Sem `with` há 1 consulta para os eventos e mais 1 por cada evento para ir buscar o tipo (o problema das N+1 consultas): com 5 eventos são 1 + 5 = 6, e com 1000 eventos seriam 1001. Com `with('tipo')` há sempre 2 consultas (uma aos eventos e uma aos tipos de todos eles), sejam 5 ou 1000 eventos.
