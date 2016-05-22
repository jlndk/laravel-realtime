# Laravel Realtime

[![Total Downloads On Composer](https://img.shields.io/packagist/dt/jlndk/laravel-realtime.svg?maxAge=2592000)](https://packagist.org/packages/jlndk/laravel-realtime)
[![Total Downloads On Github](https://img.shields.io/github/downloads/jlndk/laravel-realtime/total.svg)](https://github.com/jlndk/laravel-realtime)
[![Total Issues On Github](https://img.shields.io/github/issues/jlndk/laravel-realtime.svg)](https://github.com/jlndk/laravel-realtime/issues)
[![Total Forks On Github](https://img.shields.io/github/forks/jlndk/laravel-realtime.svg?style=social&label=Fork)](https://github.com/jlndk/laravel-realtime#fork-destination-box)
[![Total Stars On Github](https://img.shields.io/github/stars/jlndk/laravel-realtime.svg?style=social&label=Star)](https://github.com/jlndk/laravel-realtime)

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

Now you can connect to the server, as you would with any other WAMPv2 router.

An example with autobahn.js, could be

``` js
var autobahn = require('autobahn');

var connection = new autobahn.Connection({
    url: 'ws://127.0.0.1:9090/',
    realm: 'realm1'
});

connection.onopen = function(session) {

    var button = document.querySelector(".button");

    button.addEventListener("click", function() {
        session.publish('com.myapp.hello', ['Hello from javascript!']);
    });

    // subscribe to a topic
    function onMyAppHello(args) {
        console.log("Event:", args[0]);
    }

    session.subscribe('com.myapp.hello', onMyAppHello);
};

connection.open();
```

More examples will be added later.

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
