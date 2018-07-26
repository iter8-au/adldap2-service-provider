# adldap2-service-provider

## Installation

```bash
composer require iter8/adldap2-service-provider:~3.0
```

## Defaults

Auto-connect is defaulted to off (false) but this can be changed by setting *$app['adldap.auto_connect']* to true.

By default, the *$app['adldap.options']* array is initialiased with:

```php
$defaults = [
    'port' => 389,
    'use_ssl' => true,
    'follow_referrals' => false,
];
```
