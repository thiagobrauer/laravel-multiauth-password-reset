# laravel-multiauth-password-reset

Add support to reset passwords when using multiple tables (and diffrent types of usernames) to authenticate in your Laravel application

## Installation

```bash
composer require thiagobrauer/laravel-multiauth-password-reset
```

If you are using Laravel 5.5 or higher, the package's provider will be automatically registered. For older version you need to add the provider to the `config/app.php` file: 

```php
'providers' => [
    // ...
    ThiagoBrauer\MultiAuthPasswordReset\PasswordResetServiceProvider::class,
];
```

<!-- [Click here](https://google.com) for a detailed tutorial -->