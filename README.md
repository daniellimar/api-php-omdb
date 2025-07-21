## Pré-requisitos

extension=pdo_mysql

---

## Configuração do Ambiente

Defina a variável da API Key do OMDB no seu arquivo `.env`:

---

### MYSQL

Defina a variável MYSQL no seu arquivo `.env`:

### DB_CONNECTION=mysql

### DB_HOST=127.0.0.1

### DB_PORT=3306

### DB_DATABASE=api-php-omdb

### DB_USERNAME=

### DB_PASSWORD=

---

## Executando as Migrações

Execute o comando abaixo para rodar as migrações do banco de dados:

### php artisan migrate

---

## Endpoints da API

### `GET /api/movies`

Retorna uma lista de filmes filtrados por título, ano e/ou diretor.

#### Parâmetros de consulta

- `title` (opcional): Filtra os filmes pelo título.  
  Exemplo: `title=Inception`
- `year` (opcional): Filtra os filmes pelo ano de lançamento.  
  Exemplo: `year=2010`
- `director` (opcional): Filtra os filmes pelo nome do diretor.  
  Exemplo: `director=Nolan`

---

## Exemplo de requisição

#### GET /api/movies?year=2005

#### Host: http://127.0.0.1:8000
