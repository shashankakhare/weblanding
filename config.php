<?php
// ============================================================
// Digital Dreams Inc. - Configuration
// Edit these values for your hosting environment
// ============================================================
return [
  // MySQL database (from cPanel > MySQL Databases)
  'db_host' => 'localhost',
  'db_name' => 'digital_dreams_php',
  'db_user' => 'dd',
  'db_pass' => 'ddpass123',

  // Your site URL, no trailing slash (used in payment redirects)
  'base_url' => 'http://localhost:8080',

  // Cashfree payments (https://merchant.cashfree.com > Developers > API Keys)
  // Leave empty for safe mock/stub checkout mode
  'cashfree_app_id' => '',
  'cashfree_secret_key' => '',
  'cashfree_env' => 'sandbox', // 'sandbox' or 'production'

  // Email: set true to send via PHP mail() (works on most shared hosts).
  // false = emails are logged to the email_logs table instead (stub mode)
  'mail_enabled' => false,
  'mail_from' => 'noreply@yourdomain.com',
  'mail_from_name' => 'Digital Dreams Inc.',

  // Google OAuth (optional - stub until filled)
  'google_client_id' => '',
  'google_client_secret' => '',
];
