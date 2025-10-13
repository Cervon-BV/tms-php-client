# TMS PHP Client

```php
use Cervon\Tms\Tms;

$CLIENT_ID = 'MY_CLIENT_ID';
$CLIENT_SECRET = 'MY_CLIENT_SECRET';
$TMS_BASE_URL = 'https://my-tms-url.com/'

$tms = new Tms($CLIENT_ID, $CLIENT_SECRET, $TMS_BASE_URL);
$authenticator = $tms->getAccessToken();
$tms->authenticate($authenticator);

$jobs = $tms->listJobs();

foreach ($jobs as $job) {
    echo "Job #{$job->number} (ID: {$job->_id})\n";
}
```

## Installation
```bash
composer require cervon/tms-php-client
```

## Usage
You can authenticate using your TMS client id, client secret and base URL.
```php
use Cervon\Tms\Tms;

$CLIENT_ID = 'MY_CLIENT_ID';
$CLIENT_SECRET = 'MY_CLIENT_SECRET';
$TMS_BASE_URL = 'https://my-tms-url.com/'

$tms = new Tms($CLIENT_ID, $CLIENT_SECRET, $TMS_BASE_URL);
$authenticator = $tms->getAccessToken();
```

### Disabling SSL verify
By default, verify SSL is enabled. When you want to for example test the API locally, you can disable SSL verification. 
```php
$tms = new Tms($CLIENT_ID, $CLIENT_SECRET, $TMS_BASE_URL, verifySsl: false);
```

### Caching authenticator
To prevent sending authentication requests every time you can serialize and cache the authenticator object. E.g. in Laravel.
```php
use Cervon\Tms\Tms;
use Illuminate\Support\Facades\Cache;

$tms = new Tms($CLIENT_ID, $CLIENT_SECRET, $TMS_BASE_URL);

$authenticator = Cache::remember('tms_authenticator', 3600, function () use ($tms) {
    // Fresh token when cache is empty
    return $tms->getAccessToken();
});

// Refresh token when expired
if ($authenticator->hasExpired()) {
    $authenticator = $tms->getAccessToken();
    Cache::put('tms_authenticator', $authenticator, 3600);
}

$tms->authenticate($authenticator);
```

## Security

If you discover any security related issues, please email support@cervon.nl instead of using the issue tracker.

## Credits

- [Jacobtims](https://github.com/Jacobtims)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
