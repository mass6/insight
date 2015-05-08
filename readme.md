# Insight Reporting

### Installation (local deployment)
**Step 1** - Clone repository to your local server. Ideally, you want to assign a local domain name to your local app (e.g. insight-reporting.dev). Easiest way of setting up a local environment is by using [Laravel Homestead](http://laravel.com/docs/4.2/homestead).

**Step 2**. After you have cloned the repository, from the terminal, cd into the root directory of the repo and run composer install
```
> cd insight-reporting
> composer install
```

**Step 3** - Setup/create a new database in your local environment

**Step 4** - In the root directory, create an file named .env.local.php, and populate it with the appropriate config variables
```
// insight-reporting/.env.local.php

<?php

return [
    "APP_URL" => '', // application base url "http://insight-reporting.dev"
    "ENCRYPTION_KEY" => '', // application encryption key
    "DEBUG" => '', // true/false
    "APP_TIMEZONE" => '', // 'Asia/Dubai', see http://php.net/manual/en/timezones.php for other options
    'DB_TYPE'   => '', // 'mysql'  other ('sqlite', 'sqlsrv', 'pgsql')
    "DB_HOST" => '', // localhost
    "DB_NAME" => '', // Database Name
    "DB_USERNAME" => '', // Database Username
    "DB_PASSWORD" => '', // Database Password
    "MANDRILL_KEY" => '', // Mandrill API key
    "AWS_KEY" => '', // Amazon WS API key
    "AWS_SECRET" => '', // Amazon WS API Secret Key
    "AWS_REGION" => '', // Amazon WS region  "ap-southeast-1"
    "AWS_BUCKET" => '', // Name of AWS bucket
    "WS_KEY" => '', // webservice key
    "WS_REPORT_URL" => '', // 36S Report Service API Endpoint
    "WS_QUERY_URL" => '', // 36S Query Service API Endpoint
    "WS_VALIDATION_REPORT_URL" => '', // 36S Metadata Validation API Endpoint
    "WEBSERVICES_USER" => '', // 36S Webservices User
    "WEBSERVICES_APIKEY" => '', // 36S Webservices API Key
    "WEBSERVICES_URL" => '', // 36S Webservices API Endpoint
];
```
**Step 6** - Migrate the Sentry package
```
php artisan migrate --package=cartalyst/sentry
```
**Step 7** - Run the database migrations
```
php artisan migrate
```
**Step 8** - Seed the database (only in local environment)
```
php artisan db:seed
```
**Step 9** - Login to application. From your browser, go to you local app domain (e.g. http://insight-reporting.dev/), and login using one of the test user credentails.
>admin@admin.com | admin
>johndoe@test.com | password
