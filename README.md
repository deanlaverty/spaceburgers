## Space burger test

This was built all with tests so there is no frontend due to time constraints. 

## Setup

- Run docker-compose up -d --build
- You can view the app in browser on http://localhost:8088 (As I mentioned there is no frontend)

## Running tests

- You can run tests with docker-compose exec app php artisan test

## Authentication

- You can fetch a token by hitting `/api/sanctum/token` this will return the token you need to include in the headers of requests.

## Fetching Fillings

- GET `/api/fillings`

## Fetching Buns
s
- GET `/api/buns`

## Create order

- POST `/api/order`

You will require the following payload

```json
{
    "fillings": [1, 2],
    "bun": 1
}
```