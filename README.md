# php-github
[![Travis branch](https://img.shields.io/travis/guillermoandrae/php-github.svg?style=flat)](https://travis-ci.org/guillermoandrae/php-github) [![Coverage Status](http://img.shields.io/scrutinizer/coverage/g/guillermoandrae/php-github.svg?style=flat)](https://scrutinizer-ci.com/g/guillermoandrae/php-github/?branch=master) [![Code Quality](http://img.shields.io/scrutinizer/g/guillermoandrae/php-github.svg?style=flat)](https://scrutinizer-ci.com/g/guillermoandrae/php-github/?branch=master) [![HHVM](https://img.shields.io/hhvm/guillermoandrae/php-github.svg?style=flat)](https://img.shields.io/hhvm/guillermoandrae/php-github.svg?style=flat)



## Quick Start
A PHP client for the GitHub API.

```php
// create the client
$client = new GitHub\Client();

// pick a resource... like the user resouce, for example
$userResource = $client->resource('user');

// get some useful user data...
$user = $userResource->find('guillermoandrae');
$repos = $user->getRepos();
$commits = $user->getCommits();
$gists = $user->getRepos();

// or some useful organization data
$orgs = $client->resource('organization')->findAll();

// rejoice!
echo 'YEESSSSSSSSSSSS!';
```
