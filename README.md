# TrustEdge Infotech

A complete Laravel 11, PHP 8.3-compatible business software agency application with Blade templates, Tailwind/Bootstrap styling, MySQL configuration, project request workflows, demo approval, 30% advance payment flow, Razorpay-ready checkout screens, quotations, invoices, client dashboard and admin dashboard.

## Tech stack

- Laravel 11
- PHP 8.3+
- MySQL
- Blade templates
- Tailwind CSS compiled with Vite
- Bootstrap 5 responsive components

## Main modules

- Premium responsive homepage and services pages
- Project builder with live price calculator
- Contact/request demo form
- Project request submission flow
- Client dashboard for requests, quotations, invoices, demos and payment status
- Admin dashboard for request management and demo URL submission
- Demo approval workflow before payment
- 30% advance invoice flow
- Razorpay sandbox-ready payment screens
- Login, register, forgot password and reset password

## Local setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Create a MySQL database named `trustedge_infotech`, then update `.env` if your credentials differ:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=trustedge_infotech
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seed the default admin user:

```bash
php artisan migrate --seed
```

Build frontend assets:

```bash
npm run build
```

Start the local server:

```bash
php artisan serve
```

## Preview the homepage

After running `php artisan serve`, open:

```text
http://127.0.0.1:8000
```

For live asset reloading during development, run this in a second terminal:

```bash
npm run dev
```

## Default admin login

```text
Email: admin@trustedgeinfotech.com
Password: password
```

Change the seeded admin password before production use.

## Razorpay configuration

The current payment flow creates a local sandbox-style order and confirmation so the workflow can be previewed without live credentials. Before production, add Razorpay keys to `.env` and replace the simulated confirmation with server-side Razorpay order creation and signature verification.

```dotenv
RAZORPAY_KEY=
RAZORPAY_SECRET=
```

## Useful routes

- `/` — Homepage
- `/services` — Services
- `/project-builder` — Live price calculator and request submission
- `/contact` — Request demo/contact form
- `/dashboard` — Client dashboard
- `/admin` — Admin dashboard
- `/login`, `/register`, `/forgot-password` — Authentication pages
