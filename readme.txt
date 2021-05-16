1. composer install
2. npm install
3. cp .env.example .env
4. php artisan key:generate
5. export parkiran.sql ke mysql local
6. .env :

DB_HOST=mysql => DB_HOST=127.0.0.1
DB_DATABASE=laravel => DB_DATABASE=parkiran

(sesuaikan dengan nama database yang dibuat)

7. php artisan serve