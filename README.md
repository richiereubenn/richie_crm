<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Customer Relationship Management ISP
Aplikasi ini dibangun menggunakan Laravel v11, PostgreSQL v14, dan TailwindCSC untuk menjadi sistem CRM (Customer Relationship Management) pada perusahaan Internet Service Provider (ISP).

Tujuan poryek : 
- Memudahkan divisi sales dalam mencatat dan mengelola calon customer. 
- Mempermudah pencatatan produk layanan yang tersedia. 
- Mempercepat proses follow-up lead dan approval manager. 
- Menyediakan informasi customer yang sudah berlangganan beserta layanan yang digunakan. 
- Menyediakan sistem login untuk keamanan akses.

## Deployment Guide
#### 1. Clone Repository
git clone https://github.com/richiereubenn/richie_crm.git \
cd richie_crm

#### 2. Install Dependencies
composer install\
npm install

#### 3. Copy .env File
cp .env.example .env

#### 4. Setup Database (isi bagian ini pada .env)
DB_CONNECTION=pgsql\
DB_HOST=127.0.0.1\
DB_PORT=5432\
DB_DATABASE=nama_database\
DB_USERNAME=username_postgre\
DB_PASSWORD=password_postgre\

#### 5. Generate App Key
php artisan key:generate

#### 6. Run Migration & Seeder
php artisan migrate --seed

#### 7. Compile TailwindCSS
npm run dev

#### 8. Run Application
php artisan serve
