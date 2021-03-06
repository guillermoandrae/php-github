<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

use GitHub\Http\Exception\InvalidAuthCredentialsException;
use GitHub\Http\Exception\InvalidAuthenticationSchemeException;
use GitHub\Http\Exception\MaximumAuthAttemptsException;
use GitHub\Http\Exception\MissingCredentialsException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Subscriber\Cache\CacheSubscriber;

/**
 * Guzzle-dependent GitHub API adapter.
 *
 * @package GitHub\Adapter
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
class GuzzleAdapter extends AdapterAbstract
{
    /**
     * Builds the adapter.
     */
    public function __construct()
    {
        $this->setHttpClient(new Client([
            'base_url' => 'https://api.github.com/',
            'defaults' => [
                'headers' => ['Accept' => 'application/vnd.github.v3+json']
            ]
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate($authScheme, $username, $password = null)
    {
        if (!in_array($authScheme, [self::AUTH_OAUTH_TOKEN, self::AUTH_HTTP_PASSWORD], false)) {
            $message = 'Please provide a valid authentication scheme.';
            throw new InvalidAuthenticationSchemeException($message);
        }

        if (is_null($username)) {
            $message = 'Please provide credentials.';
            throw new MissingCredentialsException($message);
        }

        if ($authScheme !== self::AUTH_OAUTH_TOKEN && is_null($password)) {
            $message = 'The desired authentication scheme requires a username and a password.';
            throw new MissingCredentialsException($message);
        }

        $this->getHttpClient()->setDefaultOption('auth', [$username, $password, $authScheme]);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthentication()
    {
        return $this->getHttpClient()->getDefaultOption('auth');
    }

    /**
     * {@inheritdoc}
     */
    public function get($uri, array $params = [], array $headers = [])
    {
        return $this->request(self::HTTP_GET, $uri, ['query' => $params], $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function post($uri, array $params = [], array $headers = [])
    {
        return $this->request(self::HTTP_POST, $uri, ['body' => $params], $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function put($uri, array $params = [], array $headers = [])
    {
        return $this->request(self::HTTP_PUT, $uri, ['body' => $params], $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function patch($uri, array $params = [], array $headers = [])
    {
        return $this->request(self::HTTP_PATCH, $uri, ['body' => $params], $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($uri, array $params = [], array $headers = [])
    {
        return $this->request(self::HTTP_DELETE, $uri, ['query' => $params], $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function head($uri, array $params = [], array $headers = [])
    {
        return $this->request(self::HTTP_HEAD, $uri, ['query' => $params], $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function options($uri, array $params = [], array $headers = [])
    {
        return $this->request(self::HTTP_OPTIONS, $uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function request($type, $uri, array $params = [], array $headers = [])
    {
        try {
            $args = func_get_args();
            $cacheId = md5(serialize($args));
            if ($this->getCache() && $this->getCache()->contains($cacheId)) {
                return $this->getCache()->fetch($cacheId);
            }
            $options = $this->buildRequestOptions($params, $headers);
            $request = $this->getHttpClient()->createRequest($type, $uri, $options);
            $response = $this->getHttpClient()->send($request);
            $result = $response->json();
            if ($this->getCache()) {
                $this->getCache()->save($cacheId, $result);
            }
            return $result;
        } catch(ClientException $ex) {
            $response = $ex->getResponse();
            $message = $response->json()['message'];
            switch($response->getStatusCode()) {
                case 401:
                    throw new InvalidAuthCredentialsException($message);
                case 403:
                    throw new MaximumAuthAttemptsException($message);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseUrl($url)
    {
        $defaultOptions = $this->getHttpClient()->getDefaultOption();
        $options = array_merge(['base_url' => $url], $defaultOptions);
        $client = new Client($options);
        $this->setHttpClient($client);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setProxy($proxy)
    {
        $client = $this->getHttpClient();
        $client->setDefaultOption('proxy', $proxy);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setHttpClient($client)
    {
        CacheSubscriber::attach($client);
        parent::setHttpClient($client);
        return $this;
    }

    /**
     * Builds request options.
     *
     * @param array $params  Request parameters
     * @param array $headers  Request options
     * @return array
     */
    private function buildRequestOptions(array $params, array $headers)
    {
        $options = array_merge($params, ['headers' => $headers]);
        return $options;
    }
}
