# php-github
[![Travis branch](https://img.shields.io/travis/guillermoandrae/php-github.svg?style=flat)](https://travis-ci.org/guillermoandrae/php-github) [![Coverage Status](http://img.shields.io/scrutinizer/coverage/g/guillermoandrae/php-github.svg?style=flat)](https://scrutinizer-ci.com/g/guillermoandrae/php-github/?branch=master) [![Code Quality](http://img.shields.io/scrutinizer/g/guillermoandrae/php-github.svg?style=flat)](https://scrutinizer-ci.com/g/guillermoandrae/php-github/?branch=master) [![HHVM](https://img.shields.io/hhvm/guillermoandrae/php-github.svg?style=flat)](http://hhvm.h4cc.de/package/guillermoandrae/php-github.json)


## Quick Start
A PHP client library for the GitHub API.

```php
// create the client
$client = new GitHub\Client();

// pick a resource and get some useful data, like so...
$users = $client->resource('user')->findAll();
foreach ($users as $user) {
    printf('%s has %d followers.', $user->getLogin(), $user->getNumFollowers());
    echo PHP_EOL;
}

// or like so...
$org = $client->resource('organization')->find('github');
echo $org->getLocation();

// .. and rejoice!
echo 'YEESSSSSSSSSSSS!';
```
