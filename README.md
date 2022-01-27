## Website Bootcamp

#### requires

php 7.3|^8.0

### fitur

-   Kirim Email
-   Login social media dengan google account

Download atau clone project dari github:

```sh
git clone
```

```sh
composer install
```

copy atau rubah file env.example menjadi .env dan isi kan nama database anda.
setelah itu ketikkan pada terminal

```sh
php artisan migrate
php artisan key:generate
php artisan storage:link
php artisan optimize
php artisan db:seed
```
