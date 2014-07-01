Minimum Requirements
====================
* PHP 5.5.0
* Composer (https://getcomposer.org/)
* Beanstalkd (http://kr.github.io/beanstalkd/)

Build Steps
===========
1. Run the following commands:

    > $ composer install

2. Open the following file and ensure that your machine name contains those strings:

    > www/laravel/bootstrap/start.php:29

3. Create folder:

    > laravel/app/config/local/

4. Copy whatever configuration files needed to the folder in step 2 and modify as needed. For example:

    > laravel/app/config/database.php

5. Open and modify the path as needed for the following file:

    > www/laravel/public/.htaccess:9

6. Run the following commands:

    > $ php artisan migrate --env=local  

7. Open browser and navigate to application public directory:

    > http://domain/laravel/www/public/

8. Schedular/Cron hourly access (starts the scraper):

    > http://domain/laravel/www/public/job

9. Done.
