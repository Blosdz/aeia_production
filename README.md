## Requerimientos

- php v7.4
- composer v2
- postgresql 10.10

## Paso 1 :

```
composer install
cp .env.example .env
```

## Paso 2 : Modificar conexion a base de datos y smtp .env

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
MAIL_FROM_NAME=
```

## Paso 3 :

```
php artisan key:generate
php artisan storage:link
php artisan migrate:fresh --seed
```

