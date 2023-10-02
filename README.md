# Update and Deployment Server

This Laravel app provides updates for (Electron) apps, such as
my "[Stream Games 42](https://github.com/Muetze42/stream-games-42)" app.

A new release is first checked with the VirusTotal API before it is available to users.

## More...

* [Laravel](https://laravel.com/docs/10.x/)
* [VirusTotal API for PHP & Laravel](https://github.com/Muetze42/virus-total-php)
* [Postman Collection](deploying-and-update-server.postman_collection.json)

## Setup

Copy [.env.example](.env.example) to `.env` and set up.

### Install dependencies

```shell
composer install
```

### Migrate and seeding data

```shell
php artisan migrate --seed
```
