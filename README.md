# php-github
[![Travis branch](https://img.shields.io/travis/guillermoandrae/php-github.svg?style=flat)](https://travis-ci.org/guillermoandrae/php-github) [![Coverage Status](http://img.shields.io/scrutinizer/coverage/g/guillermoandrae/php-github.svg?style=flat)](https://scrutinizer-ci.com/g/guillermoandrae/php-github/?branch=master) [![Code Quality](http://img.shields.io/scrutinizer/g/guillermoandrae/php-github.svg?style=flat)](https://scrutinizer-ci.com/g/guillermoandrae/php-github/?branch=master) [![HHVM](https://img.shields.io/hhvm/guillermoandrae/php-github.svg?style=flat)](http://hhvm.h4cc.de/package/guillermoandrae/php-github.json)

A PHP client library for the [GitHub API](https://developer.github.com/v3/).

## Installation
The recommended way to install this library is via [Composer](http://getcomposer.org):
```
{
    "require": {
        "guillermoandrae/php-github": "*"
    }
}
```

## Basic Usage
The basic client uses [Guzzle](http://docs.guzzlephp.org/en/latest/) to communicate with the GitHub API. Instantiation of the client is straight-forward:

```php
// create the client
$client = new GitHub\Client\Client();
```

Resources are represented as objects, and resource data is fetched through the use of object mappers:

```php
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
