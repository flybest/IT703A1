# IT703A1
Assignment 1 for IT703 

## Running & Testing Environment
- PHP 7.0 & 7.1
- MySQL 5.7.19
- Nginx 1.12.1
- Chrome 66

## Libraries Used 
- Backend
    - Laravel
    - Laravel-debugbar
- Frontend
    - JQuery   
    - Bootstrap
    - Font Awesome
    - jQuery BlockUI
    
## How To Deploy It
* Make sure the running environment is prepared. The web server **Nginx** is recommended.
* Create the database and the user, grant necessary privileges to the user to  operate the database.
* Install **composer** by following the instructions from https://getcomposer.org/doc/00-intro.md#installation-windows.
* Copy the application  to web server publishing folder. 
* Change dir to the application folder in terminal and install necessary packages.

```shell
$ composer install
``` 
* Make all files in the project are autoloaded.

```shell
$ composer dump-autoload 
```
* Open **.env** file to change the database setup and app url.

```shell
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST={database_address}
DB_PORT={database_port}
DB_DATABASE={database}
DB_USERNAME={username}
DB_PASSWORD={password}
```
* Migrate data tables.

```shell
$ php artisan migrate
```
* Create default admin user and fake data. 

```shell
$ php artisan db:seed 
```
* Change the configuration of Nginx. The following is an sample. Other web servers refer to https://laravel.com/docs/5.6#pretty-urls

```
server {
    listen       8088;
    server_name  localhost;

    root         /Users/PZT/Sites/laravel-appointment/public;

    access_log  /usr/local/var/log/nginx/laravel-appointment.access.log  main;

    location / {
        index  index.html index.htm index.php;
        try_files $uri $uri/ /index.php?$query_string;
        autoindex   on;
        include     /usr/local/etc/nginx/php-fpm;
    }

    error_page  404     /404.html;
    error_page  403     /403.html;
}
```

* Start the Nginx.
* Default admin user is **admin/123456**, change the password after login. This user can not be deleted.
* Once the **.env** has been modified, the web server needs to be restarted to take effect.


