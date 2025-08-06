<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This project is built using the [Laravel](https://laravel.com) framework.

### Requirements

- PHP >= 8.0.15
- Node.js >= 20.0.0
- Composer
- MySQL or compatible database

---

## Installation

Follow the steps below to set up this project on your local environment.

### 1. Clone the repository

```bash
git clone <repository-url>
cd <project-directory>
```

### 2.  Install PHP and Node js dependencies
```bash
composer install
npm install
```

### 3.  Configure environment file
```bash

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_empty_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4.  Generate application key
```bash
php artisan key:generate
```

### 5.  Run migrations
```bash
php artisan migrate
```

### 6.  Run seeders 
```bash
php artisan db:seed
```

### 6.  Run the development servers
```bash
For the frontend (Vite + Laravel Mix):
npm run dev

For the backend (Laravel server):
php artisan serve
```

