# Installing and running the application

This project was developed using Laravel framework.

## Project Installation

In the project directory, run:

### `composer install`

after that run script below to generate jwt secret:

### `php artisan jwt:secret`

## Caching

this project cache is setup by using Redis database:

Please install redis and configure redis on .env as follow :

REDIS_HOST=127.0.0.1 

REDIS_PASSWORD=null 

REDIS_PORT=6379 

## Database and migration

This project use MySQL for database.Please setup database and configure in .env:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=url_shortener

DB_USERNAME=root

DB_PASSWORD=

After that run migration and database seeder with this script:

### `php artisan migrate --seed`


## Running the application

In the project directory, you can run:

### `php artisan serve`

Runs the app in the development mode.\
Application will run on [http://localhost:8000](http://localhost:3000) 


