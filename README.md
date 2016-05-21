# laravel-realtime

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

A realtime library for laravel without compromises, using WAMPv2!

## Install

First add this package via composer:

``` bash
$ composer require jlndk/laravel-realtime
```

Then add the service provider to the `providers` array in `config/app.php`

``` php
Jlndk\LaravelRealtime\Providers\RealtimeServiceProvider::class,
```

After the service provider is added, you need to publish the relevant files:
``` bash
$ php artisan vendor:publish --tag=all
```

## Usage

Add event mappings to `app/Providers/RealtimeEventServiceProvider.php`

``` php
/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    'com.myapp.hello' => [
        'App\Events\TestEvent'
    ]
];
```

Then start the realtime server with artisan

``` bash
$ php artisan realtime:start
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email jonas@jonasln.dk instead of using the issue tracker.

## Credits

- [Jonas Lindenskov Nielsen][https://github.com/jlndk/]
- [All Contributors][composer.json]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
