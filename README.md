<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</a></p>
<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Snapp Food
## About
This is a fork of snapp food that has three parts of admin,salesman(restaurant owner) and customer.
Salesman and admin is SSG and customer part is Restful API
## Used packages
- Breeze (salesman and admin authentication)
- Sanctum (customer authentication)
- Laravel-Excel
- predis
- Clockwork
## Installation
> **Note:** First create **snapp_food** database (This project need redis server)
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```
## Roles
It implemented with guard
### Admin
#### Login
You can sign in as an admin with this login information:
- Email: moerfani78@gmail.com
- Password: 1234<br>
Or You can register new admin too
#### Features
- Restaurant categories (CRUD)
- Food categories (CRUD)
- Discounts (CRUD)
- Banner (CRUD)
- Manage comments that salesman request to delete them
### Salesman
#### Register salesman and after that add restaurant information
After register new salesman You should add restaurant information otherwise you can't go to restaurant dashboard
#### Features
- Food (CRUD) and add discount to specific food
- See all orders in dashboard and make action for that
- Restaurant setting for update data and add schedule
- See order comments and reply to them or send delete request
- Analyze financial reports and charts of restaurant and export excel of orders
- Archive orders history 
### Customer
#### Register new customer
After register new user as customer, user should add address to watch near restaurants and create card
#### Features
- User (CRUD) and new field as wallet for paying card
- Add and update address and set address as activate address
- See near restaurants
- See restaurant food and filter it by food category and see food details
- Card CRUD with payment (Implement with redis)  
- Post new comment for completed card and read them and see other's verified comments
