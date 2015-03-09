<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

use GitHub\Adapter\Exception\InvalidAuthenticationSchemeException;
use GitHub\Adapter\Exception\MissingCredentialsException;
use GuzzleHttp\Client;
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
     *
     * When working against an instance of GitHub Enterprise, provide the base
     * URL as this constructor's only argument.
     *
     * @param string $baseUrl OPTIONAL The base URL
     */
    public function __construct($baseUrl = '')
    {
        if (!$baseUrl) {
            $baseUrl = 'https://api.github.com/';
        }
        $httpClient = new Client([
            'base_url' => [$baseUrl, ['version' => 'v3']],
            'defaults' => [
                'headers' => ['Accept' => 'application/vnd.github.v3+json'],
            ]
        ]);
        CacheSubscriber::attach($httpClient);
        $this->setHttpClient($httpClient);
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthentication($username, $password, $authScheme)
    {
        if (is_null($username) || is_null($password)) {
            throw new MissingCredentialsException('Please provide both a valid username and password/token.');
        }
        if (!in_array($authScheme, [self::AUTH_OAUTH_TOKEN, self::AUTH_HTTP_PASSWORD])) {
            throw new InvalidAuthenticationSchemeException('Please provide a valid authentication scheme.');
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
    }

    private function buildRequestOptions(array $params, array $headers)
    {
        $options = array_merge($params, ['headers' => $headers]);
        return $options;
    }
}
