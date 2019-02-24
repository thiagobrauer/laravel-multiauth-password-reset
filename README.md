# laravel-multiauth-password-reset

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