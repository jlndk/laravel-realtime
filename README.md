# Laravel Realtime

[![Total Downloads On Composer](https://img.shields.io/packagist/dt/jlndk/laravel-realtime.svg?maxAge=2592000)](https://packagist.org/packages/jlndk/laravel-realtime)
[![Total Downloads On Github](https://img.shields.io/github/downloads/jlndk/laravel-realtime/total.svg)](https://github.com/jlndk/laravel-realtime)
[![Total Issues On Github](https://img.shields.io/github/issues/jlndk/laravel-realtime.svg)](https://github.com/jlndk/laravel-realtime/issues)
[![Total Forks On Github](https://img.shields.io/github/forks/jlndk/laravel-realtime.svg?style=social&label=Fork)](https://github.com/jlndk/laravel-realtime#fork-destination-box)
[![Total Stars On Github](https://img.shields.io/github/stars/jlndk/laravel-realtime.svg?style=social&label=Star)](https://github.com/jlndk/laravel-realtime)

A realtime library for laravel without compromises, using WAMPv2!

## Development status
This library is still not quite ready to use. The upstream messaging (client to server) should be run fine, but there is no warranty for stable functionality yet. Please use it at your own risk. The library is still under active development, and we hope to ship version 1.1 (our first beta) soon. We will update this repo (and readme) accordingly. 

## Install

**TL;DR: Download `jlndk/laravel-realtime` via composer, add `Jlndk\LaravelRealtime\Providers\RealtimeServiceProvider::class` to the providers array, publish the files, and add the second service provider: `App\Providers\RealtimeEventServiceProvider::class.`**

For more detailed instructions, please check out ["Installation" on our wiki](https://github.com/jlndk/laravel-realtime/wiki/Installation)

## Usage

**TL;DR: Add event bindings to the `RealtimeEventServiceProvider` in your app and start the realtime server via `php artisan realtime:start`**

For more detailed instructions alog with examples, please check out ["Usage" on our wiki](https://github.com/jlndk/laravel-realtime/wiki/Usage)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

**Note: Still needs tests. Pull requests are welcome :)**

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email jonas@jonasln.dk instead of using the issue tracker.

## Credits

- [Jonas Lindenskov Nielsen](https://github.com/jlndk/)
- [All Contributors](composer.json)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
