# Como rodar o backend

### Passo a passo

Clone Repositório

```sh
git clone https://github.com/PedroPiassi/top5-tiao-carreiro-backend.git
```

Abra a pasta que você clonou o projeto.

Suba o container do projeto

```sh
docker-compose up -d
```

Crie o Arquivo .env

```sh
cp .env.example .env
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
