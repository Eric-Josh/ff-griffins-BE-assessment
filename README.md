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
Before using this API, user must be authenticated using the login endpoint. Basic authorization (user roles) was put in place as it is expected that some endpoint should only be call by an admin user.

User roles added to the system are: <strong>admin</strong> and <strong>user</strong>.

The endpoint: `POST /api/login` is requested with the following datapoints:
* email
* password

Seeded users: 
`email: admin@test, password: Admin@123` 
`email: user@test, password: User@123`

After login is successfully initiated, a token would be generated which would be used to make API calls to all other endpoint on the system. The API authorization type is Bearer Token.

When the endpoint: `GET /api/users` is requested, the application will return a list of users from the local database.

When the endpoint: `GET /api/user/:id` is requested with a specific <strong>:id</strong> in the URL, where <strong>:id</strong> is a placeholder variable for an integer. It should show the specific user with all the wallets they own and transaction history.

