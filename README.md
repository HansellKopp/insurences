<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Start Docker

    docker-compose up

## First time running

    cp env.example .env
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate --seed

## Navigate
    localhost:8080