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