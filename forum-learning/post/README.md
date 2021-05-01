# FORUM LEARNING

### Instalation Step
   - Clone repository in

        `https://github.com/cicioktaviani97/forum_learning.git`


   - Arahkan ke folder **forum_learning**

        `cd forum_learning`

   - lengkapi vendor-vendor laravel

        `composer install`


   - copy **.env.example** dan paste dengan name **.env**

        `cp .env.example .env` atau `copy .env.example .env`


   - setting database, sesuikan nama database, user, dan password mysql dengan settingan anda

            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=forum_learning
            DB_USERNAME=root
            DB_PASSWORD=

   - genereate project key

        `php artisan key:generate`

   - terakhir import collection json ke postman
   `https://www.getpostman.com/collections/9ac82fec6300f9222a94`
