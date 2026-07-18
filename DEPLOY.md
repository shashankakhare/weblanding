# Digital Dreams Inc. — PHP Deployment Guide

## What's inside

This is a **self-contained PHP 8 + Vanilla JS** rewrite of Digital Dreams Inc. designed to run on plain shared hosting (cPanel, Plesk, DirectAdmin, etc.) with **no Node.js required**.

```
php-version/
├── api/
│   ├── index.php     # REST API router
│   └── db.php        # PDO / MySQL layer + auto-seeder
├── assets/
│   ├── css/app.css   # Aurora, shimmer, tilt, glass
│   └── js/api.js     # API client & UI helpers
├── mysql/schema.sql  # Database schema (25 tables)
├── config.php        # Edit this with your DB / API keys
├── index.html        # Landing page (all sections)
├── checkout.html     # 10-step checkout + Cashfree
├── login.html        # Sign in / Register
├── dashboard.html    # Customer dashboard
├── admin.html        # Admin panel (24+ sections)
├── order-success.html
├── invoice.html      # Printable invoice
└── .htaccess         # Rewrites + security
```

## Requirements

- PHP >= 8.0 with `pdo_mysql`, `curl`, `mbstring`, `openssl`
- MySQL / MariaDB >= 5.7
- Apache with `mod_rewrite` (or nginx equivalent)

## 5-minute install (cPanel)

1. **Create a MySQL database** in cPanel > *MySQL Databases*.
   Note the database name, user, password.
2. **Import the schema:** open *phpMyAdmin* > choose your DB > *Import* > select `mysql/schema.sql`.
3. **Upload** the contents of `php-version/` to your `public_html` (or a subfolder).
4. **Edit `config.php`** with your DB credentials and (optionally) your Cashfree keys:

   ```php
   'db_host' => 'localhost',
   'db_name' => 'yourcpaneluser_ddphp',
   'db_user' => 'yourcpaneluser_dd',
   'db_pass' => 'strong-password',
   'base_url' => 'https://yourdomain.com',
   ```

5. **Open your site**. The database will auto-seed with packages, add-ons, coupons, testimonials, portfolio, blogs and admin user on first visit.

### Default admin

- Email: `admin@digitaldreams.com`
- Password: `admin123`
- **Change this immediately** from *Admin → Users*.

## Optional integrations

All of these are **optional** — the app runs in safe mock/stub mode when not configured.

### Cashfree Payments (real card / UPI / netbanking)

1. Go to https://merchant.cashfree.com → *Developers → API Keys*.
2. Copy your *App ID* and *Secret Key*.
3. Edit `config.php`:
   ```php
   'cashfree_app_id' => 'YOUR_APP_ID',
   'cashfree_secret_key' => 'YOUR_SECRET_KEY',
   'cashfree_env' => 'production', // or 'sandbox'
   ```
4. Set the webhook URL in Cashfree dashboard to:
   `https://yourdomain.com/api/index.php?r=webhooks/cashfree`

### Email delivery

By default, emails are logged to the `email_logs` table (view them under *Admin → Email Logs*).
To send real emails via PHP's `mail()` (works on most cPanel hosts):
```php
'mail_enabled' => true,
'mail_from' => 'noreply@yourdomain.com',
'mail_from_name' => 'Digital Dreams Inc.',
```

### Google OAuth (coming soon)

Add `google_client_id` / `google_client_secret` in `config.php`. The route `/api/index.php?r=auth/google` will be enabled once implemented.

## URL Rewrites

The included `.htaccess` cleans up API URLs. If your host doesn't support `mod_rewrite`, everything still works using the fallback path `api/index.php?r=ROUTE`.

## Security notes

- `config.php` is **not** protected by default — keep it out of version control.
- The `.htaccess` blocks direct access to `config.php` and dotfiles.
- Passwords are hashed with `password_hash(BCRYPT)`.
- Rate limiting is enabled per IP for auth / orders / leads.

## Support

For issues, open a ticket in the **Admin → Support Tickets** area or email `hello@digitaldreams.com`.
