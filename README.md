# RuangBk - School Management System

This Starter kit contains my starting point when developing a new Laravel project. Its based on the official Livewire Starter kit, and includes the following features:
- ✅ **User Management**, 
- ✅ **Role Management**,
- ✅ **Permissions Management**,
- ✅ **Localization** options
- ✅ Separate **Dashboard for Super Admins**
- ✅ Updated for Laravel 12.0 **and** Livewire 3.0

## TALL stack
It uses the TALL stack, which stands for:
-   [Tailwind CSS](https://tailwindcss.com)
-   [Alpine.js](https://alpinejs.dev)
-   [Laravel](https://laravel.com)
-   [Laravel Livewire](https://livewire.laravel.com) using the components.

## Further it includes:
Among other things, it also includes:
-   [Flux UI](https://fluxui.dev) for flexible UI components (free version)
-   [Laravel Pint](https://github.com/laravel/pint) for code style fixes
-   [PestPHP](https://pestphp.com) for testing
-   [missing-livewire-assertions](https://github.com/christophrumpel/missing-livewire-assertions) for extra testing of Livewire components by [Christoph Rumpel](https://github.com/christophrumpel)
-   [LivewireAlerts](https://github.com/jantinnerezo/livewire-alert) for SweetAlerts
-   [Spatie Roles & Permissions](https://spatie.be/docs/laravel-permission/v5/introduction) for user roles and permissions
-   [Strict Eloquent Models](https://planetscale.com/blog/laravels-safety-mechanisms) for safety
-   [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar) for debugging
-   [Laravel IDE helper](https://github.com/barryvdh/laravel-ide-helper) for IDE support

# Installation

```bash
git clone https://github.com/RayanKhairullah/ruangbk-project.git
```

## 1. Install dependencies

```bash
composer install
npm install
npm run build # or npm run dev
```

## 2. Configure environment

Setup your `.env` file and run the migrations.

```bash
cp .env.example .env
php artisan key:generate
php artisan storage:link
```

## 3. Migration

```bash
php artisan migrate
```

## 4. Seeding

```bash
php artisan db:seed
```

## 5. Creating the first Super Admin user

```bash
php artisan app:create-super-admin
```

## 6. Set default timezone if different from UTC

```php
// config/app.php
return [
    // ...

    'timezone' => 'Europe/Copenhagen' // Default: UTC

    // ...
];
```

# Developing

## Check for code style issues

```bash
composer review
```

This command will run, in order:

-   Laravel/Pint
-   PHPStan
-   Rector (dry-run)
-   PestPHP

Ensuring that your code is up to standard and tested.

# Project Structure & Routes

## Directory Overview

- **app/**: Main application code, organized into:
  - Console (artisan commands)
  - Exports (data exports)
  - Http (controllers, middleware)
  - Livewire (Livewire components)
  - Mail (mailables)
  - Models (Eloquent models)
  - Notifications (notifications)
  - Providers (service providers)
- **lang/**: Localization files (e.g., `en/`, `da/` for English and Danish translations)
- **config/**: Configuration files (app, auth, cache, database, filesystems, logging, mail, permission, queue, services, session)
- **public/**: Web root (index.php), assets (images, build), .htaccess, favicon, robots.txt
- **storage/**: Application storage (app, debugbar, framework, logs)

## Route Structure (routes/web.php)

- `/` – Home page
- `/dashboard` – User dashboard (auth, verified)
- `/settings/*` – User settings (profile, password, appearance, locale)

### Authenticated Groups

- **Admin (`/admin`)**
  - Dashboard, Users, Roles, Permissions (CRUD)
  - Access controlled via roles/permissions
- **Teacher (`/teacher`)**
  - Dashboard, Jurusan, Rooms, Biodata, Jadwal Konseling, Catatans, Surat Panggilan
  - PDF export/preview for certain resources
- **Student (`/student`)**
  - Dashboard, Biodata, Jadwal Konseling, Catatans

All route groups use appropriate middleware for authentication and permissions.

For more details, see `routes/web.php` and the respective controllers/components.

# Contributing

Feel free to contribute to this project by submitting a pull request.
