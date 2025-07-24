## Requisitos

- PHP >= 8.1
- Composer
- Laravel >= 10
- Banco de Dados (MySQL)

Certifique-se de que a extensão `pdo_mysql` está habilitada no seu ambiente PHP:

### `` extension=pdo_mysql``

---

## Configuração do Ambiente

## Instalação

```bash
git clone https://github.com/daniellimar/api-php-omdb.git
cd api-php-omdb
composer install
cp .env.example .env
php artisan key:generate
```

## OMDB

Defina a variável da API Key do OMDB no seu arquivo `.env`:

### `` OMDB_API_KEY=your_api_key_here``

---

## MYSQL

Defina a variável MYSQL no seu arquivo `.env`:

#### DB_CONNECTION=mysql

#### DB_HOST=127.0.0.1

#### DB_PORT=3306

#### DB_DATABASE=api-php-omdb

#### DB_USERNAME=

#### DB_PASSWORD=

---

## Crie o Banco de Dados: api-php-omdb

### Crie o banco de dados `api-php-omdb` no seu servidor MySQL.

---

## Executando as Migrações

Execute o comando abaixo para rodar as migrações do banco de dados:

### `` php artisan migrate``

---

## Importando Filmes da OMDB

#### Este projeto permite importar filmes diretamente da API pública OMDb por meio de um comando Artisan:

## `` php artisan omdb:search {termo} ``

###

### 🔁 Exemplo completo de ciclo: importar + consultar

###

### 1. Importar filmes com o comando Artisan

#### ``php artisan omdb:search batman``

#### ``Saída esperada:``

#### `` 🔍 Buscando filmes com o termo: 'batman'``

#### `` ✅ Filme 'Batman Begins' importado com sucesso.``

#### ``  ✅ Filme 'The Dark Knight' importado com sucesso.``

#### ``  ✅ Filme 'The Dark Knight Rises' importado com sucesso.``

#### ``  🏁 Importação finalizada.``

---

## Endpoints da API

### `GET /api/movies`

Retorna uma lista de filmes filtrados por título, ano e/ou diretor.
---

#### Parâmetros de consulta

- `title` (opcional): Filtra os filmes pelo título.  
  Exemplo: `title=Inception`
- `year` (opcional): Filtra os filmes pelo ano de lançamento.  
  Exemplo: `year=2010`
- `director` (opcional): Filtra os filmes pelo nome do diretor.  
  Exemplo: `director=Nolan`

---

## Exemplo de requisição

### Acesse a documentação Swagger:

http://127.0.0.1:8000/api/documentation

---

### GET /api/movies?year=2005

#### Host: http://127.0.0.1:8000

#### http://127.0.0.1:8000/api/movies?year=2005

### Exemplo com curl:

#### curl "http://127.0.0.1:8000/api/movies?title=batman"

### Resposta esperada:

```json
[
    {
        "id": 1,
        "title": "Batman Begins",
        "year": 2005,
        "director": "Christopher Nolan",
        "created_at": "2025-07-24T14:00:00.000000Z",
        "updated_at": "2025-07-24T14:00:00.000000Z"
    },
    {
        "id": 2,
        "title": "The Dark Knight",
        "year": 2008,
        "director": "Christopher Nolan",
        "created_at": "2025-07-24T14:01:00.000000Z",
        "updated_at": "2025-07-24T14:01:00.000000Z"
    }
]
