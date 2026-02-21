<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 📚 Readers — Book Marketplace

A full-stack web application built with **Laravel 11** where users can list, browse, and manage books for sale.

## Tech Stack

- **Backend:** PHP 8.2, Laravel 11
- **Frontend:** Blade, Tailwind CSS, Alpine.js, Vite
- **Database:** MySQL (with foreign keys, indexes, cascading deletes)
- **Auth:** Laravel Breeze (session-based)
- **Testing:** Pest PHP
- **Containerization:** Docker, docker-compose

## Features

- 🔐 **Authentication** — registration, login, logout, password reset (Laravel Breeze)
- 📖 **Book CRUD** — create, read, update, delete books with cover image upload
- 🛡️ **Authorization** — only the book owner can edit/delete (Policy-based)
- 🔍 **Filter by author** — dropdown filter on the home page
- 👤 **User profile** — update name, email, password, delete account
- 🌱 **Database seeding** — 15 pre-loaded authors for quick setup

## Architecture & Principles

The codebase follows **SOLID**, **DRY**, and **KISS** principles:

| Layer | Responsibility |
|---|---|
| `Controllers` | Accept HTTP requests, delegate to services, return responses |
| `Services` | Business logic (BookService — create, update, delete, image handling) |
| `Form Requests` | Validation rules (StoreBookRequest, UpdateBookRequest) |
| `Models` | Eloquent relationships, fillable attributes |
| `Policies` | Authorization (only owner can edit/delete) |

### Query Optimization
- **Eager loading** (`Book::with(['author', 'user'])`) to prevent N+1 query problems
- **Foreign key indexes** on `author_id`, `user_id` via `foreignId()->constrained()`

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── BookController.php         # Thin controller
│   └── Requests/
│       ├── StoreBookRequest.php       # Store validation
│       └── UpdateBookRequest.php      # Update validation
├── Models/
│   ├── Author.php
│   ├── Book.php
│   └── User.php
├── Policies/
│   └── BookPolicy.php                 # Owner-only authorization
└── Services/
    └── BookService.php                # Business logic + image upload

tests/Feature/
└── BookTest.php                       # 12 Pest tests (CRUD, auth, policy, validation)
```

## Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.0+

### Installation

```bash
git clone https://github.com/<your-username>/readers.git
cd readers

composer install
npm install && npm run build

cp .env.example .env
php artisan key:generate
```

### Database Setup

```bash
# Create a MySQL database named "readers", then:
php artisan migrate --seed
```

This will create all tables and seed **15 authors** + a **test user**.

### Run

```bash
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000)

### Demo Login

| Email | Password |
|---|---|
| test@example.com | password |

### Run Tests

```bash
php artisan test
```

## Docker Setup (alternative)

```bash
docker-compose up -d
docker exec readers-app php artisan migrate --seed
```

App will be available at [http://localhost:8000](http://localhost:8000)

## What I Practiced

- Refactoring a monolithic controller into **Service + FormRequest** layers (SRP)
- Eliminating **code duplication** — shared validation rules, centralized image upload logic (DRY)
- Removing dead code, empty controllers, unused model (KISS)
- Writing **feature tests** covering auth, authorization, validation, and filtering
- **Eager loading** to optimize database queries
- **Docker** setup for reproducible development environment
- **Policy-based authorization** for resource ownership

## License

Open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
