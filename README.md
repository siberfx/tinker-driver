# BotMan Tinker

Gives your Laravel chatbot the ability to try your chatbot in your local terminal.

## Installation

Run `composer require siberfx/tinker` to install the composer dependencies.

Then in your `config/app.php` add

```php
Siberfx\Tinker\TinkerServiceProvider::class,
```

to the `providers` array.

## Usage

You now have a new Artisan command that helps you to test and develop your chatbot locally:

```php
php artisan botman:tinker
```
