<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

use GitHub\Client\Exception\AuthException;
use GuzzleHttp\Client;

class GuzzleAdapter extends AdapterAbstract
{
    public function __construct($baseUrl = '')
    {
        if (!$baseUrl) {
            $baseUrl = 'https://api.github.com';
        }
        $httpClient = new Client([
            'base_url' => $baseUrl,
            'defaults' => [
                'headers' => ['Accept' => 'application/vnd.github.v3+json'],
            ]
        ]);
        $this->setHttpClient($httpClient);
    }

    public function setAuthentication($username, $password, $authType)
    {
        if (is_null($username) || is_null($password)) {
            throw new AuthException('Please provide valid credentials');
        }
        $this->getHttpClient()->setDefaultOption('auth', [$username, $password, $authType]);
    }

    public function request($type, $uri, $params = [], $headers = [])
    {
        $options = array();
        $key = sprintf(
            '%s-%s-%s',
            strtolower($type),
            str_replace('/', '_', $uri),
            serialize($options)
        );
        if ($cache = $this->getCache()) {
            if ($result = $cache->fetch($key)) {
                return $result;
            }
        }

        $request = $this->getHttpClient()->createRequest($type, $uri, $options);
        $response = $this->getHttpClient()->send($request);
        if ($response->getStatusCode() >= 400) {
            throw new \Exception('Bang!');
        }
        $result = (string) $response->getBody();
        if ($cache) {
            $this->getCache()->save($key, $result);
        }
        return $result;
    }
} 