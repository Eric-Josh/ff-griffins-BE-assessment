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

<strong>Request:</strong>

```
{
    "email": "admin@test",
    "password": "Admin@123"
}
```
<strong>Response:</strong>

```
{
    "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@test",
        "email_verified_at": "2023-06-26T08:18:21.000000Z",
        "created_at": "2023-06-26T08:18:21.000000Z",
        "updated_at": "2023-06-26T08:18:21.000000Z"
    },
    "token": "3|docTNSvn3GNtfz9JFcCg16bGPAvDQOc1WFTDBOHx"
}
```

After login is successfully initiated, a token would be generated which would be used to make API calls to all other endpoints on the system. The API authorization type is Bearer Token.

### API Endpoints
Endpoint that can only be call by an admin user: 
* `GET /api/users` 
* `GET /api/user/:id`
* `GET /api/wallets`

When the endpoint: `GET /api/users` is requested, the application will return a list of users from the database.
```
Response:
{
    "data": [
        {
            "id": 1,
            "name": "Admin",
            "email": "admin@test",
            "emailVerified": true,
            "createdAt": "2023-06-26T08:18:21.000000Z"
        },
        {
            "id": 2,
            "name": "User",
            "email": "user@test",
            "emailVerified": true,
            "createdAt": "2023-06-26T08:18:21.000000Z"
        }
    ]
}
```

When the endpoint: `GET /api/user/:id` is requested with a specific <strong>:id</strong> in the URL, where <strong>:id</strong> is a placeholder variable for an integer. It should show the specific user with all the wallets they own and transaction history.
```
Response:
{
    "data": {
        "id": 1,
        "name": "Admin",
        "email": "admin@test",
        "emailVerified": true,
        "wallets": [
            {
                "id": 1,
                "walletId": "fbfd05d83f2ed64c88785e92",
                "balance": 500,
                "createdAt": "2023-06-26T17:31:43.000000Z"
            }
        ],
        "transactions": [
            {
                "id": 1,
                "tranx_ref": "db8a43bb03afa4631e39b435",
                "amount": 30,
                "tranxFee": 0,
                "type": "wallet_to_wallet",
                "status": "successful",
                "tranxDate": "2023-06-26T18:59:34.000000Z"
            }
        ],
        "createdAt": "2023-06-26T08:18:21.000000Z"
    }
}
```

When the endpoint: `GET /api/wallets` is requested, the application will return a list of wallets from the database.
```
Response:
{
    "data": [
        {
            "id": 1,
            "walletId": "fbfd05d83f2ed64c88785e92",
            "type": {
                "id": 1,
                "name": "Zelle",
                "monthlyInterestRate": 3.1
            },
            "balance": 500,
            "owner": {
                "id": 1,
                "name": "Admin",
                "email": "admin@test",
                "emailVerified": true,
                "createdAt": "2023-06-26T08:18:21.000000Z"
            },
            "createdAt": "2023-06-26T17:31:43.000000Z"
        },
        {
            "id": 2,
            "walletId": "249f1d298455a1429cd8377e",
            "type": {
                "id": 4,
                "name": "Google",
                "monthlyInterestRate": 3.95
            },
            "balance": 65,
            "owner": {
                "id": 1,
                "name": "Admin",
                "email": "admin@test",
                "emailVerified": true,
                "createdAt": "2023-06-26T08:18:21.000000Z"
            },
            "createdAt": "2023-06-26T17:31:43.000000Z"
        }
    ]
}
```

When the endpoint: `GET /api/wallet/:id` is requested with a specific <strong>:id</strong> in the URL, where <strong>:id</strong> is a placeholder variable for an integer. It should show the specific wallet with its owner, type and balance.
```
{
    "data": {
        "id": 1,
        "walletId": "fbfd05d83f2ed64c88785e92",
        "type": {
            "id": 1,
            "name": "Zelle",
            "monthlyInterestRate": 3.1
        },
        "balance": 500,
        "owner": {
            "id": 1,
            "name": "Admin",
            "email": "admin@test",
            "emailVerified": true,
            "createdAt": "2023-06-26T08:18:21.000000Z"
        },
        "createdAt": "2023-06-26T17:31:43.000000Z"
    }
}
```
When the endpoint: `POST /api/transfer/wallet` is requested with the following datapoints:
* fromWalletId
* toWalletId
* amount

```
Request:
{
    "fromWalletId": "fbfd05d83f2ed64c88785e92",
    "toWalletId": "db8a43bb03afa4631e39b435",
    "amount": 20
}

Response:
{
    "message": "You transfer of NGN10 has been successful. You new balance is NGN490",
    "data": {
        "id": 6,
        "tranx_ref": "ab9e5001956542373d2a33a67247",
        "amount": 10,
        "tranxFee": 0,
        "type": "wallet_to_wallet",
        "status": "successful",
        "tranxDate": "2023-06-27T08:43:30.000000Z"
    }
}
```

a transaction is created in the database and would return details of the transaction with a message prompt to the user. It is assumed that `fromWalletId` which is the user sender wallet has a validated walletId, therefore validation only occurs for `toWalletId` and sender wallet balance.