# Tadah Website
The tartar sauce spaghetti code website of old legos.

# Setting It Up
## Prerequisites
- Composer
- PHP
- Nginx or Apache
- MariaDB/MySQL
- Redis(optional)

## The Setup
You set this up like any other laravel site ever, just open cmd in Tadah's directory and follow these steps.

Run `copy .env.example .env`
After you run this, you'll have to set up your database connections. You'll place these in the .env file you just created.
1. Create a database table, name it `tadah`
2. Create a user with permissions for that tadah table.
3. Copy this users' credentials into your .env file under `DB_USERNAME` and `DB_PASSWORD`.

--

**If you do not wish to use Redis**, you can change the following things in your .env file
1. Change `CACHE_DRIVER=redis` to `CACHE_DRIVER=file`
2. Change `SESSION_DRIVER=redis` to `SESSION_DRIVER=file`

--

Now if you run the following commands and it should *most likely* work.......
`composer install`
`php artisan key:generate`
`php artisan migrate:fresh --seed`
`npm i`
`npm run prod`

--

I got a little too lazy to finish this whole setup documentation. - Ubiquitous