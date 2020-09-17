<p align="center"><img src="https://raw.githubusercontent.com/Team-HR/ihris-laravel/master/public/favicon.ico" width="100"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Integrated HRIS
Integrated HRIS developed as a single page application with Laravel 7.x framework. An HR system where agency’s policies and processes clearly define link with other core HRM areas (i.e., RSP, L&D, PM and R&R)
Development initiated on July 16, 2018.

## Dependencies for Installation
1. Composer <a href="https://getcomposer.org/">https://getcomposer.org/</a>

## Installation
1. Clone this repository.
2. Run <code>cd</code> to the project directory
3. Run <code>composer install</code>
4. Create copy of <code>.env.example</code> and rename to <code>.env</code>
5. Configure <code>.env</code> database parameters.
6. Run <code>php artisan key:generate</code>
7. Run <code>php artisan jwt:secret</code>
8. Run <code>php artisan migrate</code>
9. Run <code>php artisan db:seed --class=UserSeeder</code>
10. Open new terminal and run <code>php artisan serve</code>
11. Open new terminal and run <code>php artisan websocket:serve</code>
Start the creating wonders!

## Usefull
1. Run command <code>start dump.bat</code> on terminal to clear cache and config everytime you change environment settings like <code>.env</code>

## Documentations
1. Laravel 7.3 <a href="https://laravel.com/docs/7.x/installation">https://laravel.com/docs/7.x/installation</a>
2. Laravel Websockets <a href="https://beyondco.de/docs/laravel-websockets/getting-started/introduction">https://beyondco.de/docs/laravel-websockets/getting-started/introduction</a>

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
