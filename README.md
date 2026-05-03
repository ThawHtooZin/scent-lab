# The Scent Lab

Laravel ecommerce storefront + admin panel scaffold based on your UI direction.

## Quick Start

```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

## Admin Login

- Email: `admin@scentlab.test`
- Password: `password`

## Image Workflow (one place)

1. Paste all images inside `public/images/scent-lab`
2. Open `config/scentlab.php`
3. Change only file names in the `images` array

Done. Every page uses those keys automatically.
