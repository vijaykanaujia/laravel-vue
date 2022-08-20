<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About App
This is Vue scaffolding via an Inertia frontend implementation. Inertia allows you to build modern, single-page React and Vue applications using classic server-side routing and controllers.
In this App Laravel Breez porvide Authentication and Spatie permission provide Authorization.

#Feature of this application
- Dont't need setup Authentication and Authorization.
- Dynamic navigation bar with permission controle.
- User, Role, Menu and Permission with CRUD Operation.
- Super admin have ability to controle on user action through assign/de-assign permission.
- multi language.

## Installation

- clone git repository
- cd laravel-vue
- composer install
- npm install
- cp .env.example .env
- php artisan key:generate
- create database and write database in env file
- php artisan migrate
- php artisan db:seed BasicSetupSeeder
- php artisan serve
- npm run watch
- go to http://127.0.0.1:8000

## Security Vulnerabilities

If you discover a security vulnerability within App, please send an e-mail to Vijay kanaujia via [vijaykanaujia3@gmail.com](mailto:vijaykanaujia3@gmail.com).

## License

This app is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
