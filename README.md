# Projeto: Músicas Mais Tocadas de Tião Carreiro e Pardinho

### Como rodar o backend - Passo a passo

Clone o Repositório

```sh
git clone https://github.com/PedroPiassi/top5-tiao-carreiro-backend.git
```

Abra a pasta que você clonou o projeto.

Tire o .example do .env.exemple, para que fiue apenas .env.

```sh
.env.example => .env
```

Rode o comando a baixo no terminal para subir o container do projeto

```sh
docker-compose up -d
```

Acesse o container app

```sh
docker-compose exec app bash
```

Instale as dependências do projeto

```sh
composer install
```

Gere a key do projeto Laravel

```sh
php artisan key:generate
```

Rodar as migrations

```sh
php artisan migrate
```

Rodar as seders

```sh
php artisan db:seed
```
