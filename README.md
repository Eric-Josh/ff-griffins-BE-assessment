# Wallet System API

## Build
This application was developed with Laravel 10.x, PHP 8.1

## Installation
* Clone Repository `git clone https://github.com/Eric-Josh/ff-griffins-BE-assessment`
* Move into project path `cd ff-griffins-BE-assessment`
* Install all dependencies `composer install or composer update`
* Create DB
* Copy .env.example to .env `cp .env.example .env`
* Generate APP_KEY `php artisan key:generate`
* Add DB details in .env
* Run Migration and seed data `php artisan migrate:refresh --seed`
* Run app `php artisan serve`

## Docs
Before using this API, user must be authenticated using the login endpoint. Basic authorization (user role) was also put in place as it is best practice that some endpoint should only be call by an admin user.

User roles added to the system are: <strong>admin</strong> and <strong>user</strong>.

The endpoint: `POST /api/login` is requested with the following datapoints:
* email
* password

Seeded users: 
`email: admin@test, password: Admin@123` 
`email: user@test, password: User@123`