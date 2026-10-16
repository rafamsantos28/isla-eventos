# ISLA Eventos

Plataforma web do ISLA Gaia para divulgar workshops, palestras e hackathons, feita em Laravel.

## Como correr o projecto

1. Instalar as dependências:

```bash
   composer install
```

2. Criar o ficheiro de configuração:

```bash
   cp .env.example .env
```

3. Gerar a chave da aplicação:

```bash
   php artisan key:generate
```

4. Arrancar o servidor:

```bash
   php artisan serve
```

5. Abrir http://127.0.0.1:8000 no navegador.