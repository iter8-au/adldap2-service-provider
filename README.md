# adldap2-service-provider

## Installation

Add the following hash to the `repositories` entry in your composer.json file.

```json
{
  "type": "vcs",
  "url": "https://github.com/iter8-au/adldap2-service-provider.git"
}
```

Then you can do:

```bash
composer require iter8/adldap2-service-provider:~1.0
```

## Defaults

Auto-connect is defaulted to off (false) but this can be changed by setting *$app['adldap.auto_connect']* to true.

By default, the *$app['adldap.options']* array is initialiased with:

```php
$defaults = [
    'port'             => 389,
    'use_ssl'          => true,
    'follow_referrals' => false,
];
```
